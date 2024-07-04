<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class groupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert(
            [
                'group' => 'admin'
            ]
        );
        DB::table('groups')->insert(
            [
                'group' => 'report_owner'
            ]
        );
        DB::table('groups')->insert(
            [
                'group' => 'report_viewer'
            ]
        );
    }
}
