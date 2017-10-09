<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Course;
class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Course $course)
    {
        $course->truncate();
        $course->create(['pro_id'=>1,'course_name'=>'Linux入门',]);
        $course->create(['pro_id'=>1,'course_name'=>'mvc思想',]);
        $course->create(['pro_id'=>2,'course_name'=>'tp3.2.3框架',]);
        $course->create(['pro_id'=>2,'course_name'=>'memcache',]);
        $course->create(['pro_id'=>3,'course_name'=>'mysql',]);
        $course->create(['pro_id'=>3,'course_name'=>'http协议',]);
    }
}
