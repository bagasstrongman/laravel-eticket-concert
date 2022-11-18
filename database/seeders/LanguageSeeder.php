<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (LanguageLine::count() == 0) {
            foreach (config('translate.list') as $language) {
                LanguageLine::create($language);
            }
        }
    }
}
