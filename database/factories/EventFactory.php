<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
            'description'=>$this->faker->paragraph,
            'place'=>$this->faker->text(100),
            'link'=>$this->faker->text(100),
            'picture'=>$this->faker->image('public/storage/images',640,480, null, false),
            'date'=>$this->faker->date,
        ];
    }
}
