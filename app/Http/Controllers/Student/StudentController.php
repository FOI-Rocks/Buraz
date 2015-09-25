<?php

namespace App\Http\Controllers\Student;

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

class StudentController extends Controller
{
    public function __construct(Request $request)
    {
        $request->session()->put('target', 'student');
    }

    public function showLogin() {
        return view('student.login');
    }

    public function doLogin() {
        return redirect()->route('auth.facebook');
    }

    public function showProfile() {
        return view('student.profile')
            ->with('user', Auth::user());
    }

    public function storeProfile() {
        $user = Auth::user();

        // Save User model changes
        $input = Input::only(['name', 'email', 'study_id']);
        $validator = Validator::make($input, User::$validation);
        if($validator->fails()) {
            return redirect()
                ->route('student.profile')
                ->withErrors($validator);
        }
        $user->fill($input);
        $user->save();

        return redirect()
            ->route('student.profile');
    }

    public function showInfo() {
        return view('student.info')
            ->with('mentor', Auth::user()->student->bigBro());
    }
}
