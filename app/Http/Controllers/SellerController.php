<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = User::where('role', 'penjual')->with('userDetail')->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'penjual',
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('sellers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $seller)
    {
        return view('admin.sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $seller)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $seller->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $seller->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        UserDetail::where('user_id', $seller->id)->update([
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('sellers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $seller)
    {
        $seller->userDetail->delete();
        $seller->delete();
        return redirect()->route('sellers.index');
    }
}
