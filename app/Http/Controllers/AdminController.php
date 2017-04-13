<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.index')->with('users', $users);
    }

    public function postUpdateRoles(Request $request, User $user)
    {
        if($user == Auth::user()) {
            if(!$request['role_admin']){
                notify()->flash('Don\'t fuck yourself up!', 'error', [
                    'timer' => 2000,
                    'noConfirm' => true,
                ]);
                return redirect()->back();
            }
        }

        $user->roles()->detach();

        if($request['role_normal']){
            $user->roles()->attach(Role::where('name', 'Normal')->first());
        }
        if($request['role_moderator']){
            $user->roles()->attach(Role::where('name', 'Moderator')->first());
        }
        if($request['role_admin']){
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }

        return redirect()->back();
    }

    public function getNewUser()
    {
        return view('admin.newUser');
    }

    public function postNewUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $new_user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $new_user->roles()->attach(Role::where('name', 'Normal')->first());

        notify()->flash('User created', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);

        return redirect()->route('admin.index');
    }
    public function getDeleteUser(User $user)
    {
        if($user == Auth::user()) {
            notify()->flash('Don\'t fuck yourself up!', 'error', [
                'timer' => 2000,
                'noConfirm' => true,
            ]);
            return redirect()->back();
        }

        $user->delete();

        notify()->flash('User deleted', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);

        return redirect()->route('admin.index');
    }
}
