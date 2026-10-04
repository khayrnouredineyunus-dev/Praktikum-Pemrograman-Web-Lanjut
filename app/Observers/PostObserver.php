<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post): void
    {
        $post->title = Str::title($post->title);
    }

    public function created(Post $post): void
    {
        Log::info("Post baru dibuat: id {$post->id}, judul {$post->title}");
    }

    public function deleted(Post $post): void
    {
        Log::info("Post dihapus: id {$post->id}");
    }
}