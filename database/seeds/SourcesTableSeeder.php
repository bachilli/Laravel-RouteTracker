<?php

use App\Models\Source;
use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    /**
     * Insere as páginas no BD.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getSources() as $source) {
            Source::create([
                'name' => $source['name'],
                'slug' => str_slug($source['name'])
            ]);
        }
    }

    /**
     * Array com as páginas a serem inseridos no BD.
     *
     * @return array
     */
    private function getSources()
    {
        return [
            [
                // 1
                'name' => 'Famobi'
            ],
            [
                // 2
                'name' => 'ClickJogos'
            ]
        ];
    }
}