<?php

namespace App\Repositories\Eloquent;

use Throwable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class EloquentAddressRepository implements AddressRepositoryInterface
{
  public function insertNewAddress(User $user, mixed $data)
  {
    try {
      /** @var \App\Models\User $user */

      DB::beginTransaction();
      if ($data['main']) {
        $this->resetFieldMainForFalse($user);
      }
      $created = $user->addresses()->create($data);
      DB::commit();
      return $created;
    } catch (Throwable $e) {
      DB::rollBack();
      throw $e;
    }
  }
  public function getAllAddress(User $user)
  {
    $addresses = $user->addresses()->orderByMainAndLatest()->get();
    $existActive = $addresses->first(fn($item) => $item->active);
    if (!$existActive) {
      $addresses = $this->setFirstActive($user, $addresses);
    }
    return $addresses;
  }


  public function findById(User $user, int $id)
  {
    return $user->addresses()->whereId($id)->first();
  }



  public function updateAddress(User $user, array $data)
  {
    try {
      DB::beginTransaction();
      if ($data['main']) {
        $this->resetFieldMainForFalse($user);
      }
      $user->addresses()->whereId($data['id'])->update($data);
      DB::commit();
      return true;
    } catch (Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }
  public function setAddressToMain(User $user, int $id)
  {
    try {
      DB::beginTransaction();
      $this->resetFieldMainForFalse($user);
      $this->setAddressActive($user, $id);
      DB::commit();
      return true;
    } catch (Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }


  public function deleteAddress(User $user, int $id)
  {
    return $user->addresses()->whereId($id)->delete();
  }
  public function resetFieldMainForFalse(User $user)
  {
    return $user->addresses()->where('main', '!=', false)->update(['main' => 0]);
  }

  public function setAddressActive($user, $id)
  {
    return $user->addresses()->whereId($id)->update(['main' => 1]);
  }
  public function setFirstActive(User $user, $addresses)
  {
    $addresses->first()->update(['main' => 1]);
    return $addresses;
  }
}
