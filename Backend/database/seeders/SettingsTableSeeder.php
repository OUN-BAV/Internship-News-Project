<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'logo',
            'name'        => 'logo',
            'description' => '',
            'value'       => 'image',
            'field'       => '{"name":"value","label":"Value","type":"image"}',
            'active'      => 1
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table(config('backpack.settings.table_name'))->truncate();
        foreach ($this->settings as $index => $setting) {
            $result = DB::table(config('backpack.settings.table_name'))->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
