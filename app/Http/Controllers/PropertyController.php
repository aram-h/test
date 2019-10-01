<?php

namespace App\Http\Controllers;

use App\Property;
use App\Region;

class PropertyController extends Controller
{
    public function index() {
        return view('property.index');
    }

    public function getData() {

        $model = Property::with([
            'property',
            'status',
            'region' => function($query) {
                $query->with('country');
            },
            'project'
        ])->searchPaginateAndOrder();


        $columns = Property::$columns;

        return response()
            ->json([
                'model' => $model,
                'columns' => $columns,
                'dropdown' => Property::getDropdowns()
            ]);
    }
}
