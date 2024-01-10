<?php

namespace App\Http\Services;

class PaginationService
{
    public function paginate($model, $rows, $page, $filter = null, $search = null, $relations = [])
    {
        $query = $model->newQuery();

        if ($filter && $search) {
            $query->where($filter, 'like', '%'.$search.'%');
        }

        return $query
            ->with($relations)
            ->orderBy("id", "desc")
            ->paginate($rows, ['*'], 'page', $page);
    }
}
