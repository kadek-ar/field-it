<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_times')->insert([
            [
                "open_time" => "07:00:00",
                "close_time" => "08:00:00"
            ],
            [
                "open_time" => "08:00:00",
                "close_time" => "09:00:00"
            ],
            [
                "open_time" => "09:00:00",
                "close_time" => "10:00:00"
            ],
            [
                "open_time" => "10:00:00",
                "close_time" => "11:00:00"
            ],
            [
                "open_time" => "11:00:00",
                "close_time" => "12:00:00"
            ],
            [
                "open_time" => "12:00:00",
                "close_time" => "13:00:00"
            ],
            [
                "open_time" => "13:00:00",
                "close_time" => "14:00:00"
            ],
            [
                "open_time" => "14:00:00",
                "close_time" => "15:00:00"
            ],
            [
                "open_time" => "15:00:00",
                "close_time" => "16:00:00"
            ],
            [
                "open_time" => "16:00:00",
                "close_time" => "17:00:00"
            ],
            [
                "open_time" => "17:00:00",
                "close_time" => "18:00:00"
            ],
            [
                "open_time" => "18:00:00",
                "close_time" => "19:00:00"
            ],
            [
                "open_time" => "19:00:00",
                "close_time" => "20:00:00"
            ],
            [
                "open_time" => "20:00:00",
                "close_time" => "21:00:00"
            ],
            [
                "open_time" => "21:00:00",
                "close_time" => "22:00:00"
            ],
            [
                "open_time" => "22:00:00",
                "close_time" => "23:00:00"
            ],
            [
                "open_time" => "23:00:00",
                "close_time" => "24:00:00"
            ],
        ]);
    }
}
