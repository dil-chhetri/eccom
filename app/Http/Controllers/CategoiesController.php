<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;

class CategoiesController extends Controller
{
    //
    public function addCategory(){
        $categories = Categories::all();
        $data = compact('categories');
        return view('ecommerce.admin.add-category')->with($data);
    }

    public function storeCategory(CategoryRequest $request){
        // echo "<pre>";
        // print_r($request->toArray());
        $category = new Categories();
        $category -> category_name = $request['category_name'];
        if(is_null($request['parent_category_entered'])){
            $category -> parent_category = $request['parent_category_selected'];
        }elseif(is_null($request['parent_category_selected'])){
        $category -> parent_category = $request['parent_category_entered'];
        }elseif(!is_null('parent_category_entered') && !is_null('parent_category_selected')){
            $category -> parent_category = $request['parent_category_selected'];
        }
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('upload/images/',$filename);
            $category->image = $filename;
            }else{
            return $request;
            $category->image = '';
            }
            $category->save();
            return redirect()->back();
    }

    public function showCategories(){
        $categories = Categories::all();
        $data = compact('categories');
        if(session()->has('user') && session('user')['is_admin']==='YES'){
            return view('ecommerce.admin.view-categories')->with($data);
        }else{
            return redirect('/')->with($data);
        }
    }

    public function editCategory($id){
        
        $category = Categories::where('category_id', $id)->first();
        if(is_null($category)){
            return redirect('/admin');
        }else{
        $categories = Categories::all();
        $url = url('/edit-category')."/".$id;
        $data = compact('category','url','categories');
        return view('ecommerce.admin.edit-category')->with($data);
        }
    }

    public function updateCategory(CategoryUpdateRequest $request, $id){
        
            try{
            $category = Categories::find($id);
            if($category){
            $category->category_name = $request['category_name'];
            if(is_null($request['parent_category_entered'])){
                $category -> parent_category = $request['parent_category_selected'];
            }elseif(is_null($request['parent_category_selected'])){
            $category -> parent_category = $request['parent_category_entered'];
            }elseif(!is_null('parent_category_entered') && !is_null('parent_category_selected')){
                $category -> parent_category = $request['parent_category_selected'];
            }
            if($request->hasfile('image')){
                $file = $request->file('image');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $file->move('upload/images/',$filename);
                $category->image = $filename;
                }else{
                return $request;
                $category->image = $request['image'];
                }

            $category->save();
            return redirect()->back()->with('success','Category updated successfully');
        }
        return redirect()->back()->with('error','Invalid Category');
        }catch(Exception $e){
            return redirect()->back()->with('error','Error updating Category:'. $e->getMessage()); 
        }
    }

    public function deleteCategory($id){
        try{
            $category = Categories::find($id);
            if(!is_null($category)){
                $category->delete();
                return redirect()->back()->with('success', 'Category deleted successfully');
            }else{
                return redirect()->back()->with('error', 'Invalid category');

            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting:'.$e->getMessage());
        }
    }

    public function viewTrash(){
        $categories = Categories::onlyTrashed()->get();
        $data = compact('categories');
        return view('ecommerce.admin.view-categories-trash')->with($data);
    }

    public function restoreCategory($id){
        try{
            $category = Categories::withTrashed()->find($id);
            if(!is_null($category)){
            $category->restore();
            return redirect()->back()->with('success', 'Category restored successfully');
        }else{
            return redirect()->back()->with('error','Invalid category');
        }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error restoring category');
        }
    }

    public function forceDeleteCategory($id){
        try{
            $category = Categories::withTrashed()->find($id);
            if(!is_null($category)){
                $category->forceDelete();
                return redirect()->back()->with('success', 'Category deleted permanentlty');
            }else{
                return redirect()->back()->with('error', 'Invalid category');

            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting:'.$e->getMessage());
        }
    }
}
