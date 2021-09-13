<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Record;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerRoleId = Role::firstOrCreate(['title' => Role::MANGER])->id;
        $employeeRoleId = Role::firstOrCreate(['title' => Role::EMPLOYEE])->id;

        $managers = User::factory()
            ->count(2)
            ->state(new Sequence(
                ['email' => 'managerOne@mail.com'],
                ['email' => 'managerTwo@mail.com']
            ))
            ->create([
            'role_id' => $managerRoleId
        ]);

        $categories = Category::all();

        $image = Image::create(['url' => 'IuS5gJUkVSzMCG30azea6K4lY.jpeg']);

        User::factory()->count(rand(10, 15))
            ->has(Record::factory()
            ->count(5)
            ->state(function ($attributes) use ($categories, $image) {
                return [
                    'category_id' => $categories->random()->id,
                    'image_id' => $image->id
                ];
            })
            )->state(new Sequence(
                ['manager_id' => $managers->first()->id],
                ['manager_id' => $managers->last()->id],
            ))
            ->create([
            'role_id' => $employeeRoleId
        ]);
    }
}
