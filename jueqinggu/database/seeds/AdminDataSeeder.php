<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Http\Models\Admin;
class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Admin $admin)
    {
        $admin->truncate();
        $faker=Factory::create('zh_CN');
        for($i=0;$i<=50;$i++){
            $admin->insert([
                'role_id'=>mt_rand(1,5),
                'username'=>$faker->userName,
                'nickname'=>$faker->name,
                'password'=>bcrypt('123456'),
                'phone'=>$faker->phoneNumber,
                'email'=>$faker->email,
                'sex'=>mt_rand(1,2),
                'login_ip'=>$faker->ipv4,
            ]);
        }

    }
}
