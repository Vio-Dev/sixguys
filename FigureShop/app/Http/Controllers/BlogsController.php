<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $blogs = Post::with('user')
    ->where('isDeleted', 0)
    ->orderBy('created_at', 'DESC')
    ->paginate(5);


        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request, FlasherInterface $flasher)
{
    // Validate dữ liệu
    $request->validate(
        [
            'name' => 'required|min:5|unique:posts,name',
            'shortDecription' => "required|min:10",
            'description' => "required|min:10",
            'status' => "required",
            'thumbnail' => "required|image|mimes:jpg,jpeg,png,gif|max:2048",
        ],
        [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không ít hơn :min',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute chỉ hỗ trợ định dạng jpg, jpeg, png, gif',
            'max' => ':attribute không được lớn hơn :max KB',
            'unique' => ':attribute đã tồn tại. Vui lòng chọn tên khác.',
        ],
        [
            'name' => 'Tiêu đề bài viết',
            'shortDecription' => 'Mô tả ngắn',
            'description' => 'Nội dung bài viết',
            'status' => "Trạng thái",
            'thumbnail' => "Ảnh đại diện"
        ]
    );

    // Lấy user hiện tại
    $user = auth()->user();

    // Lấy input và thêm user_id (loại bỏ _token)
    $input = $request->except('_token');
    $input['user_id'] = $user->id;

    // Xử lý file upload
    if ($request->hasFile('thumbnail')) {
        $image = $request->file('thumbnail');
        if ($image->isValid()) {
            // Tạo tên file duy nhất
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Di chuyển file đến thư mục đích
            $image->move(public_path('uploads/posts'), $imageName);

            // Gắn đường dẫn vào input
            $input['thumbnail'] = 'uploads/posts/' . $imageName;
        } else {
            return back()->withErrors(['thumbnail' => 'Lỗi upload file.']);
        }
    }


    // Lưu bài viết vào DB
    $post = Post::create($input);

    // Thông báo thành công
    $flasher->addFlash('success', 'Bài đăng đã được thêm thành công!', [], 'Thành công');
    return redirect()->route("admin.blogs.list");
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
        $post = Post::findOrFail($id);
        return view('admin.blogs.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, FlasherInterface $flasher, $id)
{
    // Validate dữ liệu
    $request->validate(
        [
            'name' => 'required|min:5|unique:posts,name,' . $id,
            'shortDecription' => "required|min:10",
            'description' => "required|min:10",
            'status' => "required",
            'thumbnail' => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
        ],
        [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không ít hơn :min',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute chỉ hỗ trợ định dạng jpg, jpeg, png, gif',
            'max' => ':attribute không được lớn hơn :max KB',
            'unique' => ':attribute đã tồn tại. Vui lòng chọn tên khác.',
        ],
        [
            'name' => 'Tiêu đề bài viết',
            'shortDecription' => 'Mô tả ngắn',
            'description' => 'Nội dung bài viết',
            'status' => "Trạng thái",
            'thumbnail' => "Ảnh đại diện"
        ]
    );

    // Lấy bài viết từ DB
    $post = Post::findOrFail($id);

    // Lấy input và loại bỏ _token
    $input = $request->except('_token');

    // Xử lý file upload nếu có
    if ($request->hasFile('thumbnail')) {
        $image = $request->file('thumbnail');
        if ($image->isValid()) {
            // Xóa ảnh cũ nếu tồn tại
            if (!empty($post->thumbnail) && file_exists(public_path($post->thumbnail))) {
                unlink(public_path($post->thumbnail));
            }

            // Tạo tên file duy nhất
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Di chuyển file đến thư mục đích
            $image->move(public_path('uploads/posts'), $imageName);

            // Gắn đường dẫn vào input
            $input['thumbnail'] = 'uploads/posts/' . $imageName;
        } else {
            return back()->withErrors(['thumbnail' => 'Lỗi upload file.']);
        }
    }

    // Cập nhật bài viết trong DB
    $post->update($input);

    // Thông báo thành công
    $flasher->addFlash('success', 'Bài đăng đã được cập nhật thành công!', [], 'Thành công');
    return redirect()->route("admin.blogs.list");
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, FlasherInterface $flasher)
    {
        $blogs = Post::findOrFail($id);
        if ($blogs->update(['isDeleted' => 1])) {
            $flasher->addFlash('success', 'Bài đăng đã được cập nhật thành công!',[],'Thành công');
        } else {
            $flasher->addFlash('error', 'Đã xảy ra lỗi xóa. Vui lòng thử lại.',[],'Thất bại');
        }

        // Chuyển hướng về danh sách danh mục
        return redirect()->route('admin.blogs.list');
    }
     public function search(Request $request)
    {
        $searchTerm = $request->input('search');
         $blogs = Post::where('name', 'LIKE', "%{$searchTerm}%")
                          ->where('isDeleted', 0)
                          ->paginate(10);
        return view("admin.blogs.index", compact("blogs"));
    }
}
