<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\User;
use App\Models\District;
use App\Models\Member;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        //total number of users
        $users = User::all();
        $usersCount = $users->count();

        //total number of mps
        $members = Member::all();
        $membersCount = $members->count();

        $districts = District::all();
        $districtsSum = $districts->count();

        $constituencies = Constituency::all();
        $constituenciesSum = $constituencies->count();

        $data = DB::table('member_info')
    ->select(
        DB::raw("CASE WHEN gender = 'male' THEN 'Male' ELSE 'Female' END as gender"),
        DB::raw('count(*) as number')
    )
    ->groupBy('gender')
    ->get();

$array[] = ['Gender', 'Number'];

foreach ($data as $key => $value) {
    $array[++$key] = [$value->gender, $value->number];
}


       
        return view('index', compact('user_role', 'log_user', 'constituenciesSum', 'districtsSum', 'membersCount', 'usersCount'))->with('gender', json_encode($array));
    }

}