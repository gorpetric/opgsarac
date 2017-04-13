<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only(['email', 'password']))){
            notify()->flash('Pogrešni korisnički podaci', 'error', [
                'timer' => 3000,
                'noConfirm' => true,
            ]);
            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'password_repeat' => 'required|same:password'
        ]);

        $new_user = User::create([
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'password' => bcrypt($request->input('password')),
        ]);

        $new_user->roles()->attach(Role::where('name', 'Normal')->first());

        notify()->flash('Vaš račun je kreirani. Možete se prijaviti.', 'success');
        return redirect()->route('auth.login');
    }

    public function contact()
    {
        return view('contact');
    }

    public function postContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'message' => 'required',
        ]);

        Mail::send('email.contact', ['data' => $request->all()], function($m) use($request) {
            $m->from('info@opgsarac.hr', 'OPG Sarac - web stranica');
            $m->to('opgsarac.ck@gmail.com');
            $m->subject('OPG Sarac (kontakt forma) - '.$request->input('title'));
        });

        notify()->flash('Zahvaljujemo!', 'success', [
            'timer' => 3000,
            'noConfirm' => true,
        ]);
        return redirect()->route('contact.index');
    }
}
