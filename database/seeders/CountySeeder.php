<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counties = [
            ['name' => 'Mombasa', 'code' => '001', 'is_active' => true],
            ['name' => 'Kwale', 'code' => '002', 'is_active' => true],
            ['name' => 'Kilifi', 'code' => '003', 'is_active' => true],
            ['name' => 'Tana River', 'code' => '004', 'is_active' => true],
            ['name' => 'Lamu', 'code' => '005', 'is_active' => true],
            ['name' => 'Taita Taveta', 'code' => '006', 'is_active' => true],
            ['name' => 'Garissa', 'code' => '007', 'is_active' => true],
            ['name' => 'Wajir', 'code' => '008', 'is_active' => true],
            ['name' => 'Mandera', 'code' => '009', 'is_active' => true],
            ['name' => 'Marsabit', 'code' => '010', 'is_active' => true],
            ['name' => 'Isiolo', 'code' => '011', 'is_active' => true],
            ['name' => 'Meru', 'code' => '012', 'is_active' => true],
            ['name' => 'Tharaka Nithi', 'code' => '013', 'is_active' => true],
            ['name' => 'Embu', 'code' => '014', 'is_active' => true],
            ['name' => 'Kitui', 'code' => '015', 'is_active' => true],
            ['name' => 'Machakos', 'code' => '016', 'is_active' => true],
            ['name' => 'Makueni', 'code' => '017', 'is_active' => true],
            ['name' => 'Nyandarua', 'code' => '018', 'is_active' => true],
            ['name' => 'Nyeri', 'code' => '019', 'is_active' => true],
            ['name' => 'Kirinyaga', 'code' => '020', 'is_active' => true],
            ['name' => 'Murang\'a', 'code' => '021', 'is_active' => true],
            ['name' => 'Kiambu', 'code' => '022', 'is_active' => true],
            ['name' => 'Turkana', 'code' => '023', 'is_active' => true],
            ['name' => 'West Pokot', 'code' => '024', 'is_active' => true],
            ['name' => 'Samburu', 'code' => '025', 'is_active' => true],
            ['name' => 'Trans Nzoia', 'code' => '026', 'is_active' => true],
            ['name' => 'Uasin Gishu', 'code' => '027', 'is_active' => true],
            ['name' => 'Elgeyo Marakwet', 'code' => '028', 'is_active' => true],
            ['name' => 'Nandi', 'code' => '029', 'is_active' => true],
            ['name' => 'Baringo', 'code' => '030', 'is_active' => true],
            ['name' => 'Laikipia', 'code' => '031', 'is_active' => true],
            ['name' => 'Nakuru', 'code' => '032', 'is_active' => true],
            ['name' => 'Narok', 'code' => '033', 'is_active' => true],
            ['name' => 'Kajiado', 'code' => '034', 'is_active' => true],
            ['name' => 'Kericho', 'code' => '035', 'is_active' => true],
            ['name' => 'Bomet', 'code' => '036', 'is_active' => true],
            ['name' => 'Kakamega', 'code' => '037', 'is_active' => true],
            ['name' => 'Vihiga', 'code' => '038', 'is_active' => true],
            ['name' => 'Bungoma', 'code' => '039', 'is_active' => true],
            ['name' => 'Busia', 'code' => '040', 'is_active' => true],
            ['name' => 'Siaya', 'code' => '041', 'is_active' => true],
            ['name' => 'Kisumu', 'code' => '042', 'is_active' => true],
            ['name' => 'Homa Bay', 'code' => '043', 'is_active' => true],
            ['name' => 'Migori', 'code' => '044', 'is_active' => true],
            ['name' => 'Kisii', 'code' => '045', 'is_active' => true],
            ['name' => 'Nyamira', 'code' => '046', 'is_active' => true],
            ['name' => 'Nairobi City', 'code' => '047', 'is_active' => true],
        ];

        // Use insertOrIgnore in case you run it twice (prevents duplicate errors)
        DB::table('counties')->insertOrIgnore($counties);
    }
}