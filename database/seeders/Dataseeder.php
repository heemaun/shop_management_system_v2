<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
use App\Models\Account;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Dataseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        //creating roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $seller = Role::create(['name' => 'Seller']);
        $customer = Role::create(['name' => 'Customer']);

        $pages = ['Accounts','Categories','Products','Purchases','Purchase Orders','Sells','Sell Orders','Settings','Statuses','Transactions','Users','Roles','Permissions'];

        foreach($pages as $p){
            $permission1 = Permission::create(['name' => $p.' Index']);
            $permission2 = Permission::create(['name' => $p.' Create']);
            $permission3 = Permission::create(['name' => $p.' Show']);
            $permission4 = Permission::create(['name' => $p.' Edit']);
            $permission5 = Permission::create(['name' => $p.' Delete']);

            $superAdmin->givePermissionTo([$permission1,$permission2,$permission3,$permission4,$permission5]);
            $admin->givePermissionTo([$permission1,$permission2,$permission3,$permission4,$permission5]);
        }

        $manager->givePermissionTo([
            'Accounts Index',
            'Accounts Show',            
            'Categories Index',
            'Categories Show',
            'Products Index',
            'Products Create',
            'Products Show',
            'Products Edit',
            'Purchases Index',
            'Purchases Create',
            'Purchases Show',
            'Purchase Orders Index',
            'Purchase Orders Create',
            'Purchase Orders Show',
            'Sells Index',
            'Sells Create',
            'Sells Show',
            'Sell Orders Index',
            'Sell Orders Create',
            'Sell Orders Show',
            'Transactions Index',
            'Transactions Create',
            'Transactions Show',
            'Users Index',
            'Users Create',
            'Users Show',
            'Users Edit',
        ]);

        $seller->givePermissionTo([
            'Categories Index',
            'Categories Show',
            'Products Index',
            'Products Show',
            'Sells Index',
            'Sells Create',
            'Sells Show',
            'Sell Orders Index',
            'Sell Orders Create',
            'Sell Orders Show',
            'Transactions Index',
            'Transactions Create',
            'Users Index',
            'Users Show',
        ]);

        $customer->givePermissionTo([
            'Sells Create',
            'Sells Show',
            'Transactions Create',
        ]);

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
        $status5 = Status::create([
            'name' => 'Carted',
        ]);

        $user1 = User::create([
            'status_id'         => $status1->id,
            'name'              => 'Md. Maksuduzzaman Maun',
            'username'          => 'maunzaman',
            'gender'            => 'Male',
            'address'           => 'Suihari-Ramnagor Road, Kalitola, Sadar, Dinajpur',
            'dob'               => '1993-11-8',
            'email'             => 'heemaun@gmail.com',
            'email_verified_at' => date('Y-m-d'),
            'phone'             => '01751430596',
            'password'          => Hash::make('11111111'),
        ]);
        
        $user2 = User::create([
            'status_id'         => $status1->id,
            'name'              => 'Test User',
            'username'          => 'testuser',
            'gender'            => 'Male',
            'address'           => 'Test Address',
            'dob'               => '1990-2-22',
            'email'             => 'test@gmail.com',
            'email_verified_at' => date('Y-m-d'),
            'phone'             => '01234567891',
            'password'          => Hash::make('11111111'),
        ]);
        
        $user3 = User::create([
            'status_id'         => $status1->id,
            'name'              => 'Test User 2',
            'username'          => 'testuser2',
            'gender'            => 'Male',
            'address'           => 'Test Address 2',
            'dob'               => '1990-2-11',
            'email'             => 'test2@gmail.com',
            'email_verified_at' => date('Y-m-d'),
            'phone'             => '01234562891',
            'password'          => Hash::make('11111111'),
        ]);
        
        $user4 = User::create([
            'status_id'         => $status1->id,
            'name'              => 'Test User 3',
            'username'          => 'testuser3',
            'gender'            => 'Male',
            'address'           => 'Test Address 3',
            'dob'               => '1990-2-12',
            'email'             => 'test3@gmail.com',
            'email_verified_at' => date('Y-m-d'),
            'phone'             => '01233562891',
            'password'          => Hash::make('11111111'),
        ]);

        for($x=0;$x<500;$x++){
            $user = User::create([
                'status_id'         => rand(1,count(Status::all())),
                'name'              => $faker->name(),
                'username'          => $faker->userName(),
                'gender'            => $faker->randomElement(['Male','Female']),
                'address'           => $faker->address(),
                'dob'               => $faker->date(),
                'email'             => $faker->email,
                'email_verified_at' => date('Y-m-d'),
                'phone'             => $faker->phoneNumber(),
                'password'          => Hash::make('11111111'),
            ]);

            $user->assignRole($faker->randomElement(['Super Admin','Admin','Manager','Seller','Customer']));
        }

        $user1->assignRole('Super Admin');
        $user2->assignRole('Admin');
        $user3->assignRole('Seller');
        $user4->assignRole('Manager');

        for($x=0;$x<50;$x++){
            $category = Category::create([
                'status_id'             => rand(1,count(Status::all())),
                'admin_id'              => rand(1,count(User::all())),
                // 'parent_category_id'    => null,
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
