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
      return $user->addresses()->orderBy('main', 'desc')->oldest()->get();

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
      // return DB::table('nao_exise')->get();
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
      if (!$address) {
        throw new AddressNotExistException();
      }

      DB::transaction(function () use ($address, $data, $user) {
        $this->resetFieldMain($user, $data['main']);
        $address->update($data);
      }, 3);

      return $user->addresses()->orderBy('main', 'desc')->oldest()->get();


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
      return $user->addresses;
    } catch (\Exception $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'Error deleting address',
      ], 400);
    }
  }
  /* helpers */

  private function resetFieldMain(User $user, mixed $main)
  {
    return $main ? $user->addresses()->update(['main' => 0]) : '';
  }
}


