<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function CouponList()
    {
        $coupons = Coupon::all()->toArray();
        if(!empty($coupons))
        {
            return view('/coupon/couponlist',['coupon'=>$coupons]);
        }
        else
        {
            return view('/coupon/couponlist');
        }
    }
    public function AddCoupons(Request $request)
    {
        if(!empty($request->all()))
        {
            $cid = $request->cid;
            $couponData = Coupon::find($cid);            
            if(!empty($couponData->toArray()))
            {
                return view('/coupon/addcoupon',['coupon'=>$couponData->toArray()]);
            }
            else
            {
                return view('/coupon/addcoupon');
            }
        }
        else
        {
            return view('/coupon/addcoupon');
        }
    }
    public function CreateCoupon(Request $request)
    {
        if($request->id!='')
        {
            $coupon = Coupon::find($request->id);
        }
        else
        {
            $coupon = new Coupon;
        }
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;
        if($coupon->save())
        {
            return redirect('/Coupon/CouplonsList')->with('success','Coupon Added Successfully');
        }
        else
        {
            return redirect('/Coupon/CouplonsList')->with('error','Coupon Not Added');
        }
    }
}
