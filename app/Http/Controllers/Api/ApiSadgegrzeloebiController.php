<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SadgegrzeloRequest;
use App\Http\Resources\SadgegrzeloCollection;
use Illuminate\Http\Request;
use Models\Category;
use Models\Collection;
use Models\SadgegrzeloCategory;
use Models\Sadgegrzeloebi;

class ApiSadgegrzeloebiController extends Controller
{
    public function index(Request $request){

        $skips = \DB::table('sadgegrzelo_skip')->where('device_id', $request->get('device_id'))->pluck('sadgegrzeloebi_id')->toArray();
        $used = \DB::table('sadgegrzelo_rate')->where('device_id', $request->get('device_id'))->pluck('sadgegrzeloebi_id')->toArray();

        $sadgegrzelo =(new Sadgegrzeloebi)->forPublic()->orderByRaw('RAND()');

        if($sadgegrzelo->whereNotIn('sadgegrzeloebi.id', $skips)->count() == 0){
            \DB::table('sadgegrzelo_skip')->where('device_id', $request->get('device_id'))->delete();
        }
        if($sadgegrzelo->whereNotIn('sadgegrzeloebi.id', $used)->count() > 0){
            $sadgegrzelo = $sadgegrzelo->whereNotIn('sadgegrzeloebi.id', $used);
        }

        $sadgegrzelo = $sadgegrzelo->select(
            array(
                '*',
                \DB::raw('(SELECT count(*) FROM sadgegrzelo_rate WHERE sadgegrzeloebi_id = sadgegrzeloebi.id) as count_rate'))
        )->orderBy('count_rate','desc');

        $sadgegrzelo = $sadgegrzelo->first();


        return new SadgegrzeloCollection(
            $sadgegrzelo
        );
    }


    public function store(SadgegrzeloRequest $request){
        $input = $request->all();
        $input['collection_id'] = (new Collection)->where('type', 'sadgegrzeloebi')->first()->id;
        $input['visibility'] = 0;

        $model = $this->model->create($input);
        foreach ($request->get('categories') as $category_id){
            SadgegrzeloCategory::create([
                'sadgegrzeloebi_id' => $model->id,
                'category_id' => $category_id,
            ]);
        }
    }

    public function skip(Request $request, $sadgegrzelo){
        if($request->get('device_id') == ''){
            abort(401);
        }
        \DB::table('sadgegrzelo_skip')->insert([
            'device_id' => $request->get('device_id'),
            'sadgegrzeloebi_id' => $sadgegrzelo,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }

    public function select(Request $request, $sadgegrzelo){
        if($request->get('device_id') == ''){
            abort(401);
        }
        \DB::table('sadgegrzelo_rate')->insert([
            'device_id' => $request->get('device_id'),
            'sadgegrzeloebi_id' => $sadgegrzelo,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }

    public function reset(Request $request){
        if($request->get('device_id') == ''){
            abort(401);
        }
        \DB::table('sadgegrzelo_skip')->where('device_id', $request->get('device_id'))->delete();
        \DB::table('sadgegrzelo_rate')->where('device_id', $request->get('device_id'))->update([
            'device_id' => 'reseted'
        ]);
    }



}