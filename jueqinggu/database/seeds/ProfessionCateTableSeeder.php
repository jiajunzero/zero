<?php

use Illuminate\Database\Seeder;
use App\Http\Models\ProfessionCate;
class ProfessionCateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ProfessionCate $professionCate)
    {
        $professionCate->truncate();

        $professionCate->create(['cate_name'=>'前端','sort'=>1]);
        $professionCate->create(['cate_name'=>'后端','sort'=>2]);
        $professionCate->create(['cate_name'=>'全栈','sort'=>3]);
        $professionCate->create(['cate_name'=>'移动端','sort'=>4]);
    }
}
