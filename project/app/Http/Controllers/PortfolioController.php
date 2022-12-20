<?php

namespace App\Http\Controllers;

use App\Portfolio;
use App\SectionTitles;
use Illuminate\Http\Request;

class PortfolioController extends Controller
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
        $language = SectionTitles::findOrFail(1);
        $portfolios = Portfolio::all();
        return view('admin.portfoliosection',compact('portfolios','language'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfoliosectionadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($files = $request->file('image')){
            foreach ($files as $file){
                $portfolio = new Portfolio();
                $photo_name = str_random(3).$file->getClientOriginalName();
                $file->move('assets/images/portfolio',$photo_name);
                $portfolio['image'] = $photo_name;
                $portfolio->save();
            }
        }
        return redirect('admin/portfolio')->with('message','Portfolio Added Successfully.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $Portfolio = Portfolio::findOrFail($id);
        return view('admin.Portfolioedit',compact('Portfolio'));
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
        $Portfolio = Portfolio::findOrFail($id);
        $data = $request->all();

        if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/portfolio',$photo_name);
            $data['image'] = $photo_name;
        }
        $Portfolio->update($data);
        return redirect('admin/portfolio')->with('message','Portfolio Updated Successfully.');
    }

    public function titles(Request $request)
    {
        $Portfolio = SectionTitles::findOrFail(1);
        $data['portfolio_title'] = $request->portfolio_title;
        $data['portfolio_text'] = $request->portfolio_text;
        $Portfolio->update($data);
        return redirect('admin/portfolio')->with('message','Portfolio Section Title & Text Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        unlink('assets/images/portfolio/'.$portfolio->image);
        $portfolio->delete();
        return redirect('admin/portfolio')->with('message','Portfolio Delete Successfully.');
    }
}
