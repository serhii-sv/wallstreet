<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSmsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable == null){
            $verification_enable = new Setting([
                's_key' => 'verification_enable',
                's_value' => 'on'
            ]);
            $verification_enable->save();
        }
        $verification_type = Setting::where('s_key', 'verification_type')->first();
        if ($verification_type == null){
            $verification_type = new Setting([
                's_key' => 'verification_type',
                's_value' => 'text'
            ]);
            $verification_type->save();
        }
        $verification_text = Setting::where('s_key', 'verification_text')->first();
        if ($verification_text == null){
            $verification_text = new Setting([
                's_key' => 'verification_text',
                's_value' => 'Ваш код:'
            ]);
            $verification_text->save();
        }
        $verification_voice_text = Setting::where('s_key', 'verification_voice_text')->first();
        if ($verification_voice_text == null){
            $verification_voice_text = new Setting([
                's_key' => 'verification_voice_text',
                's_value' => 'Ваш код:'
            ]);
            $verification_voice_text->save();
        }
    }
    
    
    
}
