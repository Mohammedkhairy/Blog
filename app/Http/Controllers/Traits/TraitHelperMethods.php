<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

trait TraitHelperMethods
{
    public function index()
    {
        $model = self::MODEL;
        $pagginate = self::PAGGINATE;
        $data = $model::paginate($pagginate);
        if (empty($data)) {
            return $this->failJson();
        }
        return $this->successJson($data);
    }

    public function store(Request $request)
    {
        $model = self::MODEL;
        $this->validate($request, $model::$rules);
        $data = $request->all();
        $data['id'] = Str::random(10);
        if(isset($data['image'])){
            $image = $data['image'];
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(Storage::path('product/').$name);
            $data['image'] = $name;
        }
        $model = $model::create($data);
        return $model;
    }

    public function update(Request $request, $id)
    {
        $model = self::MODEL;
        $this->validate($request, $model::$rules);
        $data = $request->all();
        $item = $model::find($id);
        if(!empty($data['image'])){
            Storage::delete("product/".$item['image']);
            $image = $data['image'];
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(Storage::path('product/').$name);
            $data['image'] = $name;
        }
        $item->update($data);
        return $item;
    }
    
    public function destroy($id)
    {
        $model = self::MODEL;
        $data = $model::find($id);
        if (empty($data)) {
            return $this->failJson();
        }
        $data->delete();
        if(Storage::disk('public')->exists($data->image))
        unlink(Storage::path("product/".$data->image));
        return $this->successJson($data);
    }

    protected function successJson($data)
    {
        return response()->json($data, 200);
    }

    protected function failJson()
    {
        return response()->json(['message' => "Not Found"], 404);
    }

}