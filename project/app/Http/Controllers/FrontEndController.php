<?php

namespace App\Http\Controllers;

use App\Category;
use App\Counter;
use App\Order;
use App\PageSettings;
use App\Portfolio;
use App\PricingTable;
use App\SectionTitles;
use App\Service;
use App\ServiceSection;
use App\Settings;
use App\Subscribers;
use App\Testimonial;
use App\UserAccount;
use App\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = SectionTitles::findOrFail(1);
        $services = ServiceSection::all();
        $portfilos = Portfolio::all();
        $counters = Counter::all();
        $testimonials = Testimonial::all();
        return view('index', compact('services','portfilos','testimonials','counters','languages'));
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
        //
    }

    //Profile Data
    public function viewprofile($id)
    {
        $profiledata = UsersModel::findOrFail($id);
        return view('profile', compact('profiledata'));
    }

    //Contact Page Data
    public function contact()
    {
        $pagedata = PageSettings::find(1);
        return view('contact', compact('pagedata'));
    }

    //About Page Data
    public function about()
    {
        $pagedata = PageSettings::find(1);
        return view('about', compact('pagedata'));
    }

    //FAQ Page Data
    public function faq()
    {
        $pagedata = PageSettings::find(1);
        return view('faq', compact('pagedata'));
    }

    //Show All Users
    public function all()
    {
        $cities = UsersModel::distinct()->get(['city']);
        $categories = Category::all();
        $allusers = UsersModel::where('status', 1)->get();
        $pagename = "All Lawyers List";
        return view('listall', compact('allusers','pagename','categories','cities'));
    }

    //Show Featured Users
    public function featured()
    {
        $cities = UsersModel::distinct()->get(['city']);
        $categories = Category::all();
        $allusers = UsersModel::where('featured', 1)
            ->where('status', 1)
            ->get();
        $pagename = "Featured Lawyers List";
        return view('listall', compact('allusers','pagename','categories','cities'));
    }

    //Show Category Users
    public function category($category)
    {
        $categories = Category::where('slug', $category)->first();
        $services = Service::where('status', 1)
            ->where('category', $categories->id)
            ->get();
        $pagename = "All Sevices in: ".ucwords($categories->name);
        return view('services', compact('services','pagename','categories'));
    }

    //Show Searched Users
    public function order($id)
    {

        $pricing = PricingTable::where('status', 1)
            ->where('id', $id)
            ->first();

        return view('order', compact('pricing'));
    }

    //User Subscription
    public function subscribe(Request $request)
    {
        $subscribe = new Subscribers;
        $subscribe->fill($request->all());
        $subscribe->save();
        Session::flash('subscribe', 'You are subscribed Successfully.');
        return redirect('/');
    }

    //Send email to user
    public function usermail(Request $request)
    {
    	$userdata = UsersModel::find($request->to);
        $subject = "Email From Of Lawyer Profile";
        $to = $userdata->email;
        $name = $request->name;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;

        Session::flash('pmail', 'Email Sent !!');
        mail($to,$subject,$msg);

        return redirect('/profile/'.$request->to.'/'.$userdata->name);
    }
    
    //Send email to Admin
    public function contactmail(Request $request)
    {
        $settings = Settings::findOrFail(1);
        $pagedata = PageSettings::findOrFail(1);
        $subject = "Contact From Of ".$settings->title;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $department = $request->department;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$request->phone."\nGender ".$request->department."\nMessage: ".$request->message;

        mail($to,$subject,$msg);

        Session::flash('cmail', $pagedata->contact);
        return redirect('/contact');
    }

    public function checkacc($email)
    {
        if (UserAccount::where('email', $email)->exists()){
            return "exist";
        }else{
            return "not";
        }
    }

    public function payaferservice(Request $request)
    {
        $sdetails = PricingTable::findOrFail($request->service);

        $settings = Settings::findOrFail(1);
        $order = new Order;
        $success_url = action('PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $sdetails->cost;

        $order['planid'] = $request->service;
        $order['pay_amount'] = $item_amount;
        $order['method'] = "Pay After Service";
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['customer_phone'] = $request->phone;
        $order['order_date'] = date('Y-m-d H:i:s');
        $order['order_number'] = $item_number;
        $order['customer_address'] = $request->address;
        $order['customer_city'] = $request->city;
        $order['customer_zip'] = $request->zip;
        $order['payment_status'] = "Completed";
        $order->save();

        return redirect($success_url);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
