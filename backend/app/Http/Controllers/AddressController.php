<?php

namespace App\Http\Controllers;

use App\Exceptions\AddressNotExistException;
use App\Http\Requests\AddAddressRequest;
use App\Http\Requests\UpdateAddressRequess;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return $user->addresses->makeHidden(['created_at', 'user_id']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAddressRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $created = $user->addresses()->create($data);
        return $created;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $user = auth()->user();
        $address = Address::where('id', $data['id'])->where('user_id', $user->id)->get();
        return $address->isEmpty() ? throw new AddressNotExistException() : $address;

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequess $request)
    {
        $data = $request->validated();

        $user = auth()->user();
        $address = $user->addresses()->where('id', $data['id'])->first();
        return (!$address) ?
            throw new AddressNotExistException() :
            (
                $address->update($data) ?
                $address->fresh() :
                throw new \Exception('error a update address')
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $user = auth()->user();
        $address = $user->addresses()->where('id', $data['id'])->first();

        return (!$address) ?
            throw new AddressNotExistException() :
            ($address->delete() ? $user->addresses()->get() : throw new \Exception('error a update address'));
    }
}
