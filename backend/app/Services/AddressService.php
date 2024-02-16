<?php

namespace App\Services;

use App\Exceptions\AddressNotExistException;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AddressService
{
  public function store(array $data)
  {

    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      DB::beginTransaction();
      $this->resetFieldMain($user, $data['main']);
      $user->addresses()->create($data);
      DB::commit();
      return $user->addresses()->OrderByMain()->get();

    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'error' => class_basename($e),
        'message' => 'unexpected error',
      ]);
    }
  }
  public function show($data)
  {
    try {
      $user = auth()->user();
      $address = $user->addresses()->where('id', $data['id'])->first();
      return $address ? $address : throw new AddressNotExistException();
    } catch (\Throwable $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'error at edit address',
      ], 400);
    }
  }


  public function update(array $data)
  {
    /** @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $address = $user->addresses()->where('id', $data['id'])->first();
      !$address ? throw new AddressNotExistException() : null;
      DB::transaction(function () use ($address, $data, $user) {
        $this->resetFieldMain($user, $data['main']);
        $address->update($data);
      }, 3);

      return $user->addresses()->OrderByMain()->get();

    } catch (\Exception $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'error at edit address',
      ], 500);
    }
  }


  public function destroy(array $data)
  {
    /** @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $address = $user->addresses()->where('id', $data['id'])->first();
      if (!$address)
        throw new AddressNotExistException();
      $address->delete();
      return $user->addresses()->OrderByMain()->get();
    } catch (\Exception $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'Error deleting address',
      ], 400);
    }
  }


  public function updateToMain(array $data)
  {
    /** @var \App\Models\User $user */
    /** @var \App\Models\Address $address */

    try {
      DB::beginTransaction();
      $user = auth()->user();
      $address = $user->addresses()->WhereId($data['id'])->first();
      !$address ? throw new AddressNotExistException() : null;
      $this->resetFieldMain($user, true);
      $this->setAddressMain($address);
      DB::commit();
      return $user->addresses()->orderByMain()->get();
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json([
        'error' => class_basename($th),
        'message' => 'error at update address to main',
      ], 400);
    }
  }

  
  private function resetFieldMain(User $user, mixed $main)
  {
    return $main ? $user->addresses()->update(['main' => false]) : null;
  }
  private function setAddressMain(Address $address)
  {
    return $address->update(['main' => true]);
  }
}


