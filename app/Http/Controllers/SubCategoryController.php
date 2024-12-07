<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories = SubCategory::all();

        return response()->json([
            'subcategories' => $subcategories,
            'status'=>true,
            'message'=>'SubCategories fetched successfully',
        ],200);
    }

    public function store(Request $request){
        $request->validate([
            'sub_category_name'=>'required',
            'category_id'=>'required',
        ]);

        $subcategory = SubCategory::create([
            'sub_category_name'=>$request->sub_category_name,
            'category_id'=>$request->category_id,
        ]);

        return response()->json([
            'subcategory' => $subcategory,
            'status'=>true,
            'message'=>'SubCategory created successfully',
        ],200);
    }

    public function update(Request $request,$id){
        $request->validate([
            'sub_category_name'=>'required',
            'category_id'=>'required',
        ]);

        $subcategory = SubCategory::find($id);

        $subcategory = SubCategory::where('id',$id)->update([
            'sub_category_name'=> $request->sub_category_name,
            'category_id'=> $request->category_id,
        ]);

        return response()->json([
            'subcategory'=>$subcategory,
            'status'=>true,
            'message'=>'SubCategory updated successfully',
        ],200);
    }

    public function destroy($id){
        $subcategory = SubCategory::find($id);

        $subcategory->delete();

        return response()->json([
            'status'=>true,
            'message'=>'SubCategory deleted successfully',
        ],200);
    }

    public function paginate($page){
        $subcategories = SubCategory::paginate($page);

        return response()->json([
            'subcategories'=>$subcategories,
            'status'=>true,
            'message'=>'SubCategories fetched successfully',
        ],200);
    }
}
