<?php

namespace App\Http\Controllers;

use App\UserAccount;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = UserAccount::orderBy('id','desc')->get();
        return view('admin.customers',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = UserAccount::findOrFail($id);
        return view('admin.customerdetails',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function email($id)
    {
        $customer = UserAccount::findOrFail($id);
        return view('admin.sendemail', compact('customer'));
    }

    public function sendemail(Request $request)
    {
        mail($request->to,$request->subject,$request->message);
        return redirect('admin/customers')->with('message','Email Send Successfully');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function status($id,$status)
    {
        $customer = UserAccount::findOrFail($id);
        $data['status']=$status;
        $customer->update($data);
        return redirect('admin/customers')->with('message','Customer Account Status Changed Successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = UserAccount::findOrFail($id);
        $customer->delete();
        return redirect('admin/customers')->with('message','Customer Delete Successfully.');
    }

}
