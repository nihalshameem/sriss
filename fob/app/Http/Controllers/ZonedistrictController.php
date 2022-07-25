<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonedistrictController extends Controller
{
    public function index()

		{
		$zones = DB::table('zones')->OrderBy('id','ASC')->get();

		return view('zone_data',compact('zones'));
		}

	public function getDistrict(Request $request) {

		$districts = DB::table("districts")->where("zoneid",$request->zoneid)->OrderBy('id','ASC')->pluck("district","id");

		return response()->json($districts);

}
}
