<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lovetoday;

use App\Http\Requests;

class LovetodayController extends Controller
{

	private $l;
    /**
    *
    */
    function __construct(Lovetoday $l){
        $this->l = $l;
    }

    public function all() {
        
        $list = $this->l->all();
        if(!$list){
            return response()->json(['STATUS'=> false ,'MESSAGE' => 'Not Found', 'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=>'true',
                    'MESSAGE'=>'record found',
                    'DATA' => $list
            ], 200);
        }
    }

    public function index()
    {
        die('afsaf');
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
        $input = Input::all();
        return $input;
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
