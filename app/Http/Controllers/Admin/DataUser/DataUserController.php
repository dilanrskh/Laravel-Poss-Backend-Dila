<?php

namespace App\Http\Controllers\Admin\DataUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    public function dataUser(){

        $user = User::all();
        return view('Admin.DataUser.indexDataUser', compact('user'));
    }

    public function dataUserForm(){
        return view('Admin.DataUser.createdataUser');
    }

    public function dataUserCreate(Request $request){
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => 3,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index.dataUser')->with('Create', "Data User $request->name berhasil disimpan");
    }

    public function dataUserDelete(Request $request){
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->back()->with('Delete', "Data User $request->name berhasil dihapus");
    }

    public function dataUserSeacrh(){
        
    }
}
