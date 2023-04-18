<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepo
{


    public function model()
    {
        return new  Category();
    }

    public function get($select = ['*'], $relation = [], $count = 'products', $orderBy = 'id', $sort = 'desc')
    {
        if (auth('admin')->user()->is_super_admin) {
            return $this->model()->with($relation)->select($select)->withCount($count)->with($relation)->orderBy($orderBy, $sort)->get();
        }
        return auth('admin')->user()->categories()->withCount($count)->with($relation)->orderBy($orderBy, $sort)->get();

    }
}
