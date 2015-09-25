<?php

namespace App\Http\Controllers\Mentor;

use App\Mentor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class MentorController extends Controller
{
    public function __construct(Request $request)
    {
        $request->session()->put('target', 'mentor');
    }

    public function showLogin() {
        return view('mentor.login');
    }

    public function doLogin() {
        return redirect()->route('auth.facebook');
    }

    public function showProfile() {
        return view('mentor.profile')
            ->with('user', Auth::user())
            ->with('mentor', Auth::user()->mentor);
    }

    public function storeProfile() {
        $user = Auth::user();

        // Save User model changes
        $input = Input::only(['name', 'email', 'study_id']);
        $validator = Validator::make($input, User::$validation);
        if($validator->fails()) {
            return redirect()
                ->route('mentor.profile')
                ->withErrors($validator);
        }
        $user->fill($input);
        $user->save();

        // Save Mentor model changes
        $input = Input::only(['phone', 'visible']);
        if($input['visible'] != 1) $input['visible'] = 0;
        $validator = Validator::make($input, Mentor::$validation);
        if($validator->fails()) {
            return redirect()
                ->route('mentor.profile')
                ->withErrors($validator);
        }
        $user->mentor->fill($input);
        $user->mentor->save();

        return redirect()
            ->route('mentor.profile');
    }

    public function showInfo() {
        $littleBros = Auth::user()->mentor->littleBros();
        return view('mentor.info')
            ->with('littleBros', $littleBros);
    }
}
