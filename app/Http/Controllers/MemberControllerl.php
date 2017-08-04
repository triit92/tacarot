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
 
    public function index($zodiac)
    {
        $number = SumNumber::validate_input($zodiac);
        $dates = new \DateTime();
        $time = $dates->format('m-d');
        $catarot = DB::table('lovetodayinfos')->where('ngay', 'LIKE', '%'.$time.'%')->first();
        switch ($number)
        {
            case 0:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->bachduong, true);
                }
                break;
            case 1:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->kimnguu, true);
                }
                break;
            case 2:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->songtu, true);
                }
                break;
            case 3:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->cugiai, true);
                }
                break;
            case 4:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->sutu, true);
                }
                break;
            case 5:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->xunu, true);
                }
                break;
            case 6:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->thienbinh, true);
                }
                break;
            case 7:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->hocap, true);
                }
                break;
            case 8:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->nhanma, true);
                }
                break;
            case 9:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->maket, true);
                }
                break;
            case 10:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->baobinh, true);
                }
                break;
            case 11:
                if(!empty($catarot)){
                    $zodiacs = json_decode($catarot->songngu, true);
                }
                break;
            default:
                $zodiacs = 'not found';
                break;
        }
        if(!$catarot){
            return response()->json(['Status'=> false ,'Message' => 'Not Found', 'Code'=> 400], 200);
        }
        else{
            return response()->json([
                'Status'=>'true',
                'Message'=>'ok  ',
                'Lovetoday' => $zodiacs
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
        if($gende == 0){
            $gende = 2;
        }
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
        if($user->Gender == 2){
            $user->Gender = 0;
        }  
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
    public function edit($id, $birth, $gender)
    {
        $id = SumNumber::validate_input($id);
        $birth = SumNumber::validate_input($birth);
        $gender = SumNumber::validate_input($gender);
        $user = $this->m->where('UserID', $id)->first();
        if(count($user) == 1){
            $item = [
                'birthday' => $birth,
                'Gender' => $gender
            ];
            $this->m->where('UserID', $id)->update($item);
            return response()->json(['Status'=> true ,'Message' => 'ok', 'code' => 200], 200);
        }
        else{
            return response()->json([
                'Status'=> false,
                'Message'=>'Update failed',
                'code' => 204
            ], 200);
        }
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
