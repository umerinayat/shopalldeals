<?php

namespace App\Http\Controllers;

use App\WebsiteSetting;
use Illuminate\Http\Request;


class WebsiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function storeWebsiteSettings(Request $request)
    {   
        $id = $request->input('id');    

        if ($id == 0) 
        {
            $websiteSetting = WebsiteSetting::storeWebsiteSetting($request->all());
        } 
        else 
        {
            $websiteSetting = WebsiteSetting::get()[0];
            WebsiteSetting::updateWebsiteSetting($request->all(), $websiteSetting);
        }

        return redirect()->action('WebsiteSettingsController@edit', ['websiteSetting' => $websiteSetting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {   
       
        $websiteSetting = WebsiteSetting::get();

    
        if (count ($websiteSetting) > 0) 
        {
            return view('admin.website-settings.edit', [
                'websiteSetting' => $websiteSetting[0],
            ]);
        } else {
            $websiteSetting = new \stdClass();
            $websiteSetting->id = 0;
            $websiteSetting->footer_text = '';
            $websiteSetting->copyright_text = '';
            $websiteSetting->termsnc_text  = '';
            $websiteSetting->privacy_policy_text  = '';
            $websiteSetting->about_us  = '';
            return view('admin.website-settings.edit', [
                'websiteSetting' => $websiteSetting,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebsiteSetting $websiteSetting)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }
}
