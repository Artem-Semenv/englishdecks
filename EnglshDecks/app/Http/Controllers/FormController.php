<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class FormController extends Controller
{
    public function register(Request $request)
    {

        $user = DB::table('users')->where('email', $request->get('email'))->first();
        if (!isNull($user)){
            return view('register', ['register' => true, "login" => false, "error" => "This email already exist!"]);
        }
        DB::table('users')->insert(
            array(
                'name' => $request->get('username'),
                'email' => $request->get('email'),
                'email_verified_at' => now(),
                'password' => $request->get('password'),
            )
        );
        return view('form', ['register' => false, "login" => true, 'page_name' => 'Register']);
    }

    public function login(Request $request)
    {

        $user = User::query()->where('email', $request->get('email'))->first();
        if (!$user){
            return view('form', ['register' => false, "login" => true, "error" => "This user doesn't exist!"]);
        }elseif ($user->password == $request->get('password')){
            Auth::login($user);
            $decks = Deck::all();
            return view('groups.decks', ['items' => $decks]);
        }
        return view('form', ['register' => false, "login" => true, "error" => "Something wrong!", 'page_name' => 'Login']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
