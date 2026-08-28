<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Yorum Kaydetme Metodu
    public function store(Request $request, Movie $movie)
    {
        // 1. Form Doğrulama
        $validated = $request->validate([
            'author_name' => 'required|string|max:100',
            'content' => 'required|string|min:3|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'author_name.required' => 'Lütfen adınızı giriniz.',
            'content.required' => 'Yorum alanı boş bırakılamaz.',
            'content.min' => 'Yorum en az 3 karakter olmalıdır.',
            'rating.required' => 'Lütfen bir puan seçiniz.',
        ]);

        // 2. İlişki Üzerinden Kayıt: movie_id otomatik olarak atanır!
        $movie->comments()->create($validated);

        // 3. Geldiği sayfaya başarı mesajıyla geri dön
        return back()->with('success', 'Yorumunuz başarıyla eklendi! 💬');
    }

    // Yorum Silme Metodu
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Yorum silindi.');
    }
}