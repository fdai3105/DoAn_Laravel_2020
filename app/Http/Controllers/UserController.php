<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        if ($user) {
            $address = Address::find($user->address_id);
            if ($address) {
                $address->update($request->all());
                return response()->json(['status' => 'success']);
            } else {
                $address = Address::create($request->all());
                $user->update(['address_id' => $address->id]);
            }
        }
        return response()->json(['status' => 'error']);
    }
}
