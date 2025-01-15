<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request, FlasherInterface $flasher): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password' => 'Mật khẩu cũ không được để trống',
            'current_password.current_password' => 'Mật khẩu cũ không khớp',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $flasher->addFlash('success', 'Cập nhật mật khẩu thành công!', [], 'Thành công');

        return back()->with('status', 'password-updated');
    }
}
