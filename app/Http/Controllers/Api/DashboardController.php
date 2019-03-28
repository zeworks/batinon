<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscribers;
use App\Blog;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $cards = [
            [
                'title' => 'Subscribers',
                'type' => 'value',
                'value' => Subscribers::count()
            ],
            [
                'title' => 'Blog Actives',
                'type' => 'value',
                'value' => Blog::where('status', 1)->count()
                //'type' => 'chart',
                //'color' => '#2196f3',
    			//'value' => $this->getChart(Blog::where('status', 1), 'created_at')
            ]
        ];

        return response()
        ->json([ 'cards' => $cards ]);
    }

    function getChart($model, $column)
    {
    	$valueFormat = DB::raw("DATE_FORMAT(".$column.", '%d') as value");
    	$start = now()->startOfMonth();
    	$end = now()->endOfMonth();
    	$dates = [];
        $run = $start->copy();
        
    	while($run->lte($end)) {
    		$dates = array_add($dates, $run->copy()->format('d'), 0);
    		$run->addDay(1);
        }
        
    	$res = $model->groupBy($column)
    		->select(DB::raw('count(*) as total'), $valueFormat)
    		->pluck('total', 'value');
        
        $all = $res->toArray() + $dates;
        
        ksort($all);
        
        return collect(array_values($all))->map(function($item) {
            return ['value' => $item];
    	});
    }
}
