<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DailyWork;
use App\Models\ElchiBall;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\ElchiExercise;
use App\Models\Exercise;
use App\Models\ElchiLevel;
use App\Models\ElchiElexir;
use App\Models\News;
use App\Models\NewUserOneMonth;
use App\Models\Shift;
use App\Models\TeacherUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {


        $this->validateLogin($request);


        $uuu = DB::table('tg_user')
            ->where('username', $request->username)
            ->where('pr', $request->password)
            ->first();

//        return $uuu;

        $update = DB::table('tg_user')
            ->where('username', $request->username)->where('pr', $request->password)
            ->update([
                'password' => Hash::make($request->password),
            ]);


        if ($uuu) {

            $user_id = $uuu->id;

            Session::put('userme',$uuu);

            if ($uuu->status == 2) {
                return redirect('/login');
            }

            // $status = User::where('id', $user_id)->first();

            if ($uuu->rm == 0) {


                $teacher_user = TeacherUser::where('user_id', $user_id)->get();
//                return $teacher_user;

                if (count($teacher_user) == 1 && $uuu->status == 0) {
//return $teacher_user[0];

                    $shifts = Shift::whereDate('open_date', '<=', date('Y-m-d'))
                        ->whereDate('open_date', '>=', $teacher_user[0]->week_date)
                        ->where('user_id', $user_id)->where('active',2)->orderBy('id', 'ASC')->get();

//                    return $shifts;
                    if (count($shifts) >= 7) {
                        $rrr = 0;
                        $rrr3 = 0;
                        foreach ($shifts as $key => $value) {

                            $sum = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                                ->whereDate('tg_productssold.created_at', '=', $value->open_date)
                                ->where('tg_productssold.user_id', $user_id)
                                ->get()[0]->allprice;

                            if ($sum == NULL) {
                                $sum = 0;
                            }

                            $rrr = $rrr + $sum;

                            if ($sum >= 300000) {
                                $rrr3 = $rrr3 + 1;
                            }
                        }



                        if ($rrr >= getShogirdPlan() && ($rrr3 >= 3)) {
                            $update = DB::table('tg_user')->where('id', $user_id)->update([
                                'status' => 1,
                                'work_start' => date('Y-m-d')
                            ]);

                            $new_one_month = new NewUserOneMonth([
                                'user_id' => $user_id
                            ]);

                            $new_one_month->save();

                            $teacher_id = TeacherUser::where('user_id', $user_id)->first()->teacher_id;

                            $shogird = User::find($user_id);
                            $ustoz = User::find($teacher_id);

                            $title = "Yangi elchi ishga qabul qilindi.";
                            $des = $shogird->last_name.' '.$shogird->first_name.' 7 kunlik sinov muddatida ustozi'
                            .' '.$ustoz->last_name.' '.$ustoz->first_name.'dan bilim,tajriba,konikmalarni oldi va ishga qabul qilindi.Ustoziga 200 ming premya elon qilindi';
                            $desc = "<div>
                                        <h2 class='text-center my-3'>$title</h2>
                                        <br/>
                                        $des
                                    </div>";

                            News::create([
                                'title' => $title,
                                'img' => "https://matrix.novatio.uz/news/imgs/2023-05-13:07:05:324.png",
                                "desc" => $desc,
                                "publish" => True,
                            ]);

                        } else {
                            $update = DB::table('tg_user')->where('id', $user_id)->update([
                                'status' => 4,
                            ]);
                        }
                    }
                }
                // if (count(getShogirdStar()) == 1 &&  getTestReview() == 0) {
                // }

                $user = ElchiExercise::where('user_id', $user_id)->get();
                if (count($user) == 0) {
                    $exercise = Exercise::all();
                    foreach ($exercise as $key => $value) {
                        $new = new ElchiExercise([
                            'user_id' => $user_id,
                            'exercise_id' => $value->id,
                        ]);
                        $new->save();
                    }
                }
                $level = ElchiLevel::where('user_id', $user_id)->get();
                if (count($level) == 0) {
                    $new = new ElchiLevel([
                        'user_id' => $user_id,
                        'level' => 1,
                    ]);
                    $new->save();
                }
                $elexir = ElchiElexir::where('user_id', $user_id)->get();
                if (count($elexir) == 0) {
                    $new = new ElchiElexir([
                        'user_id' => $user_id,
                    ]);
                    $new->save();
                }
                $ball = ElchiBall::where('user_id', $user_id)->get();
                if (count($ball) == 0) {
                    $new = new ElchiBall([
                        'user_id' => $user_id,
                        'ball' => 100,
                        'active' => 0,
                    ]);
                    $new->save();
                }
            }
        }
        // return $new;

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLoginP($request)) {

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function provizor(Request $request)
    {





        $user_id = User::where('pr', $request->password)->value('id');

        // Hash::make($academy->parol),

        if ($user_id) {

            $uuu = User::find($user_id);

            Session::put('userme',$uuu);

            $uuu = DB::table('tg_user')
            ->where('pr', $request->password)
            ->first();
            if ($uuu->specialty_id != 9) {
                return redirect('/provizor');
            }
                $user = ElchiExercise::where('user_id', $user_id)->get();
                if (count($user) == 0) {
                    $exercise = Exercise::all();
                    foreach ($exercise as $key => $value) {
                        $new = new ElchiExercise([
                            'user_id' => $user_id,
                            'exercise_id' => $value->id,
                        ]);
                        $new->save();
                    }
                }
                $level = ElchiLevel::where('user_id', $user_id)->get();
                if (count($level) == 0) {
                    $new = new ElchiLevel([
                        'user_id' => $user_id,
                        'level' => 1,
                    ]);
                    $new->save();
                }
                $elexir = ElchiElexir::where('user_id', $user_id)->get();
                if (count($elexir) == 0) {
                    $new = new ElchiElexir([
                        'user_id' => $user_id,
                    ]);
                    $new->save();
                }
                $ball = ElchiBall::where('user_id', $user_id)->get();
                if (count($ball) == 0) {
                    $new = new ElchiBall([
                        'user_id' => $user_id,
                        'ball' => 100,
                        'active' => 0,
                    ]);
                    $new->save();
                }

        }
        // return $new;

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLoginProv($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    // protected function attemptLogin(Request $request)
    // {
    //     return $this->guard()->attempt(
    //         $request->boolean('remember')
    //     );
    // }

    protected function attemptLoginP(Request $request)
    {


        $username = User::where('pr',$request->password)->where('username',$request->username)->first();

        // dd($username);


        $arr = array('id' => $username->id,'password' => $request->password);


        // $this->credentialsProviz($request),


        return $this->guard()->attempt(

            $arr,

            $request->boolean('remember')
        );
    }

    protected function attemptLoginProv(Request $request)
    {


        $username = User::where('pr',$request->password)->first();

        // dd($username);


        $arr = array('password' => $request->password);


        // $this->credentialsProviz($request),


        return $this->guard()->attempt(

            $arr,

            $request->boolean('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function credentialsProviz(Request $request)
    {
        return $request->only('password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }


    public function redirectPath()
    {
        // if(Auth::user()->approved == 0)
        // {
        //     return '/login';
        // }

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // return 123;

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $this->maxAttempts()
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),
            $this->decayMinutes() * 60
        );
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input($this->username())) . '|' . $request->ip());
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}
