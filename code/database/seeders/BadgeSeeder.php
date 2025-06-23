<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all existing modules
        $modules = Module::all();

        // Create a badge for each module
        foreach ($modules as $module) {
            Badge::updateOrCreate(
                ['module_id' => $module->id],
                [
                    'name' => 'Completed ' . $module->name,
                    'description' => 'Awarded for completing all skills in ' . $module->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}