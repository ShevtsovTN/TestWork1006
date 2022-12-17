<?php

namespace Modules\Blog\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Modules\Blog\Models\Post;

class PostFactory extends Factory
{

    protected $model = Post::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->words(8, true),
            'content' => $this->faker->words(40, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
