<?php

namespace App\Services;

use App\Exceptions\AddressNotExistException;
use App\Exceptions\ErrorSystem;
use App\Http\Resources\AddressResource;
use Throwable;
use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressService
{

  public function __construct(
    private AddressRepositoryInterface $addressRepository
  ) {
  }

  public function getAllAddresses()
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      return AddressResource::collection($this->addressRepository->getAllAddress($user));
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

    }
  }
  public function store(array $data)
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $created = $this->addressRepository->insertNewAddress($user, $data);
      return $created ?
        AddressResource::collection($this->addressRepository->getAllAddress($user)) :
        throw new ErrorSystem;
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }

  }
  public function showAddress(int $id)
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $address = $this->addressRepository->findById($user, $id);
      if (!$address)
        throw new AddressNotExistException;
      return new AddressResource($address);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }
  }


  public function updateAddress(array $data)
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $address = $this->addressRepository->findById($user, $data['id']);
      !$address ? throw new AddressNotExistException() : null;
      $updated = $this->addressRepository->updateAddress($user, $data);
      return $updated ?
        AddressResource::collection($this->addressRepository->getAllAddress($user)) :
        throw new ErrorSystem;
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

    }
  }


  public function deleteAddress(array $data)
  {
    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $address = $this->addressRepository->findById($user, $data['id']);
      if (!$address)
        throw new AddressNotExistException();
      $deleted = $this->addressRepository->deleteAddress($user, $address->id);
      return $deleted ?
        AddressResource::collection($this->addressRepository->getAllAddress($user)) :
        throw new ErrorSystem;
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore

    }
  }


  public function updateToMain(int $id)
  {

    try {
      /** @var \App\Models\User $user */
      $user = auth()->user();
      $address = $this->addressRepository->findById($user, $id);
      !$address ? throw new AddressNotExistException() : null;
      $updated = $this->addressRepository->setAddressToMain($user, $id);
      return $updated ?
        AddressResource::collection($this->addressRepository->getAllAddress($user)) :
        throw new ErrorSystem;
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400); // phpcs:ignore
    }
  }

  public function responseError(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => $data,
    ], $code);
  }
}

