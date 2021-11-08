<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Testimonial::factory(1)->create();
        Faq::factory(1)->create();
        Event::factory(1)->create();
        Gallery::factory(1)->create();
        Service::factory(10)->create();
    }
}
