<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Image;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function CreateProduct(Request $request)
    {
        
        if($request->id!='')
        {
            $product = Product::find($request->id);
        }
        else
        {
            $product = new Product;
            
        }
        $product->name = $request->product_name;
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->type = $request->product_type;
        $product->coupons = $request->product_coupon;
        $product->category = $request->product_category;
        $product->visibility = $request->visibility;
        $product->sku = $request->product_sku;
        $product->inventory = $request->product_inventory;
        $product->title = $request->product_title;
        $product->weight = 0;
        $product->measurment = 0;
        if($product->save())
        {
        
            if($request->file('product_images')!=null)
            {
                foreach($request->file('product_images') as $file)
                    {
                            $name = time().rand(1,50).'.'.$file->extension();
                            $file->move(public_path('uploads/productimage'), $name); 
                            $path = 'uploads/productimage/'.$name; 
                            $images = new Image;
                            $images->image_path = $path;
                            $images->product_id = $product->id;
                            $images->save(); 
                    }
            }
           
           
        }
        return redirect('/Product/AddProduct?pid='.$product->id.'')->with('success','Product Added Successfully');

    }
    public function ProductList()
    {
        
        $productData = Product::join('images','images.product_id','=','products.id')->get()->toArray();
        if(!empty($productData))
        {    $productarray = [];
            foreach($productData as $product)
            {
                $productarray[$product['product_id']][] = $product;
            }
            return view('/product/productlist',['products'=>$productarray]);
        }
        else
        {
            return view('/product/productlist');
        }
        
    }
    public function AddProduct(Request $request)
    {
        $category = Category::all()->where('category_status','=','1');
        $coupons = Coupon::all()->where('status','=','1');
        if(!empty($request->all()))
        {
            $pid = $request->pid;
            $productsData = Product::find($pid);
            $imagearray = DB::table('images')->where('product_id','=',$pid)->get()->toArray();
            $images = json_decode(json_encode($imagearray),true);
            
            if(!empty($productsData->toArray()))
            {
                return view('/product/addproduct',['product'=>$productsData->toArray()],['images'=>$images,'category'=>$category->toArray(),'coupon'=>$coupons->toArray()]);
            }
            else
            {
                return view('/product/addproduct',['category'=>$category->toArray()],['coupon'=>$coupons->toArray()]);
            }
        }
        else
        {
            return view('/product/addproduct',['category'=>$category->toArray()],['coupon'=>$coupons->toArray()]);
        }
        
    }
    function DeleteProductImage(Request $req)
    {
        $delete = Image::destroy($req->id);
        return json_encode(array('success'=>'true'));
    }
    function GetAllProducts(Request $request)
    {
        $product = Product::all()->toArray();
        if($request->category)
        {
            $product = Product::all()->where('category','=',$request->category);
        }
        if($request->search)
        {
            $product = DB::table('products')->select('*')->where('*', 'LIKE', '%'. $request->search. '%');
        }
        if(isset($request->id))
        {
            $product = Product::find($request->id);
        }
        if(!empty($product))
        {
            return json_encode(array('success'=>'true','data'=>$product,'error_code'=>'10001'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'10002'));
        }
    }
    function GetAllProductsImages(Request $request)
    {
        if($request->id!='')
        {
            $images = Image::find($request->id)->toArray();
        }
        else
        {
            $images = Image::all()->toArray();
        }
        if(!empty($images))
        {
            return json_encode(array('success'=>'true','data'=>$images,'error_code'=>'10004'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'10005'));
        }
    }
    public static function getProductById($id)
    {
        if($id!='')
        {
            $productstock = Product::find($id);
            return json_encode(array('success'=>true,'data'=>$productstock,'error_code'=>'302'));
        }
        else
        {
            return json_encode(array('success'=>false,'data'=>'','error_code'=>'303'));
        }
    }
}
