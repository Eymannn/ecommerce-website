<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;


class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::where('status', '<>', 'admin')->latest()->get();

        return view ('users', ['users'=> $users]);
    }
    public function verifyUser($id){
        $user = User::findOrFail($id);
        $user->status = 'verified';
        $user->save();

        return back()->with('success','user verified successfuly');
    }
    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'banned';
        $user->save();

        return back()->with('success','user banned successfuly');
    }
    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'waiting';
        $user->save();

        return back()->with('success','user unbanned successfuly');
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);
       
        $user = User::create($request->all());
        
       dd($user);
  
        
       
        return back()->with('success','saved');
    }
}

