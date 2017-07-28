<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use DB;
use APP\Helpers\SumNumber;
use App\Http\Requests;

class MemberControllerl extends Controller
{
    private $m;
    public function __construct(Member $m){
        $this->m = $m;
    }
 
    public function index()
    {
        $dates = new \DateTime();
        $time = $dates->format('m-d');
        $catarot = DB::table('lovetodayinfos')->where('ngay', 'LIKE', '%'.$time.'%')->get();
        if(!$catarot){
            return response()->json(['Status'=> false ,'Message' => 'Not Found', 'Code'=> 400], 200);
        }
        else{
            return response()->json([
                'Status'=>'true',
                'Message'=>'record found',
                'Lovetoday' => $catarot
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userid, $birthday, $gender)
    {
        $userid = addslashes($userid);
        $birth = addslashes($birthday);
        $gende = addslashes($gender);
        $time = new \DateTime();
        $user = $this->m->where('UserID', $userid)->first();
        if(!$user){
            $item = [
                'UserID' => $userid,
                'birthday' => $birth,
                'Gender' => $gende,
                'created_at' => $time
            ];
            $this->m->insert($item);
            return response()->json(['Status'=> true ,'Message' => 'Ok', 'Code'=> 200], 200);
        }else{
            return response()->json(['Status'=> false ,'Message' => 'UserId exist', 'Code'=> 400], 200);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
