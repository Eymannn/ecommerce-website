<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserableType;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request , UserableType $userableType): RedirectResponse
    {


      $user =  $request->validate([
            'postal_code' => ['required'],
            'city' => ['required'],
            'address'=>['required' , 'address'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if($userableType == 'customer')
        {
            $customer =   Customer::create([
                'postal_code' =>'test',
                'city' =>'test',
                'address' =>'test',
            ]);

            return $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'userable_id' => $customer->id,
                'userable_type' => Customer::class,
            ]);

        }

        elseif($userableType == 'seller')
        {
                $seller =   Customer::create([
            'postal_code' =>'test',
            'city' =>'test',
            'address' =>'test',
        ]);

        return $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'userable_id' => $seller->id,
            'userable_type' => Seller::class,
        ]);
    }



        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
