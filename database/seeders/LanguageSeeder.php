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
            $languages = config()->get('translate.list');
    
            if (empty($languages)) {
                throw new \Exception('Error: config/translate.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
            }

            $language = collect($languages)->map(function ($trans) {
                return [
                    'group' => $trans['group'],
                    'key' => $trans['key'],
                    'text' => json_encode($trans['text'])
                ];
            });

            LanguageLine::insert($language->toArray());
        }
    }
}
