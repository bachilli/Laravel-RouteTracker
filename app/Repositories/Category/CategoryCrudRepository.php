<?php

namespace App\Repositories\Category;

interface CategoryCrudRepository
{
    /**
     * Cria uma nova categoria.
     *
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * Realiza a atualização de uma categoria.
     *
     * @param $data
     * @param $category
     * @return bool
     */
    public function update($data, $category);

    /**
     * Faz a exclusão de uma categoria.
     *
     * @param $category
     * @return bool
     */
    public function destroy($category);
}