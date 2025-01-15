<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, FlasherInterface $flasher): RedirectResponse
    {
        $request->validate(
            [
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'token.required' => 'Token không hợp lệ',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.confirmed' => 'Mật khẩu không khớp',
                'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự',
            ]
        );

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            $flasher->addFlash('success', 'Mật khẩu đã được đặt lại thành công!', [], 'Thành công');

            return redirect()->route('login')->with('status', __($status));
        } else {
            $flasher->addFlash('error', 'Đặt lại mật khẩu thất bại', [], 'Thất bại');
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        }
    }
}
