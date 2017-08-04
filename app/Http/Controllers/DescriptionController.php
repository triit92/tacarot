<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Description;
use App\Helpers\SumNumber;

class DescriptionController extends Controller
{
	private $d;
    public function __construct(Description $d)
    {
    	$this->d = $d;
    }
    public function index()
    {
    	$data = $this->d->orderByRaw("RAND()")->first();
    	if(!$data){
    		return response()->json(['Status'=> false ,'Message' => 'Not data record', 'Code'=> 400], 200);
    	}else{
    		 return response()->json([
                'Status'=>'true',
                'Message'=>'ok',
                'Lovetoday' => $data
            ], 200);
    	}
    }
}
