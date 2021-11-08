<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>ucfirst($this->faker->word),
            'comment'=>$this->faker->paragraph,
            'name'=>$this->faker->name,
            'picture'=>$this->faker->image('public/storage/images',640,480, null, false),
        ];
    }
}
