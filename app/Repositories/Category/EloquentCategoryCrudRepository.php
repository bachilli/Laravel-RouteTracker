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
     * @param $values
     * @return Category|bool
     * @throws Exception
     */
    public function store($values)
    {
        DB::beginTransaction();

        try {
            $category = Category::create([
                'name' => $values['name'],
                'slug' => $values['slug'],
                'description' => $values['description'],
                'thumbnail' => prep($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($category->thumbnail->location);

            return $category;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Realiza a atualização de uma categoria.
     *
     * @param $values
     * @param $category
     * @return Category|bool
     * @throws Exception
     */
    public function update($values, $category)
    {
        DB::beginTransaction();

        try {
            $previous = (object) [ 'thumbnail' => $category->thumbnail ];

            $category->update([
                'name' => $values['name'],
                'slug' => $values['slug'],
                'description' => $values['description'],
                'thumbnail' => prep($values['thumbnail'])->uplab()
            ]);

            DB::commit();

            uplab($values['thumbnail'])->persist($category->thumbnail->location, $previous->thumbnail->location);

            return true;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }

    /**
     * Faz a exclusão de uma categoria.
     *
     * @param $category
     * @return Category|bool
     * @throws Exception
     */
    public function destroy($category)
    {
        DB::beginTransaction();

        try {
            $category->delete();

            DB::commit();

            storage()->deleteDirectory($category->thumbnail->dir);

            return $category;
        } catch (Exception $e) {
            DB::rollback();

            if (env('APP_DEBUG')) throw $e;

            return false;
        }
    }
}