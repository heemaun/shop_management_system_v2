<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

class Dataseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $status1 = Status::create([
            'name' => 'Active',
        ]);
        $status2 = Status::create([
            'name' => 'Pending',
        ]);
        $status3 = Status::create([
            'name' => 'Deleted',
        ]);
        $status4 = Status::create([
            'name' => 'Restricted',
        ]);
        $status5 = Status::create([
            'name' => 'Inactive',
        ]);

        $user1 = User::create([
            'status_id' => $status1->id,
            'name'      => 'Md. Maksuduzzaman Maun',
            'username'  => 'maunzaman',
            'gender'    => 'Male',
            'address'   => 'Suihari-Ramnagor Road, Kalitola, Sadar, Dinajpur',
            'dob'       => '1993-11-8',
            'email'     => 'heemaun@gmail.com',
            'phone'     => '01751430596',
            'password'  => Hash::make('11111111'),
        ]);

        for($x=0;$x<50;$x++){
            $category = Category::create([
                'status_id'             => rand(1,count(Status::all())),
                'admin_id'              => rand(1,count(User::all())),
                'parent_category_id'    => null,
                'name'                  => $faker->colorName(),
            ]);
            
            for($y=0;$y<50;$y++){
                Product::create([
                    'status_id'     => rand(1,count(Status::all())),
                    'admin_id'      => rand(1,count(User::all())),
                    'category_id'   => $category->id,
                    'name'          => $faker->colorName(),
                    'units'         => $faker->randomDigitNotZero(),
                    'price'         => $faker->randomDigitNotZero(),
                    'details'       => $faker->text(),
                ]);
            }
        }

        Account::create([
            'status_id' => rand(1,count(Status::all())),
            'admin_id'  => rand(1,count(User::all())),
            'name'      => 'Cash',
            'balance'   => $faker->randomDigitNotZero(),
        ]);
    }
}