<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BadgesController extends Controller
{
    //

   

    public function store(Request $request, $id ) 
    {
        
     $user = User::findOrFail($id);
    
     $user->create($request->all() + ['user_id' => $user->id]);

     


    return redirect('/admin/user');
    }
}
