<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\CustomerAddress;
use Faker\Provider\ar_EG\Address;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
class CustomerController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'emailid' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = md5($input['password']);
        $customer = customer::create($input);
        
        $success['token'] =  $customer->createToken('MyApp')->plainTextToken;
        $success['name'] =  $customer->name;
   
        return $this->sendResponse($success, 'customer register successfully.');
    }
   
    public function login(Request $request)
    {
        
        $email = $request->emailid;
        $password = md5($request->password);
        // print_r($password);print_r($email);die("dsd");
        $GetCustomer = DB::table('customers')->where('emailid','=',$email)->where('password','=',$password)->get()->toArray(true);
        // print_r($GetCustomer);die("Dsd");
        if(!empty($GetCustomer))
        {
            return $this->sendResponse($GetCustomer, 'customer LoginL successfully.');
        }
        else
        {
            return $this->sendError($request->all(), 'Invalid User');
        }
    }

    public function CreateCustomerAddress(Request $request)
    {
        if($request->customer_id!='')
        {
            $address = $request->all();
            $CreateAddress = CustomerAddress::create($address);
            if(!empty($CreateAddress->toArray()))
            {
                return $this->sendResponse($CreateAddress->toArray(), 'Address Created Successfully.');
            }
            else
            {
                return $this->sendError($request->all(), 'Address Not Created');
            }
        }
    }

    public function UpdateCustomerAddress(Request $request)
    {
        if($request->id!='')
        {
            $CheckOldDefault = DB::table('address')->where('customer_id','=',$request->customer_id)->where('default','=','1')->get();
            if(!empty($CheckOldDefault->toArray()))
            {
                $getdeafault = CustomerAddress::find($CheckOldDefault[0]->id);
                $getdeafault->default = '0';
                if($getdeafault->save())
                {
                    $setdeafault = CustomerAddress::find($request->id);
                    $setdeafault->default = '1';
                    if($setdeafault->save())
                    {
                        return $this->sendResponse($setdeafault->toArray(), 'Address Updated Successfully.');
                    }
                    else
                    {
                        return $this->sendError($request->all(), 'Address Not Updated');
                    }
                }
            }
            else
            {
                $setdeafault = CustomerAddress::find($request->id);
                    $setdeafault->default = '1';
                    if($setdeafault->save())
                    {
                        return $this->sendResponse($setdeafault->toArray(), 'Address Updated Successfully.');
                    }
                    else
                    {
                        return $this->sendError($request->all(), 'Address Not Updated');
                    }
            }
            
        }
    }

    public function CustomerList()
    {
        $allCustomers = customer::all()->toArray();
        if(!empty($allCustomers))
        {
            return view('/customer/customerlist',['customers'=>$allCustomers]);
        }
        else
        {
            return view('/customer/customerlist');
        }
    }
    // public function EditCustomer(Request $req)
    // {
    //     if($req->id!='')
    //     {
    //         $getCustomer = customer::find($req->id);
    //         print_r($getCustomer);die("Dsd");
            
    //     }
    // }
}
