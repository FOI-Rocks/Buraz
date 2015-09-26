<?php

namespace App\Http\Controllers\Auth;

use App\Mentor;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', array('except' => 'getLogout'));
    }

    /**
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request)
    {
        $target = $request->session()->get('target');
        $user = Socialite::driver('facebook')->user();

        $account = User::where('fbid', $user->getId())->first();

        if($account != null) {
            Auth::login($account);
            if(Auth::user()->mentor_id != null) {
                return redirect()->route('mentor.info');
            }
            if(Auth::user()->student_id != null) {
                return redirect()->route('student.info');
            }
        }

        $account = User::create([
            'fbid' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar_url' => $user->getAvatar(),
        ]);

        Auth::login($account);

        switch($target) {
            case 'mentor':
                Mentor::create([
                    'user_id' => $account->id
                ]);
                return redirect()
                    ->route('mentor.profile')
                    ->with('info', 'Dopuni prazna polja i označi svoj korisnički račun kao aktivan da bi ušla/o u bazu velikih buraza!');
            case 'student':
                Student::create([
                    'user_id' => $account->id
                ]);
                return redirect()
                    ->route('student.profile')
                    ->with('info', 'Dopuni prazna polja i spremi informacije o sebi!');
        }

        return redirect()
            ->route('homepage');
    }
}
