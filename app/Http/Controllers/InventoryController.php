<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function InventoryList(Request $request)
    {
        $inventorydata = Inventory::all()->toArray();
        if(!empty($inventorydata))
        {
            
            return view('/inventory/inventorylist',['inventory'=>$inventorydata]);
        }
        else
        {
            return view('/inventory/inventorylist');
        }

    }
    public function CreateInventory(Request $request)
    {
        
        if($request->id!='')
        {
            $inventory = Inventory::find($request->id);
        }
        else
        {
            $inventory = new Inventory;
        }
        $inventory->product_id = $request->product_id;
        $inventory->stock = $request->stock;
        if($inventory->save())
        {
           return redirect('/Inventroy/InventoryList')->with('success','Inventory Added Successfull');
        }
        else
        {
           return redirect('/Inventroy/InventoryList')->with('error','Inventory Not Added');
        }
    }
    public function AddInventory(Request $req)
    {
        if($req->iid!='')
        {
            $inventory = Inventory::find($req->iid);
            $productname = Product::find($inventory['product_id'])->toArray();
            return view('/inventory/addinventory',['inventory'=>$inventory],['productname'=>$productname['name']]);
        }
        else
        {
            return view('/inventory/addinventory');
        }
    }
    public function getProducts(Request $request)
    {
        
        $data = Product::select("name",'id')
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
                    $response = array();
                foreach($data as $pro)
                {
                    $response[] = array('value'=>$pro->id,'label'=>$pro->name);
                }
        return response()->json($response);
    }
    public function DeleteInventory(Request $request)
    {
        if($request->iid!='')
        {
            $deleteInventory = Inventory::destroy($request->iid);
            if($deleteInventory)
            {
                return redirect('/Inventroy/InventoryList')->with('success','Inventory Deleted Successfull');
            }
            else
            {
                return redirect('/Inventroy/InventoryList')->with('success','Something Went Wrong');
            }
        }
        else
        {
            return redirect('/Inventroy/InventoryList')->with('success','Inventory Not Available');
        }
    }
    public function CheckExistInventory(Request $request)
    {
        if($request->id!='')
        {
            $CheckInventory = DB::table('inventories')->where('product_id','=',$request->id)->get()->toArray();
            if(count($CheckInventory)>0)
            {
                echo 'Already Exist';
            }
            else
            {
                echo 'Not Exist';
            }
        }
    }
    public static function UpdateInventoryStock(Request $request)
    {
        if(!empty($request->all()))
        {
            foreach($request->product as $product)
            {
                $getproductcount = ProductController::getProductById($product['product_id']);
                $existquantity = json_decode($getproductcount,true);
                $quantity = $existquantity['data']['inventory'];
              
                $updatedquantity = $quantity-$product['quantity'];
                if($quantity>=$product['quantity'])
                {
                    $setupdatedquantity = Product::find($product['product_id']);
                    $setupdatedquantity->inventory = $updatedquantity;
                    $setupdatedquantity->save();
                    $success = 'true';
                }
                else
                {
                    $success = 'fasle';
                }
            }
            $returndata[] = $request->product;
            if($success=='true')
            {
                return json_encode(array('success'=>'true','data'=>$returndata,'error_code'=>302));
            }
            else
            {
                return json_encode(array('success'=>'false','data'=>'','error_code'=>404));
            }
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>303));
        }
    }
}

