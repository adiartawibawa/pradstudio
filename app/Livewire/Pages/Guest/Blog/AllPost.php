<?php

namespace App\Livewire\Pages\Guest\Blog;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPost extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::where('is_featured', false)
            ->latest('publish_date')
            ->paginate(6);

        return view('livewire.pages.guest.blog.all-post', [
            'posts' => $posts,
        ]);
    }
}
