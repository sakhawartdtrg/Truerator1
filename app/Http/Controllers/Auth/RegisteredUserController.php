<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Database\Role;
use Silber\Bouncer\Database\Ability;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mobile' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]));


        $user->update(['relation_id'=>$user->id]);
        event(new Registered($user));
        $roles = Role::where('relation_id',1)->get();

        foreach($roles as $role){
            $inserted = Role::create(['relation_id'=>$user->id,'name'=>$role->name,'title'=>$role->title]);
            if($role->name == "account_owner"){
                $user->assign($inserted->id);
                $permissions = Ability::get();
                foreach($permissions as $permission){
                    $inserted->allow($permission->name);
                }
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
