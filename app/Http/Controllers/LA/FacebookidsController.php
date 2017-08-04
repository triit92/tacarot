<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Facebookid;

class FacebookidsController extends Controller
{
	public $show_action = true;
	public $view_col = 'UserID';
	public $listing_cols = ['id', 'UserID', 'birthday', 'Gender'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Facebookids', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Facebookids', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Facebookids.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Facebookids');
		
		if(Module::hasAccess($module->id)) {
			return View('la.facebookids.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new facebookid.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created facebookid in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Facebookids", "create")) {
		
			$rules = Module::validateRules("Facebookids", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Facebookids", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.facebookids.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified facebookid.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Facebookids", "view")) {
			
			$facebookid = Facebookid::find($id);
			if(isset($facebookid->id)) {
				$module = Module::get('Facebookids');
				$module->row = $facebookid;
				
				return view('la.facebookids.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('facebookid', $facebookid);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("facebookid"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified facebookid.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Facebookids", "edit")) {			
			$facebookid = Facebookid::find($id);
			if(isset($facebookid->id)) {	 
				$module = Module::get('Facebookids');
				
				$module->row = $facebookid;
				
				return view('la.facebookids.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('facebookid', $facebookid);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("facebookid"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified facebookid in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Facebookids", "edit")) {
			
			$rules = Module::validateRules("Facebookids", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Facebookids", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.facebookids.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified facebookid from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Facebookids", "delete")) {
			Facebookid::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.facebookids.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('facebookids')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Facebookids');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) { 
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/facebookids/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>'; 
					if(!empty($data->data[$i][2])){
						$d = substr($data->data[$i][2], 0, 2);
						$m = substr($data->data[$i][2], 2, 2);
						$y = substr($data->data[$i][2], 4, 8); 
						$data->data[$i][2] = $d.'/'.$m.'/'.$y;
					} 
					if(!empty($data->data[$i][3])){
						$item = $data->data[$i][3]; 
						switch ($item) {
							case 1:
								$data->data[$i][3] = 'Nam';
								break;
							case 2: 
								$data->data[$i][3] = 'Nữ';
								break;
							default:
								$data->data[$i][3] = '3D';
								break;
						} 
					}
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = ''; 
				if(Module::hasAccess("Facebookids", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/facebookids/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Facebookids", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.facebookids.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		} 
		$out->setData($data); 
		return $out;
	}
}
