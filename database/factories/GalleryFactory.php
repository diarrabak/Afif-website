<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>ucfirst($this->faker->word),
            'author'=>$this->faker->name,
            'type'=>$this->faker->randomElement(["Image", "Video", "Audio"]),
            'description'=>$this->faker->paragraph,
            'picture'=>$this->faker->image('public/storage/images',640,480, null, false),
            'link'=>$this->faker->text(100),
        ];
    }
}
