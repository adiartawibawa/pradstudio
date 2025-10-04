<?php

namespace App\Livewire\Pages\Guest\Blog;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.guest')]
class TagsPost extends Component
{
    use WithPagination;

    public Tag $tag;

    public function mount(string $name)
    {
        $this->tag = Tag::where('name', $name)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.guest.blog.tags-post', [
            'posts' => Post::published()
                ->tag($this->tag->slug)
                ->latest()
                ->paginate(9),
            'tag' => $this->tag,
        ]);
    }
}
