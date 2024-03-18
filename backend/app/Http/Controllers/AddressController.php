<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAddressRequest;
use App\Http\Requests\UpdateAddressRequess;
use App\Http\Resources\AddressResource;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct(
        private AddressService $addressService,
    ) {
        $this->middleware(['auth:sanctum']);
    }
    public function index()
    {
        return $this->addressService->getAllAddresses();
    }

    public function store(AddAddressRequest $request)
    {
        $data = $request->validated();
        return $this->addressService->store($data);

    }

    public function show(Request $request)
    {
        $data = $request->validate(['id' => ['required', 'numeric'],]);
        return $this->addressService->showAddress($data['id']);

    }

    public function update(UpdateAddressRequess $request)
    {
        $data = $request->validated();
        return $this->addressService->updateAddress($data);

    }

    public function destroy(Request $request)
    {
        $data = $request->validate(['id' => ['required', 'numeric']]);
        return $this->addressService->deleteAddress($data);

    }

    public function mainAddress(Request $request)
    {
        $data = $request->validate(['id' => ['required', 'numeric']]);
        return $this->addressService->updateToMain($data['id']);

    }
}
