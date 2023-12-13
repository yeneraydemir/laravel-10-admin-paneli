<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// Yönetici Rolü                
        $role = Role::updateOrCreate([
                'name'=> 'yonetici',
        ],
        [
            'name' => 'yonetici',
            'title' =>'Yönetici',
            'description'=> 'Sitenin genel yönetimini sağlar',
        ]);

// Blog Rolü
                $roleBlog = Role::updateOrCreate([
                'name'=> 'blog-yoneticisi',
        ],
        [   
            'name' => 'blog-yoneticisi',
            'title' =>'Blog Yöneticisi',
            'description'=> 'Blog Yönetimini Sağlar',
        ]);

// E-Ticaret Rolü
        $roleECommerce = Role::updateOrCreate([
            "name"=> "e-ticaret-yoneticisi",
    ],
    [
        'name' => 'e-ticaret-yoneticisi',
        'title' =>'E-Ticaret Yöneticisi',
        'description'=> 'E-Ticaret Yönetimini Sağlar',
    ]);


      $user =  User::updateOrCreate(
            [
                "email"=> "iletisim@yeneraydemir.com",
            ],
            [
            "name"=> "Yener",
            "email"=> "iletisim@yeneraydemir.com",
            "password"=> bcrypt("12371327"),
        ]);
        
        $user->assignRole($role);

        if(User::count() == 1 ){
            $users = User::factory(100)->create();
            foreach($users as $user){
                $user->assignRole(rand(0,1) == 1 ? $roleBlog : $roleECommerce);
            }
        }
    }
}
