<?php

namespace App\Http\Controllers;

use App\Exceptions\AddressNotExistException;
use App\Http\Requests\AddAddressRequest;
use App\Http\Requests\UpdateAddressRequess;
use App\Http\Resources\AddressResource;
use App\Models\Address;
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
        $user = auth()->user();

        $addresses = $user->addresses;
        return AddressResource::collection($addresses);
    }

    public function store(AddAddressRequest $request)
    {
        $data = $request->validated();
        $created = $this->addressService->store($data);
        return AddressResource::collection($created);
    }

    public function show(Request $request)
    {
        $data = $request->validate(['id' => ['required', 'numeric'],]);
        $address = $this->addressService->show($data);
        return new AddressResource($address);

    }
    public function update(UpdateAddressRequess $request)
    {
        $data = $request->validated();
        $updated = $this->addressService->update($data);
        return AddressResource::collection($updated);
    }

    public function destroy(Request $request)
    {
        $data = $request->validate(['id' => ['required', 'numeric']]);

    }
}
