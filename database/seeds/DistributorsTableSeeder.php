<?php

use App\Models\Distributor;
use Illuminate\Database\Seeder;

class DistributorsTableSeeder extends Seeder
{
    /**
     * Insere as páginas no BD.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getDistributors() as $source) {
            Distributor::create([
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
    private function getDistributors()
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