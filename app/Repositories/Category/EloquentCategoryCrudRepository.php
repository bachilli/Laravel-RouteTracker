<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class EloquentCategoryCrudRepository implements CategoryCrudRepository
{
    /**
     * Cria uma nova categoria.
     *
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        DB::beginTransaction();

        try {
            $category = Category::create($data);

            DB::commit();

            return $category;
        } catch (Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
     * Realiza a atualização de uma categoria.
     *
     * @param $data
     * @param $category
     * @return bool
     */
    public function update($data, $category)
    {
        DB::beginTransaction();

        try {
            $category->update($data);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
     * Faz a exclusão de uma categoria.
     *
     * @param $category
     * @return bool
     */
    public function destroy($category)
    {
        DB::beginTransaction();

        try {
            $category->delete();

            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }
}