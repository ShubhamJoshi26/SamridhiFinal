<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function CreateOrder(Request $request)
    {
        
        if($request->customer_id!='')
        {

            $updateInventory = InventoryController::UpdateInventoryStock($request);
            $updatedinventory = json_decode($updateInventory,true);
            if($updatedinventory['success']!='false')
            {   
                if($createorder = Order::create($request->all()))
                {
                    $order_id = 'ORD-'.$createorder->id;
                    $addorderid = Order::find($createorder->id);
                    $addorderid->order_id = $order_id;

                    if($addorderid->save())
                    {
                        $productsdata = $request->all();
                        $products = $productsdata['product'];
                        
                            foreach($products as $product)
                        {
                            
                            $OrderItem = new OrderItem;
                            
                            $OrderItem->order_id = $order_id;
                            
                            $OrderItem->product_id = $product['product_id'];
                            $OrderItem->quantity = $product['quantity'];
                            $OrderItem->price = $product['price'];
                            
                            $OrderItem->save();
                        }
                            return json_encode(array('success'=>'true','data'=>$updatedinventory,'error_code'=>302));
                        
                        
                        
                    }

                }
            }
            else
            {
                return json_encode(array('success'=>'false','data'=>'Quantity Not Available','error_code'=>303));
            }
        }
    }

    public function AddToCart(Request $request)
    {
        if($request->customer_id!='' && $request->product_id!='')
        {
            if($request->id!='')
            {
                $CartData = Cart::find($request->id);
            }
            else
            {
                $CartData = new Cart;
                $CartData->customer_id = $request->customer_id;
                $CartData->product_id = $request->product_id;
            }
            $CartData->quantity = $request->quantity;
            $CartData->price = $request->price;
            if($CartData->save())
            {
                return json_encode(array('success'=>'true','data'=>$CartData,'error_code'=>200));
            }
            else
            {
                return json_encode(array('success'=>'false','data'=>'','error_code'=>302));
            }
            
        }
    }
}
