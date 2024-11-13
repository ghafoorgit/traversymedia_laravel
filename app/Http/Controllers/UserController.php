<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest()->filter(request('search_files'))->get();

        if ($request->filled('search_field') && $request->filled('search_query')) {
            $field = $request->input('search_field');
            $searchQuery = $request->input('search_query');

            if (in_array($field, ['name', 'email', 'lastname'])) {
                $query->where($field, 'LIKE', "%{$searchQuery}%");
            }
        }

        $users = $query->paginate(10);

        return view('users', compact('users'));
    }

    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>['required'],
            'email'=>['required', 'email', Rule::unique('users','email')],
            'password' =>['required','confirmed','min:6']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user =  User::create($formFields);
        Auth::login($user);
        return redirect('/')->with('message','User created & logged in');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out!');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $validateUser = $request->validate([
            'email' =>['required','email'],
            'password'=>['required']
        ]);
        if(Auth::attempt($validateUser)){
            $request->session()->regenerateToken();
            return redirect('/')->with('message','You are now logged in!');
        }
        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
    }
}
