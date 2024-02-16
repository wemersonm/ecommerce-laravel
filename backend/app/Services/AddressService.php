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

    $user = auth()->user();
    try {
      $address = $user->addresses()->where('id', $data['id'])->first();
      return $address ? $address : throw new AddressNotExistException();
      // return DB::table('nao_exise')->get();
    } catch (\Exception $e) {
      // dd('eu');
      return response()->json([
        'error' => class_basename($e),
        'message' => 'error at edit address',
      ],404);
      
    }

  }


  public function update(array $data)
  {
    /** @var \App\Models\User $user */
    $user = auth()->user();
    $address = $user->addresses()->where('id', $data['id'])->first();
    if (!$address) {
      throw new AddressNotExistException();
    }
    try {
      DB::transaction(function () use ($address, $data, $user) {
        $this->resetFieldMain($user, $data['main']);
        $address->update($data);
      }, 3);

    } catch (\Exception $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'error at edit address',
      ], 500);
    }
    return $user->addresses()->orderBy('main', 'desc')->oldest()->get();
  }


  public function destroy(array $data)
  {

    /** @var \App\Models\User $user */
    $user = auth()->user();
    $address = $user->addresses()->where('id', $data['id'])->first();
    if (!$address)
      throw new AddressNotExistException();
    try {
      $address->delete();
      return $user->addresses()->get();
    } catch (\Exception $e) {
      return response()->json([
        'error' => class_basename($e),
        'message' => 'Error deleting address',
      ], 500);
    }
  }
  /* helpers */

  private function resetFieldMain(User $user, mixed $main)
  {
    return $main ? $user->addresses()->update(['main' => 0]) : '';
  }
}


