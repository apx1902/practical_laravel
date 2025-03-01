<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        return response()->json([
            'categories' => $categories,
            'status'=>true,
            'message'=>'Categories fetched successfully',
        ],200);
    }

    public function store(Request $request){
        $request->validate([
            'category_name'=>'required',
        ]);

        $category = Category::create([
            'category_name'=>$request->category_name,
        ]);

        return response()->json([
            'category' => $category,
            'status'=>true,
            'message'=>'Category created successfully',
        ],200);
    }

    public function update(Request $request,$id){
        $request->validate([
            'category_name'=>'required',
        ]);

        $category = Category::find($id);

        $category = Category::where('id',$id)->update([
            'category_name'=> $request->category_name,
        ]);

        return response()->json([
            'category'=>$category,
            'status'=>true,
            'message'=>'Category updated successfully',
        ],200);
    }

    public function destroy($id){
        $category = Category::find($id);

        $category->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Category deleted successfully',
        ],200);
    }

    public function paginate($page){
        $categories = Category::paginate($page);

        return response()->json([
            'categories'=>$categories,
            'status'=>true,
            'message'=>'Categories fetched successfully',
        ],200);
    }

    public function search(Request $request){
        //search from both category and subcategory name
        $data = Category::with(['subcategories'=>function($query) use ($request){
            $query->where('sub_category_name','like','%'. $request->search.'%');
        }]);

        if($request->has('search')){
            $search = "%". $request->search . "%";

            $data = $data->where(function($query) use ($search){
                $query ->where('category_name','like',$search);
            })->orWhereHas('subcategories',function($query) use ($search){
                $query ->where('sub_category_name','like',$search);
            });
        }

        return response()->json([
            'categories' => $data->get(),
            'status'=>true,
            'message'=>'Categories fetched successfully',
        ]);
    }
}
