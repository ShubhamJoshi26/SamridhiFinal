<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryList()
    {
        $categorydata = Category::get();
        $categoryarr = $categorydata->toArray();
        if(!empty($categoryarr) && !empty($categoryarr[0]))
        {
            return view('/category/categorylist',['category'=>$categoryarr]);
        }     
        else
        {
            return view('/category/categorylist');
        }   
    }
    public function CreateCategory(Request $request)
    {
        if($request->id!='')
        {
            $category = Category::find($request->id);
        }
        else
        {
            $category = new Category;
        }
        if($request->file('category_image')!=null)
            {
                            $name = time().rand(1,50).'.'.$request->file('category_image')->extension();
                            $request->file('category_image')->move(public_path('uploads/categoryimages'), $name); 
                            $path = 'uploads/categoryimages/'.$name; 
                            $category->image_path = $path;
            }

        $category->category_name = $request->category_name;
        $category->category_status = $request->category_status;
        if($category->save())
        {
            
            return redirect('/Category/CategoryList')->with('success','Category Added Successfully');
        }
        else
        {
            return redirect('/Category/CategoryList')->with('error','Category Not Added');
        }
    }
    public function EditCategory(Request $request)
    {
        $category = Category::find($request->id);
    
       if(isset($category))
       {
        $catarr = $category->toArray();
         return view('/Category/AddCategory',['catdata'=>$catarr]);
       }
       else
       {
        return redirect('/Category/CategoryList')->with('error','Category Not Found');
       }
        
    }
    public function DeleteCategory(Request $request)
    {
        $category = Category::destroy($request->id);
        return redirect('/Category/CategoryList')->with('success','Category Deleted Successfully');
    }
    public function GetAllCategory(Request $req)
    {
        $category = Category::all()->toArray();
        if($req->cid!='')
        {
            $category = Category::find($req->cid)->toArray();
        }
        if(!empty($category))
        {
            return BaseController::sendResponse($category,'Category Fetched Successfully');
        }
        else
        {
            return BaseController::sendError('Data Not Available');
        }
    }
}
