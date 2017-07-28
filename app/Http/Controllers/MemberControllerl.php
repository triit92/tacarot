<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use DB;

use App\Http\Requests;

class MemberControllerl extends Controller
{
    private $m;
    public function __construct(Member $m){
        $this->m = $m;
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
    public function create($birthday, $gender)
    {
        $item = [
            'UserID' => 
        ];
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
        $id = (int) $id;
        $user = $this->m->where('UserID', $id)->first();
        if(!$user){
            return response()->json(['Status'=> false ,'Message' => 'Not Found', 'Code'=> 400], 200);
        }
        else{
            return response()->json([
                    'Status'=>'true',
                    'Message'=>'record found',
                    'User' => $user
            ], 200);
        }       
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
