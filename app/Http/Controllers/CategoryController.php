<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\categoryRequest;
use Exception;
use PDOException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $data = Category::get();
            return Response()->json(['status'=>true,'message'=>'success','data'=>$data]);
        }catch (Exception | PDOException $e){
            return Response()->json(['status'=>false,'message'=>'gagal menampilkan data']);
        }
    }
    
    public function store(categoryRequest $request)
    {     
        try {
            $data = Category::create($request->all());
            return response()->json(['status'=>true,'message'=>'input success','data'=>$data]);
        } catch (Exception | PDOException $e) {
            return response()->json(['status'=>false, 'message'=>'gagal input data']);
        }
    }

    public function show(Category $category){
        try {
            
            return Response()->json(['status'=>true,'data'=>$category]);
        }catch (Exception | PDOException $e){
            return Response()->json(['status'=>false,'message'=>'data failed to update'.$e]);
        }
    }

    public function update(categoryRequest $request, Category $category)
    {
        try {
           $category->update($request->all());
           return Response()->json(['status'=>true,'message'=>'data has been update']);
       }catch (Exception | PDOException $e){
           return Response()->json(['status'=>false,'message'=>'data failed to update'.$e]);
       }
    }

    public function destroy(Category $category)
    {
        try {
             $data = $category -> delete();
            return Response()->json(['status'=>true,'message'=>'data has been deleted','data'=>$data]);
        }catch (Exception | PDOException $e){
            return Response()->json(['status'=>false,'message'=>'data failed to delete']);
        }
    }
}
