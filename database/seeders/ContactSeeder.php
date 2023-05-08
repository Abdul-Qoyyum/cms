<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->first();
        if($user){
            Contact::factory()
                ->count(30)
                ->for($user)
                ->state(new Sequence(
                    fn (Sequence $sequence) => ['category_id' => Category::all()->random()],
                ))
                ->create();
        }
    }
}
