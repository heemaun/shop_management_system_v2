<?php

namespace Database\Seeders;

use App\Models\Sell;
use App\Models\User;
use App\Models\Status;
use App\Models\Account;
use App\Models\Product;
use App\Models\Category;
use App\Models\SellOrder;
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

        $pages = ['Accounts','Categories','Products','Purchases','Purchase Orders','Sells','Sell Orders','Settings','Statuses','Transactions','Users','Roles','Permissions','Carts'];

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

        for($x=0;$x<1000;$x++){
            $user = User::create([
                'status_id'         => rand(1,count(Status::all())),
                'name'              => $faker->unique()->name(),
                'username'          => $faker->unique()->userName(),
                'gender'            => $faker->randomElement(['Male','Female']),
                'address'           => $faker->address(),
                'dob'               => $faker->date(),
                'email'             => $faker->unique()->email,
                'email_verified_at' => date('Y-m-d'),
                'phone'             => $faker->unique()->phoneNumber(),
                'password'          => Hash::make('11111111'),
            ]);

            $user->assignRole($faker->randomElement(['Super Admin','Admin','Manager','Seller','Customer']));
        }

        $user1->assignRole('Super Admin');
        $user2->assignRole('Admin');
        $user3->assignRole('Seller');
        $user4->assignRole('Manager');

        for($x=0;$x<10;$x++){
            $category = Category::create([
                'status_id'             => rand(1,count(Status::all())),
                'admin_id'              => rand(1,count(User::all())),
                // 'parent_category_id'    => null,
                'name'                  => $faker->unique()->colorName(),
            ]);
            
            for($y=0;$y<10;$y++){
                Product::create([
                    'status_id'     => rand(1,count(Status::all())),
                    'admin_id'      => rand(1,count(User::all())),
                    'category_id'   => $category->id,
                    'name'          => $faker->unique()->colorName(),
                    'units'         => $faker->randomDigitNotZero(),
                    'price'         => $faker->randomDigitNotZero(),
                    'details'       => $faker->text(),
                ]);
            }
        }

        for($x=0;$x<10;$x++){
            Account::create([
                'status_id' => rand(1,count(Status::all())),
                'admin_id'  => rand(1,count(User::all())),
                'name'      => $faker->colorName(),
                'balance'   => $faker->randomDigitNotZero(),
            ]);
        }

        $customer_ids = array();
        $admin_seller_ids = array();

        foreach(Role::where('name','Customer')->first()->users as $customer){
            array_push($customer_ids,$customer->id);
        }
        foreach(Role::where('name','admin')->first()->users as $admin){
            array_push($admin_seller_ids,$admin->id);
        }
        foreach(Role::where('name','seller')->first()->users as $seller){
            array_push($admin_seller_ids,$seller->id);
        }

        print_r($customer_ids);
        print_r($admin_seller_ids);

        for($x=0;$x<100;$x++){
            $sell = Sell::create([
                'status_id'     => rand(1,count(Status::all())),
                'admin_id'      => $admin_seller_ids[rand(0,(count($admin_seller_ids)-1))],
                'customer_id'   => $customer_ids[rand(0,(count($customer_ids)-1))],
                'units'         => 0,
                'sub_total'     => 0,
                'discount'      => rand(0,100),
                'created_at'    => $faker->dateTimeBetween('-6 month','+1 week'),
            ]);

            for($y=0;$y<rand(1,10);$y++){
                $product = Product::find(rand(1,count(Product::all())));
                $productUnits = rand(1,10);

                $sellOrder = SellOrder::create([
                    'status_id'     => rand(1,count(Status::all())),
                    'admin_id'      => $admin_seller_ids[rand(0,(count($admin_seller_ids)-1))],
                    'sell_id'       => $sell->id,
                    'product_id'    => $product->id,
                    'units'         => $productUnits,
                    'price'         => $productUnits * $product->price,
                    'discount'      => ($productUnits * $product->price) * rand(0,20) * .01,
                ]);

                $sell->units =+ $productUnits;
                $sell->sub_total += $sellOrder->price - $sellOrder->discount;
                $sell->save(); 
            }
        }
    }
}
