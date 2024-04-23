<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Collection;

interface AddressRepositoryInterface
{
    public function getAllAddress(int $user_id): Collection;
    public function createAddress(array $data): Address;
    public function findByIdAddress(int $user_id,int $id): Address|null;
    public function updateAddress(int $user_id,int $id, array $data): bool;
    public function deleteAddress(int $user_id, int $id): int;
    public function setAddressToMain(int $user_id, int $id): bool;
}
