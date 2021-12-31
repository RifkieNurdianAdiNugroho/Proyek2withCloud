<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = User::where('role', 'pembeli')->get();
        return view('admin.buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buyers.create');
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
            'role' => 'pembeli',
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('buyers.index');
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
    public function edit(User $buyer)
    {
        return view('admin.buyers.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $buyer)
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

            $buyer->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $buyer->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        UserDetail::where('user_id', $buyer->id)->update([
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('buyers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $buyer)
    {
        $buyer->userDetail->delete();
        $buyer->delete();
        return redirect()->route('buyers.index');
    }
}
