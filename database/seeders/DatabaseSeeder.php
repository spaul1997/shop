<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleHasPermission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        for($i = 1; $i <= 10; $i++){
            Product::insert([
                'pid' => 'PR'.rand(10000,99999),
                'name' => 'Product '.$i,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'image' => 'product-'.rand(1,4).'.webp',
                'price' => rand(100,500),
                'quantity' => rand(10,50),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $status = ['Pending','Processing','Shipped','Delivered','Cancelled','Completed'];
        foreach($status as $sta){
            OrderStatus::insert([
                'status' => $sta,
            ]);
        }

        $roles = ['Admin','User'];
        foreach($roles as $rol){
            Role::insert([
                'role' => $rol,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $permission = ['role-and-permission','product','order','user-order'];
        foreach($permission as $per){
            Permission::insert([
                'permission' => $per,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        for($k = 1; $k <= 4; $k++){
            $k <= 3 ? $rid = 1 : $rid = 2;
            RoleHasPermission::insert([
                'role_id' => $rid,
                'permission_id' => $k,
            ]);
        }
    }
}
