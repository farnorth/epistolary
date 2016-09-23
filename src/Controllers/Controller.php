<?php

namespace Pilaster\Newsletters\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * @param string $model
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\Paginator
     */
    protected function paginateModel($model, Request $request)
    {
        $count = (int) $request->input('count', 10);
        $columns = $request->has('columns') ? explode(',', $request->input('columns')) : ['*'];
        $includes = $request->has('include') ? explode(',', $request->input('include')) : null;
        $orderBy = $request->has('orderBy') ? explode('|', $request->input('orderBy')) : ['created_at', 'asc'];
        $filterBy = $request->has('filterBy') ? explode('|', $request->input('filterBy')) : [];
        if (count($orderBy) === 1) {
            array_push($orderBy, 'asc');
        }

        $items = !empty($includes) ? $model::with(...$includes) : new $model;

        if (!empty($filterBy)) {
            foreach ($filterBy as $filter) {
                $filter = explode(':', $filter);
                $items = $items->where($filter[0], $filter[1]);
            }
        }

        return $items->orderBy($orderBy[0], $orderBy[1])
            ->paginate($count, $columns)
            ->appends([
                'count' => $request->input('count'),
                'columns'=> $request->input('columns'),
                'include' => $request->input('include'),
                'orderBy' => $request->input('orderBy'),
                'filterBy' => $request->input('filterBy'),
            ]);
    }
}
