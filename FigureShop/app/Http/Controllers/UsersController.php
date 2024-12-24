<?php

namespace App\Http\Controllers;


use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
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

        $request->validate(
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'address' => 'nullable|string|max:255',
                'phone' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không ít hơn :min ký tự',
                'max' => ':attribute không vượt quá :max ký tự',
                'email' => ':attribute không đúng định dạng',
                'unique' => ':attribute đã tồn tại',
                'in' => ':attribute không hợp lệ',
                'confirmed' => 'Mật khẩu không khớp',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'address' => 'Địa chỉ',
                'phone' => 'Số điện thoại',
                'password_confirmation' => 'Xác nhận mật khẩu',
            ]
        );

        $input = $request->only(['name', 'email', 'password', 'address', 'phone']);
        $input['password'] = bcrypt($input['password']);
        $input['isDeleted'] = 1;
        $input['status'] = "actived";

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
    public function edit(string $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            $flasher->addFlash('error', 'Người dùng không tồn tại', [], 'Thất bại');
            return redirect()->route('admin.users.list');
        }

        return view('admin.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        // Determine if the email has changed
        $emailRule = $request->email === $user->email ? 'required|email' : 'required|email|unique:users,email';

        // Validate request
        $request->validate(
            [
                'name' => 'required|string|max:100',
                'email' => $emailRule,
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|same:password',
                'phone' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute không ít hơn :min ký tự',
                'max' => ':attribute không vượt quá :max ký tự',
                'email' => ':attribute không đúng định dạng',
                'unique' => ':attribute đã tồn tại',
                'in' => ':attribute không hợp lệ',
                'confirmed' => 'Mật khẩu không khớp',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'phone' => 'Số điện thoại',
                'password_confirmation' => 'Xác nhận mật khẩu',
            ]
        );

        // Get input data
        $input = $request->only(['name', 'email', 'phone']);
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        }
        $input['isDeleted'] = 0;

        // Update the user
        $user->update($input);

        // Flash message
        if ($user->wasChanged()) {
            $flasher->addFlash('success', 'Cập nhật người dùng thành công!', [], 'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi khi cập nhật người dùng. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.users.list');
    }


    public function updateStatus(Request $request, $id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        $status = $request->status;
        $note = $request->note;

        $saveUser = $user->update([
            'status' => $status,
            'note' => $note
        ]);

        if ($saveUser) {
            $flasher->addFlash('success', 'Cập nhật trạng thái thành công', [], 'Thành công');
        } else {
            $flasher->addError('Đã xảy ra lỗi khi cập nhật trạng thái người dùng. Vui lòng thử lại.', [], 'Thất bại');
        }

        return redirect()->route('admin.users.list');
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

     public function search(Request $request)
    {
        $searchTerm = $request->input('search');
         $users = User::where('name', 'LIKE', "%{$searchTerm}%")
                          ->where('isDeleted', 0)
                          ->paginate(10);
        return view("admin.users.index", compact("users"));
    }
}
