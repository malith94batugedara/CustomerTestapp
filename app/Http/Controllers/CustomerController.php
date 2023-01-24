<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Province;
use App\Models\Customer;
use App\Http\Requests\CustomerFormRequest;

class CustomerController extends Controller
{
    public function index(){

        $provinces=Province::all();
        $districts = DB::table('districts')->get();
        $towns = DB::table('towns')->get();
        return view('welcome',compact('provinces','districts','towns'));

    }

    public function saveCustomer(CustomerFormRequest $request){

       
        $province_name = DB::table('provinces')->where('id',$request->province)->pluck('name');
       
        $district_name = DB::table('districts')->where('id',$request->district)->pluck('name');

        $town_name = DB::table('towns')->where('id',$request->town)->pluck('name');

      

        $data=$request->validated();

        $customer=new Customer;

        $customer->name=$data['name'];
        $customer->mobile=$data['mobile'];
        $customer->nic=$data['nic'];
        $customer->town=$town_name;
        $customer->province=$province_name;
        $customer->district=$district_name;


        $customer->save();

        return redirect(route('customer.all'))->with('message','Customer Saved Succesfully');
    }

    public function viewAllCustomer(){
        $customers=Customer::all();
        return view('all-customers',compact('customers'));
    }

    public function editCustomer($customer_id){
        $customer=Customer::find($customer_id);
        $provinces=Province::all();
        $districts = DB::table('districts')->get();
        $towns = DB::table('towns')->get();
        return view('edit-customer',compact('provinces','districts','towns','customer'));
    }

    public function updateCustomer(CustomerFormRequest $request,$customer_id){

        $data=$request->validated();

        $customer=Customer::findOrFail($customer_id);

        $customer->name=$data['name'];
        $customer->mobile=$data['mobile'];
        $customer->nic=$data['nic'];
        $customer->town=$data['town'];
       

        $customer->update();

       return redirect(route('customer.all'))->with('message','Customer Updated Successfully');

   }

   public function deleteCustomer(Request $request){
        $customer=Customer::findOrFail($request->customer_delete_id);

        if($customer){
        $customer->delete();
            return redirect(route('customer.all'))->with('message','Customer Deleted Successfully');
        }
        else{
            return redirect(route('customer.all'))->with('message','Customer Not Found');
        }
   }


   public function getDistrict($id){

    $result = DB::table('districts')->where('province_id',$id)->get();
    return response()->json(['result'=>$result]);
   

   }

   public function getTown($id){

    // return $id;
    $result = DB::table('towns')->where('district_id',$id)->get();
    return response()->json(['result'=>$result]);
   

   }
}
