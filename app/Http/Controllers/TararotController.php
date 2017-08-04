<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tararot;
use DB;

use App\Helpers\SumNumber;

class TararotController extends Controller
{

    private $t;
    public function __construct(Tararot $t){
        $this->t = $t;
    }

    public function index($user)
    {
        $id = SumNumber::validate_input($user);
        $history = $this->t->where('UserID', $id)->get();
        $data = [];
        foreach ($history as $k => $v){
            $item = array(
                'UserID'=> $v['UserID'],
                'dayofyear' => $v['dayofyear'],
                'value_one' => $v['value_one'],
                'type_one' => $v['type_one'],
                'value_two' => $v['value_two'],
                'type_two' => $v['type_two'],
                'value_three' => $v['value_three'],
                'type_three' => $v['type_three'],
                'value_four' => $v['value_four'],
                'type_four' => $v['type_four'],
                'detail_result' => $v['detail_result']
            );
            array_push($data, $item);
        }
        if(!empty($data))
        {
            return response()->json([
                'Status'=>'true',
                'Message'=>'ok',
                'result' => $data
            ], 200);
        }else{
            return  response()->json(['Status'=>'false','Message'=>'Not content','code' => 204], 200);
        }
    }

    public function create($userid, $card1, $matter1, $card2, $matter2, $card3, $matter3, $card4, $matter4)
    {
        /*
        100 sự nghiệp
        101 Tình yêu
        102 Tai họa
        103 Tiền tài
        */
        $userid = SumNumber::validate_input($userid);
        $card1 = SumNumber::validate_input($card1);
        $matter1 = SumNumber::validate_input($matter1);
        $card2 = SumNumber::validate_input($card2);
        $matter2 = SumNumber::validate_input($matter2);
        $card3 = SumNumber::validate_input($card3);
        $matter3 = SumNumber::validate_input($matter3);
        $card4 = SumNumber::validate_input($card4);
        $matter4 = SumNumber::validate_input($matter4);
        $number = [
            $card1 => $matter1,
            $card2 => $matter2,
            $card3 => $matter3,
            $card4 => $matter4
        ];
        $result_tacarot = '';
        $dates = new \DateTime();
        foreach ($number as $k => $row){
            $result = DB::table('tarotcards')->where(array('number' => $k, 'deleted_at' => null))->first();
            switch ($row){
                case 100:
                    if(!empty($result)){
                        $result_tacarot .= $result->clubs;
                    }
                    break;
                case 101:
                    if(!empty($result)) {
                        $result_tacarot .= $result->hearts;
                    }
                    break;
                case 102:
                    if(!empty($result)) {
                        $result_tacarot .= $result->spade;
                    }
                    break;
                case 103:
                    if(!empty($result)) {
                        $result_tacarot .= $result->diamonds;
                    }
                    break;
                default:
                    $result_tacarot .= '';
                    break;
            }
        }
        $relt = $result_tacarot;
        $item = [
            'UserID' => $userid,
            'value_one' => $card1,
            'type_one' => $matter1,
            'value_two' => $card2,
            'type_two' => $matter2,
            'value_three' => $card3,
            'type_three' => $matter3,
            'value_four' => $card4,
            'type_four' => $matter4,
            'detail_result'=> $relt,
            'dayofyear' => $dates
        ];
        $time = $dates->format('Y-m-d');
        $user = $this->t->where('UserID',$userid)->where('dayofyear', 'LIKE', '%'.$time.'%')->first();
        if(!$user)
        {
            $this->t->insert($item);
        }else{
            $this->t->where('UserID',$userid)->where('dayofyear', 'LIKE', '%'.$time.'%')->update($item);
        }
        return response()->json([
            'Status'=>'true',
            'Message'=>'ok',
            'result' => $relt
        ], 200);
    }
}
