<?php

namespace App\Helper;

use Validator;

trait DataViewer
{

    public function scopeSearchPaginateAndOrder($query)
    {
        $equalsFilters = ['id', 'bedroom', 'bathroom', 'property', 'status', 'region'];
        $likeFilters = ['title', 'description', 'project'];

        $request = app()->make('request');

        $query->select('properties.*', 'project_names.name as project')->join('project_names', 'properties.project_name_id', '=', 'project_names.id');
//        $v = Validator::make($request->only([
//            'column', 'direction', 'per_page',
//            'search_column', 'search_operator', 'search_input'
//        ]), [
//            'column' => 'required|alpha_dash|in:'.implode(',', self::$columns),
//            'direction' => 'required|in:asc,desc',
//            'per_page' => 'integer|min:1',
//            'search_column' => 'required|alpha_dash|in:'.implode(',', self::$columns),
//            'search_operator' => 'required|alpha_dash|in:'.implode(',', array_keys($this->operators)),
//            'search_input' => 'max:255'
//        ]);
//
//
//        if($v->fails()) {
//            dd($v->messages());
//            throw new \Illuminate\Validation\ValidationException($v);
//        }


        if ($request->column == 'property') $request->column = 'property_type_id';
        if ($request->column == 'status') $request->column = 'status_id';
        if ($request->column == 'region') $request->column = 'region_id';

        return $query
            ->orderBy($request->column, $request->direction)
            ->where(function ($query) use ($request, $equalsFilters, $likeFilters) {

                $relatedFields = [
                    'property' => 'property_type_id',
                    'status' => 'status_id',
                    'region' => 'region_id',
                ];

                foreach ($equalsFilters as $k => $filter) {
                    if ($request->has($filter) && $request->{$filter}) {
                        $key = (!empty($relatedFields[$filter])) ? $relatedFields[$filter] : $filter;
                        $query->where('properties.' . $key  , $request->{$filter});
                    }
                }

                foreach ($likeFilters as $k => $like) {
                    if ($request->has($like) && $request->{$like}) {
                        $key = ($like == 'project') ? 'project_names.name' : 'properties.' . $like;
                        $query->where($key, 'like', '%' . $request->{$like} . '%');
                    }
                }
            })
            ->paginate($request->per_page);
    }
}