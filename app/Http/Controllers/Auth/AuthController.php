<?php

namespace App\Http\Controllers\Auth;

use App\Mentor;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            if($account->mentor != null) {
                return redirect()->route('mentor.info');
            }
            if($account->student != null) {
                return redirect()->route('student.info');
            }
        }
        else {
            $account = User::create([
                'fbid' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar_url' => $user->getAvatar(),
            ]);
        }

        Auth::login($account);

        switch($target) {
            case 'mentor':
                Mentor::create([
                    'user_id' => $account->id
                ]);
                if($account->email != null) {
                    Mail::send(
                        'email.master',
                        [
                            'header' => 'Postao/la si Veliki Buraz!',
                            'paragraphs' => [
                                'Hvala ti na registraciji u našu bazu Velikih Buraza! Tvoj posao je zasada gotov, samo pričekaj da ti Mali Buraz bude dodijeljen nasumičnim odabirom. Mali Buraz će dobiti tvoje kontakt podatke s kojima ti se može javiti ako te ikad zatreba.',
                                'Proces dodjele može potrajati neko vrijeme ovisno o količini dostupnih Velikih Buraza te interesu Malih Buraza. Logiranjem u korisnički panel za Velike Buraze možeš provjeriti ukoliko ti je dodijeljen Mali Buraz.',
                            ]
                        ],
                        function ($message) use ($account) {
                            $message->from('noreply@foi.rocks', 'FOI Buraz');
                            $message->to($account->email, $account->name);
                            $message->subject('🎈Uspješno si se registrirao/la kao Veliki Buraz!');
                        }
                    );
                }
                return redirect()
                    ->route('mentor.profile')
                    ->with('info', 'Dopuni prazna polja i označi svoj korisnički račun kao aktivan da bi ušla/o u bazu velikih buraza!');
            case 'student':
                // Create student
                $student = Student::create([
                    'user_id' => $account->id
                ]);
                // Send welcome mail
                if($account->email != null) {
                    Mail::send(
                        'email.master',
                        [
                            'header' => 'Postao/la si Mali Buraz!',
                            'paragraphs' => [
                                'Hvala ti na registraciji u našu bazu Malih Buraza! Uskoro ćeš primiti mail s kontakt informacijama od tvog Velikog Buraza. Ukoliko imaš bilo kakvih pitanja, nemoj se ustručavati kontaktirati svog mentora/icu jer oni su se sami prijavili upravo kako bi tebi pomogli.',
                                'Kad primiš kontakt informacije o svom Velikom Burazu, možeš mu/joj se javiti i predstaviti jer oni nemaju tvoje kontakt informacije. Ovo nije obavezno, ali bi naravno bilo u skladu s bontonom. :)',
                            ]
                        ],
                        function ($message) use ($account) {
                            $message->from('noreply@foi.rocks', 'FOI Buraz');
                            $message->to($account->email, $account->name);
                            $message->subject('🎈Uspješno si se registrirao/la kao Mali Buraz!');
                        }
                    );
                }

                return redirect()
                    ->route('student.profile')
                    ->with('info', 'Dopuni prazna polja i spremi informacije o sebi!');
        }

        return redirect()
            ->route('homepage');
    }
}
