<?php

namespace App\Livewire\Pages\Guest\Blog;

use App\Models\Post;
use Livewire\Component;

class FeaturedPost extends Component
{
    public function render()
    {
        $featured = Post::where('is_featured', true)->latest()->get();

        return view('livewire.pages.guest.blog.featured-post', [
            'featured' => $featured,
        ]);
    }
}
