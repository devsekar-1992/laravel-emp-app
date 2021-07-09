<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime=Carbon::now()->toDateTimeString();
        DB::table('emp_departments')->insert(
            [
                [
                    'department_name'=>'CRM',
                    'created_at'=>$currentDateTime,
                    'updated_at'=>$currentDateTime
                ]
            ]
            );
    }
}
