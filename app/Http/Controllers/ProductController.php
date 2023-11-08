<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct(){
        $categories = Categories::all();
        $data = compact('categories');
        return view('ecommerce.admin.add-product')->with($data);
    }

    public function storeProduct(ProductRequest $request){
        $product = new Product();
        $product->category = $request['category'];
        $product->product_name = $request['product_name'];
        $product->price = $request['price'];
        $product->brand = $request['brand'];
        $product->quantity = $request['quantity'];
        $product->description = $request['description'];
        $image = array();
        if($request->hasFile('image')){
            $files = $request['image'];
            foreach($files as $file){
              $extension = $file->getClientOriginalExtension();
              $filename = md5(rand(1000, 10000)).'.'.time().'.'.$extension;
              $image[] = $filename;
              $file->move('upload/images', $filename);  
        $product -> images = implode('|', $image);
            }
        }else{
            $product -> images = '';
        }
        $product->save();
        return redirect()->back();


    }

    public function showProduct(){
        $products = Product::all();
        $data = compact('products');
        if(session()->has('user') && session('user')['is_admin']==='YES'){
            return view('ecommerce.admin.view-products')->with($data);
        }else{
            return redirect('/')->with($data);
        }
    }

    public function editProduct($id){
        $categories = Categories::all();
        $product = Product::where('product_id', $id)->first();
        if(is_null($product)){
            return redirect('/admin');
        }else{
        $url = url('/edit-product')."/".$id;
        $data = compact('product','categories','url');
        return view('ecommerce.admin.edit-product')->with($data);
        }
    }

    public function updateProduct(ProductRequest $request, $id){
            try{
            $product = Product::find($id);
            if($product){
            $product->category = $request['category'];
            $product->product_name = $request['product_name'];
            $product->price = $request['price'];
            $product->brand = $request['brand'];
            $product->quantity = $request['quantity'];
            $product->description = $request['description'];
            if(is_array($request['image'])){
                $image = array();
                if($request->hasFile('image')){
                    $files = $request['image'];
                    foreach($files as $file){
                        $extension = $file->getClientOriginalExtension();
                        $filename = md5(rand(1000, 10000)).'.'.time().'.'.$extension;
                        $image[] = $filename;
                        $file->move('upload/images', $filename);  
                $product -> images = implode('|', $image);
                    }
                }else{
                    $product -> images = '';
                }
            }else{
                $product -> images = $request['image'];
            }
            $product->save();
            return redirect()->back()->with('success','Product updated successfully');
        }
        return redirect()->back()->with('error','Invalid product');
        }catch(Exception $e){
            return redirect()->back()->with('error','Error updating product:'. $e->getMessage()); 
        }
    }

    public function deleteProduct($id){
        try{
            $product = Product::find($id);
            if(!is_null($product)){
                $product->delete();
                return redirect()->back()->with('success', 'Product deleted successfully');
            }else{
                return redirect()->back()->with('error', 'Invalid product');

            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting:'.$e->getMessage());
        }
    }

    public function viewTrash(){
        $products = Product::onlyTrashed()->get();
        $data = compact('products');
        return view('ecommerce.admin.view-products-trash')->with($data);
    }

    public function restoreProduct($id){
        try{
            $product = Product::withTrashed()->find($id);
            if(!is_null($product)){
            $product->restore();
            return redirect()->back()->with('success', 'Product restored successfully');
        }else{
            return redirect()->back()->with('error','Invalid product');
        }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error restoring product');
        }
    }

    public function forceDeleteProduct($id){
        try{
            $product = Product::withTrashed()->find($id);
            if(!is_null($product)){
                $product->forceDelete();
                return redirect()->back()->with('success', 'Product deleted permanentlty');
            }else{
                return redirect()->back()->with('error', 'Invalid product');

            }
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Error deleting:'.$e->getMessage());
        }
    }
}
