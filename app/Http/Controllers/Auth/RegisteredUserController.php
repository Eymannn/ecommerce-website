<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserableType;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use App\Utils\Utils;
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
    public function create($userableType): View
    {
        return view('auth.register', ['userableType' => $userableType]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $userableType): RedirectResponse
    {
        $user =  $request->validate([
            'postal_code' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        if ($userableType === UserableType::CUSTOMER) {
            $userable =   Customer::create(
                [
                    'postal_code' => $request['postal_code'],
                    'city' => $request['city'],
                    'address' => $request['address'],   
                ]
            );

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'userable_id' => $userable->id,
                'userable_type' => $userableType,
            ]);
        }

        
        elseif ($userableType === UserableType::SELLER) {
            $userable =   Seller::create(
                [
                    'postal_code' => $request['postal_code'],
                    'city' => $request['city'],
                    'address' => $request['address'],   
                ]
            );

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'userable_id' => $userable->id,
                'userable_type' => $userableType,
            ]);
        }
        




        event(new Registered($user));

        Auth::login($user);

        
        return redirect(route('dashboard', absolute: false));
    }
}
