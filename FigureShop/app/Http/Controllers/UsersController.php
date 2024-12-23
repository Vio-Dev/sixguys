<?php

namespace App\Http\Controllers;


use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('isDeleted', 0)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {

        $password = $request->input('password');
        $passwordConfirm = $request->input('passwordConfirm');

        // $request->validate(
        //     [
        //         'name' => 'required|string|max:100',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|min:6|',
        //         'address' => 'nullable|string|max:255',
        //         'phone' => 'required',
        //     ],
        //     [
        //         'required' => ':attribute không được để trống',
        //         'min' => ':attribute không ít hơn :min ký tự',
        //         'max' => ':attribute không vượt quá :max ký tự',
        //         'email' => ':attribute không đúng định dạng',
        //         'unique' => ':attribute đã tồn tại',
        //         'in' => ':attribute không hợp lệ',
        //     ],
        //     [
        //         'name' => 'Tên người dùng',
        //         'email' => 'Email',
        //         'password' => 'Mật khẩu',
        //         'address' => 'Địa chỉ',
        //         'phone' => 'Số điện thoại',
        //     ]
        // );

        $input = $request->only(['name', 'email', 'password', 'address', 'phone']);
        $input['password'] = bcrypt($input['password']);
        $input['isDeleted'] = 0;

        $user = User::create($input);

        if ($user) {
            $flasher->addFlash('success', 'Thêm người dùng', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi Thêm người dùng. Vui lòng thử lại.', [], 'Thất bại');
        }
        return redirect()->route('admin.users.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);
        $user->isDeleted = 1;
        $saveUser = $user->save();

        $currentUser = auth()->user();

        if ($currentUser && $currentUser->id == $id) {
            $flasher->addFlash('error', 'Không thể xóa chính mình', [], 'Thất bại');
        }

        if ($saveUser) {
            $flasher->addFlash('success', 'Xóa người dùng', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi xóa người dùng. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.users.list');
    }
}
