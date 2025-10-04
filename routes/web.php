<?php

use App\Livewire\Pages\Admin\Blog\CreatePost;
use App\Livewire\Pages\Admin\Blog\EditPost;
use App\Livewire\Pages\Guest\Blog\CategoryPost;
use App\Livewire\Pages\Guest\Blog\SinglePost;
use App\Livewire\Pages\Guest\Blog\TagsPost;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('dashboard', 'livewire.pages.admin.dashboard')->name('dashboard');
        Route::view('blog', 'livewire.pages.admin.blog')->name('blog');
        Route::get('blog/create', CreatePost::class)->name('blog.create');
        Route::get('blog/{slug}/edit', EditPost::class)->name('blog.edit');
    });
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::view('/', 'blog')->name('all');
    Route::get('/read/{slug}', SinglePost::class)->name('read');
    Route::get('/tag/{name}', TagsPost::class)->name('tag');
    Route::get('/category/{slug}', CategoryPost::class)->name('category');
});

Route::prefix('project')->name('project.')->group(function () {
    Route::view('/', 'project')->name('all');
    Route::get('/{slug}/detail', function ($slug) {
        $projects = collect([
            [
                'slug' => 'portfolio-website',
                'title' => 'Portfolio Website',
                'description' => 'Personal website built with Laravel, Livewire, and Tailwind CSS.',
                'content' => '<p>This website was built to showcase my development work. It includes sections for blog posts, contact forms, and responsive design elements.</p>',
                'tags' => ['Laravel', 'Tailwind', 'Livewire'],
                'image' => 'https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&q=80&w=800',
                'url' => 'https://your-portfolio-link.com',
            ],
        ]);

        $project = $projects->firstWhere('slug', $slug);
        abort_if(!$project, 404);

        return view('livewire.pages.guest.projects.single-project', ['project' => (object) $project]);
    })->name('show');
});

require __DIR__ . '/auth.php';
