<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>ucfirst($this->faker->word),
            'description'=>$this->faker->paragraph,
            'picture'=>$this->faker->image('public/storage/images',640,480, null, false),
           
        ];
    }
}
