<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AddressRepositoryInterface
{
    public function insertNewAddress(User $user, mixed $data);

    public function getAllAddress(User $user);

    public function resetFieldMainForFalse(User $user);

    public function findById(User $user, int $id);

    public function updateAddress(User $user, array $data);

    public function deleteAddress(User $user, int $id);

    public function setAddressToMain(User $user, int $id);


}
