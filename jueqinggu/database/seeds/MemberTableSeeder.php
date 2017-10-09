<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Http\Models\Member;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Member $member)
    {
        $member->truncate();
        $faker=Factory::create('zh_CN');
        for($i=0;$i<100;$i++){
            $member->insert([
                'type_id'=>mt_rand(1,2),
                'username'=>$faker->userName,
                'nickname'=>$faker->name,
                'password'=>bcrypt('123456'),
                'email'=>$faker->email,
                'phone'=>$faker->PhoneNumber,
                'sex' => mt_rand(1,3),
                'login_ip'=>$faker->ipv4,
                'money'=>mt_rand(0,1000000),
                'education'=>mt_rand(1,4),
                'created_at'=>date('Y-m-d H:i:s')
            ]);
        }


    }
}
