<?php

namespace App\Http\Controllers;

use App\Event\VerifyPasscodeEvent;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ConfirmPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\VerifyPasscodeRequest;
use App\Mail\Passcode;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
   public function __construct()
   {
      $this->middleware(['auth:web'])->only(['logout', 'verify_password']);
      $this->middleware('check.session:verify_email')->only('verify_email');
      $this->middleware('check.session:change_password')->only('change_password');
   }

   /**
    * Return login page
    *
    * @return mixed
    */
   public function login(): mixed
   {
      session()->put('verify_email', true);

      if(session()->has('change_password'))
         session()->forget('change_password');
      if(session()->has('original_passcode'))
         session()->forget('original_passcode');
      if(session()->has('verified_email'))
         session()->forget('verified_email');

      return view('auth.login');
   }

   /**
    * Verify if a user exists
    *
    * @param \App\Http\Requests\Auth\LoginRequest $request
    * @return mixed
    */
   public function login_handler(LoginRequest $request): mixed
   {
      if (!auth()->guard('web')->attempt($request->validated()))
         return back()->withInput()
            ->withErrors(['message' => 'Either email or password is incorrect']);

      request()->session()->regenerate();

      return redirect()->intended(route('home.index'));
   }

   /**
    * Return the verify email page
    *
    * @return mixed
    */
   public function verify_email(): mixed
   {
      return view('auth.verify-email');
   }

   /**
    * Verify a user's email
    *
    * @param \App\Http\Requests\Auth\VerifyEmailRequest $request
    * @return mixed
    */
   public function verify_email_handler(VerifyEmailRequest $request): mixed
   {
      $pass_code = mt_rand(1000, 9999);

      session()->put([
         'original_passcode' => $pass_code,
         'verified_email' => $request->validated()['email'],
      ]);

      $code = session('original_passcode');
      // Mail::to($request->validated()['email'])->send(new Passcode($code));
      event(new VerifyPasscodeEvent($request->validated()['email'], $code));

      return response()->json(['message' => 'Email verified successfully']);
   }

   /**
    * Change a user's password
    *
    * @param \App\Http\Requests\Auth\VerifyPasscodeRequest $request
    * @return mixed
    */
   public function verify_passcode(VerifyPasscodeRequest $request): mixed
   {
      session()->forget(['verify_email', 'original_passcode']);
      session()->put(['change_password' => true]);
      
      return response()->json(['message' => route('auth.change_password')]);
   }
   
   /**
    * Return the confirm password page
    *
    * @return mixed
    */
   public function confirm_password() :mixed
   {
      return view('auth.confirm-password');
   }
   
   /**
    * Confirm the looged-in user's password
    *
    * @return mixed
    */
   public function confirm_password_handler(ConfirmPasswordRequest $request) :mixed
   {
      if (!Hash::check($request->validated()['password'], auth()->user()->password)){
         return back()->withErrors([
         'password' => ['The provided password is incorrect'],
         ]);
      }

      session()->put(['change_password' => true]);

      return view('auth.change-password');
   }

   /**
    * Return the change password page
    *
    * @return mixed
    */
   public function change_password(): mixed
   {
      return view('auth.change-password');
   }

   /**
    * Check if both password's match
    * 
    * @param \App\Http\Requests\Auth\ChangePasswordRequest $request
    * @return mixed
    */
   public function change_password_handler(ChangePasswordRequest $request): mixed
   {
      Admin::where('email', session('verified_email') ?? auth()->user()->email)
      ->update(['password' => bcrypt($request->validated()['password']) ]);
      
      session()->forget(['verified_email', 'change_password']);

      return to_route('auth.login');
   }

   /**
    * Logout out a logged-in user
    *
    * @param \Illuminate\Http\Request $request
    * @return mixed
    */
   public function logout(Request $request): mixed
   {
      Auth::guard('web')->logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return to_route('home.index');
   }
}
