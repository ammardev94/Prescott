<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_files')->insert([
            [
                'id' => 1,
                'name' => 'hPom2SMOxFAjwATIpqRHHT7kkUELD1wvWFI2GIF0.png',
                'path' => 'page-images/1/hPom2SMOxFAjwATIpqRHHT7kkUELD1wvWFI2GIF0.png',
                'ref_id' => 1,
                'ref_point' => 'section_one_background',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 04:09:24',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => '9QsdGlOY0w8mBs27APaNqmg5mfghANAzj7Jt2cBm.png',
                'path' => 'page-images/1/9QsdGlOY0w8mBs27APaNqmg5mfghANAzj7Jt2cBm.png',
                'ref_id' => 1,
                'ref_point' => 'section_two_img',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 04:54:15',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'RWM1vGmlkCR1TzqOGKx2DgYor107Zr807hInDCRU.png',
                'path' => 'page-images/1/RWM1vGmlkCR1TzqOGKx2DgYor107Zr807hInDCRU.png',
                'ref_id' => 1,
                'ref_point' => 'section_three_img',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 05:08:30',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'name' => 'sXi6OqPdfbmSyXnIV2AaRa0JmcWbe5IupKpeIcd7.png',
                'path' => 'page-images/1/sXi6OqPdfbmSyXnIV2AaRa0JmcWbe5IupKpeIcd7.png',
                'ref_id' => 1,
                'ref_point' => 'section_six_background',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 05:33:35',
                'deleted_at' => null,
            ],
            [
                'id' => 5,
                'name' => 'ZzBRv8XDWRY6lIutQ30EYowCqFbrU7KWS3q4omPj.png',
                'path' => 'page-images/1/ZzBRv8XDWRY6lIutQ30EYowCqFbrU7KWS3q4omPj.png',
                'ref_id' => 1,
                'ref_point' => 'section_seven_content_one_img',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 05:54:24',
                'deleted_at' => null,
            ],
            [
                'id' => 6,
                'name' => 'MBeD4JALOjhkEk60zUQ9dxRc7NKNbUtm86uo8fmH.png',
                'path' => 'page-images/1/MBeD4JALOjhkEk60zUQ9dxRc7NKNbUtm86uo8fmH.png',
                'ref_id' => 1,
                'ref_point' => 'section_seven_content_two_img',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 05:54:24',
                'deleted_at' => null,
            ],
            [
                'id' => 7,
                'name' => 'jV1XY3bSpZFwCAaMQdoimGPcJBq60MudSnDscCtn.png',
                'path' => 'page-images/1/jV1XY3bSpZFwCAaMQdoimGPcJBq60MudSnDscCtn.png',
                'ref_id' => 1,
                'ref_point' => 'section_seven_content_three_img',
                'alt_text' => 'Mamo',
                'created_at' => '2025-09-08 05:56:26',
                'updated_at' => '2025-10-01 05:54:24',
                'deleted_at' => null,
            ],
        ]);
    }
}
