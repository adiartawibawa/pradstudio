<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'         => $this->faker->sentence(6, true),
            'excerpt'       => $this->faker->text(120),
            'body'          => $this->faker->paragraphs(5, true),
            'meta'          => ['keywords' => $this->faker->words(5)],
            'author_id'     => User::inRandomOrder()->first()?->id ?? User::factory(),
            'category_id'   => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'featured_image' => $this->faker->imageUrl(800, 600, 'tech', true, 'blog'),
            'is_featured'      => $this->faker->boolean(20),
            'published'     => $this->faker->boolean(80),
            'publish_date'  => $this->faker->dateTimeBetween('-1 year', '+1 month'),
        ];
    }
}
