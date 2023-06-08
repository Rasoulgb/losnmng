<?php

namespace App\Http\Controllers;

use App\Models\push;
use Illuminate\Http\Request;
use Pusher\PushNotifications\PushNotifications;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public  function send(Request $req, push $push)
    {
 

        $beamsClient = new PushNotifications(array(
            "instanceId" => "546b1fe4-6050-43d0-97f6-c3d10090527c",
            "secretKey" => "0FA88A0E4D49733632B2825753455DED0E40D57AF0EA625E197596005B4A1721",
          ));
          
          $publishResponse = $beamsClient->publishToInterests(
            array("hello"),
            array("web" => array("notification" => array(
              "title" => "Hello",
              "body" => "Hello, World!",
              "deep_link" => "https://www.pusher.com",
            )),
          ));
    }

    public function index()
    {
        return view('admin', ['pushes' => push::latest()->limit(10)->get()]);
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
        dd($request->push);
        push::create([
            'pushdata' => $request->push
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\push  $push
     * @return \Illuminate\Http\Response
     */
    public function show(push $push)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\push  $push
     * @return \Illuminate\Http\Response
     */
    public function edit(push $push)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\push  $push
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, push $push)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\push  $push
     * @return \Illuminate\Http\Response
     */
    public function destroy(push $push)
    {
        //
    }
}
