<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;
use Storage;

trait TraitHelperMethods
{
    public function index()
    {
        $model = self::MODEL;
        $relation =  self::RELATION;
        $pagginate = self::PAGGINATE;
        $data = $model::with($relation)->paginate($pagginate);
        if (empty($data)) {
            return $this->failJson();
        }
        return $data;//$this->successJson($data);
    }

    public function show($id)
    {
        $model = self::MODEL;
        if($model == "App\Models\Post"){
            $data = $model::where('category_id' , $id)->get();
        }else{
            $data = $model::find($id);
        }
        if (empty($data)) {
            return $this->failJson();
        }
        return $this->successJson($data);
    }

    public function store(Request $request)
    {
        $model = self::MODEL;
        $img = $request->image->store('post');
        $data = $request->all();
        $data['image'] = $img;
        $model = $model::create($data);        
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $model = self::MODEL;
        $data = $request->all();
        $item = $model::find($id);
        if(!empty($request->image)){
            unlink(Storage::disk('public')->path($item['image']));
            $img = $request->image->store('post');
            $data['image'] = $img;
        }
        $item->update($data);
        return redirect()->back();
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
            unlink(Storage::disk('public')->path($data->image));
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

    protected function processNotDone()
    {
        return response()->json(['message' => "Process not done , please try again."], 422);
    }

    protected function failToLoginJson()
    {
        return response()->json(['message' => "User details incorrect"], 401);
    }

    protected function unAuthorizeJson()
    {
        return response()->json(['message' => "unAuthorize"], 401);
    }
}