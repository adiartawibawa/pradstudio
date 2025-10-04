<?php

namespace App\Livewire\Pages\Guest\Blog;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class SinglePost extends Component
{
    public $slug;
    public $post;
    public $relatedPosts;

    public function mount($slug)
    {
        $this->post = Post::with(['author', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $this->relatedPosts = Post::where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->latest()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.guest.blog.single-post', [
            'post' => $this->post,
            'relatedPosts' => $this->relatedPosts,
        ]);
    }
}
