@extends('layouts.app')

@section('title', 'Chi tiết bài viết')

@section('content')
    <div>
        <section class="flex-grow text-left">
            <div class="mt-6 flex flex-col gap-3">
                <img class="mx-auto w-[200px]" src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}" />
                <h1 class="text-2xl font-bold text-center">{{ $post->name }}</h1>
                <p class=" font-bold text-center">{{ $post->shortDecription }}</p>
            </div>

            <div class="mx-auto my-10 px-5">
                {!! $post->description !!}

            </div>
            <div>
                <p>{{ format_posts_status($post->status) }} vào
                    {{ $post->created_at->format('d/m/Y') }} </p>
                <h1 class="text-left text-sm">tác giả {{ $post->user->name }}</h1>
            </div>
        </section>
        <div>
            <!-- Bình luận đánh giá -->
            <h3>Bình luận</h3>
            <form action="{{ route('postsComments', ['id' => $post->id]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="sr-only">Đánh giá</label>
                    <div id="rating" class="flex space-x-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}"
                                class="hidden">
                            <label for="rating-{{ $i }}" class="cursor-pointer">
                                <i data-rating="{{ $i }}" class="fa fa-star text-gray-400"></i>
                            </label>
                        @endfor
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <div class="mb-4">
                    <label for="comment" class="sr-only">Bình luận</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full p-2 border rounded"
                        placeholder="Viết bình luận của bạn..." required></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Gửi</button>
            </form>

            <div class="mt-6">
                @foreach ($comments as $comment)
                    <div class="mb-4 border-b pb-2">
                        <p><strong>{{ $comment->user->name ?? 'Người dùng ẩn danh' }}</strong>:</p>
                        <p>{{ $comment->comment }}</p>
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star {{ $i <= $comment->rating ? 'text-yellow-500' : 'text-gray-400' }}"
                                    aria-hidden="true"></i>
                            @endfor
                        </div>
                        <p>{{ $comment->created_at->format('d/m/Y') }}</p>
                        <div>
                            <!-- Xóa bình luận -->
                            <form method="POST" action="{{ route('postsCommentsDelete', ['id' => $comment->id]) }}">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="post_id" value="{{ $comment->id }}" hidden>
                                <button onclick="confirmDelete(this)" type="button" class="text-red-500">Xóa</button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('#rating .fa-star');
            let selectedRating = 0;

            stars.forEach(star => {
                // Highlight stars only when clicked
                star.addEventListener('click', () => {
                    selectedRating = star.getAttribute('data-rating');
                    document.getElementById(`rating-${selectedRating}`).checked = true;
                    highlightStars(selectedRating);
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    const starValue = star.getAttribute('data-rating');
                    if (starValue <= rating) {
                        star.classList.remove('text-gray-400');
                        star.classList.add('text-yellow-500');
                    } else {
                        star.classList.remove('text-yellow-500');
                        star.classList.add('text-gray-400');
                    }
                });
            }
        });
    </script>
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng xác nhận, submit form
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
