<?php

namespace App\Services;

use App\Traits\ResponseService;
use Throwable;
use App\Models\User;
use App\Models\Address;
use App\Exceptions\ErrorSystem;
use App\Http\Resources\AddressResource;
use App\Exceptions\AddressNotExistException;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressService
{
    use ResponseService;
    public function __construct(
        private AddressRepositoryInterface $addressRepository
    ) {
    }

    public function getAllAddresses()
    {
        try {
            $user = auth()->user();
            $addresses = $this->addressRepository->getAllAddress($user->id);
            return $this->responseSuccess(['data' => AddressResource::collection($addresses)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get user shipping addresses');
        }
    }
    public function store(array $data)
    {
        try {
            $user = auth()->user();
            $this->addressRepository->createAddress(['user_id' => $user->id] + $data);
            $addresses = $this->addressRepository->getAllAddress($user->id);
            return $this->responseSuccess(['data' => AddressResource::collection($addresses)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when create new address');
        }
    }
    public function showAddress(int $id)
    {
        try {
            $user = auth()->user();
            $address = $this->addressRepository->findByIdAddress($user->id, $id);
            !$address ? throw new AddressNotExistException : null;
            return $this->responseSuccess(['data' => new AddressResource($address)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get address');
        }
    }
    public function updateAddress(array $data)
    {
        try {
            $user = auth()->user();
            $id_address = $data['id'];
            unset($data['id']);
            $address_updated = $this->addressRepository->updateAddress($user->id, $id_address, $data);
            return $address_updated ? $this->responseSuccess(['data' => new AddressResource($address_updated)]) : throw new ErrorSystem('error at update address from usuario');
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when update address');
        }
    }
    public function deleteAddress(int $id)
    {
        try {
            $user = auth()->user();
            $address_deleted = $this->addressRepository->deleteAddress($user->id, $id);
            return $address_deleted ?
                AddressResource::collection($this->addressRepository->getAllAddress($user->id)) :
                throw new ErrorSystem;
        } catch (Throwable $th) {
            return $this->responseError($th, "error at delete address from user");
        }
    }

    public function updateToMain(int $id)
    {
        try {
            $user = auth()->user();
            $address_updated = $this->addressRepository->setAddressToMain($user->id, $id);
            return $address_updated ?
                AddressResource::collection($this->addressRepository->getAllAddress($user->id)) :
                throw new ErrorSystem;
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when update address to main');
        }
    }


}
