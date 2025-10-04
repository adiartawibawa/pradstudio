<?php

namespace App\Livewire\Pages\Guest\Blog;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.guest')]
class CategoryPost extends Component
{
    use WithPagination;

    public $slug;
    public $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $posts = Post::with('author', 'category')
            ->where('category_id', $this->category->id)
            ->latest()
            ->paginate(7);

        return view('livewire.pages.guest.blog.category-post', [
            'category' => $this->category,
            'posts' => $posts,
        ]);
    }
}
