<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'id' => 1,
                'type' => '1',
                'title' => 'Home',
                'slug' => 'home',
                'page_title' => 'Omnis nisi reiciendi',
                'page_description' => 'Quis ad sed dolores .',
                'visibility' => 'no-follow',
                'status' => '1',
                'canonical_url' => 'https://www.xikuwyniw.cm',
                'has_meta' => null,
                'added_by' => 1,
                'created_at' => Carbon::parse('2025-09-08 05:38:38'),
                'updated_at' => Carbon::parse('2025-09-08 06:58:26'),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'type' => '1',
                'title' => 'About Us',
                'slug' => 'about-us',
                'page_title' => 'Amet nulla in expli',
                'page_description' => 'Magni aliquam dolor .',
                'visibility' => 'no-follow',
                'status' => '0',
                'canonical_url' => 'https://www.vekozolyredore.ca',
                'has_meta' => null,
                'added_by' => 1,
                'created_at' => Carbon::parse('2025-09-09 04:26:53'),
                'updated_at' => Carbon::parse('2025-09-09 04:27:12'),
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'type' => '1',
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'page_title' => 'Deserunt in aut in d',
                'page_description' => 'Amet, tempor atque q.',
                'visibility' => 'no-follow',
                'status' => '1',
                'canonical_url' => 'https://www.gatu.org.uk',
                'has_meta' => null,
                'added_by' => 1,
                'created_at' => Carbon::parse('2025-09-12 00:16:27'),
                'updated_at' => Carbon::parse('2025-09-12 00:16:42'),
                'deleted_at' => null,
            ]
        ]);
    }
}
