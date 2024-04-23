<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ErrorSystem;
use Throwable;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class EloquentAddressRepository implements AddressRepositoryInterface
{
    public function getAllAddress(int $user_id): Collection
    {
        return Address::where('user_id', $user_id)->orderByDesc('main')->latest('created_at')->get();
    }
    public function createAddress(array $data): Address
    {
        DB::beginTransaction();
        try {
            if ($data['main']) {
                Address::where('user_id', $data['user_id'])->where('main', 1)->update(['main' => 0]);
            }
            $address_created = Address::create($data);
            DB::commit();
            return $address_created;
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function findByIdAddress(int $user_id, int $id): Address|null
    {
        return Address::whereId($id)->where('user_id', $user_id)->first();
    }



    public function updateAddress(int $user_id, int $id, array $data): bool
    {
        try {
            DB::beginTransaction();
            if ($data['main']) {
                Address::where('user_id', $user_id)->where('main', 1)->update(['main' => 0]);
            }
            Address::where('id', $data['id'])->update($data);
            DB::commit();
            return true;
        } catch (Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteAddress(int $user_id, int $id): int
    {
        $address = Address::where('user_id', $user_id)->whereId($id)->first();
        if ($address->main) {
            Address::where('user_id', $user_id)->whereNot('id', $id)->latest()->first()->update(['main' => true]);
        }
        return $address->delete();
    }
    public function setAddressToMain(int $user_id, int $id): bool
    {
        try {
            DB::beginTransaction();
            Address::where('user_id', $user_id)->where('id', $id)->update(['main' => true]);
            Address::where('user_id', $user_id)->whereNot('id', $id)->update(['main' => false]);
            DB::commit();
            return true;
        } catch (Throwable $th) {
            DB::rollBack();
            return false;
        }
    }





}
