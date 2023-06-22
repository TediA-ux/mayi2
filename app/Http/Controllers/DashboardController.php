<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\Giving;
use App\Models\Transaction;
use App\Models\User;
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
        $users = User::where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();
        $usersCount = $users->count();

        //total number of transactions
        $transactions = Transaction::all();
        $transactionsCount = $transactions->count();

        $givings = Giving::all();
        $GivingsSum = $givings->sum('amount');

        $topUps = Transaction::where('type', 'topup');
        $topUpsSum = $topUps->sum('amount');

        $bills = Bills::all();
        $totalBills = $bills->sum('amount');

        $overallTotal = $GivingsSum + $topUpsSum + $totalBills;

        $Gperc = round(($GivingsSum / $overallTotal) * 100);

        $Tperc = round(($topUpsSum / $overallTotal) * 100);

        $Bperc = round(($totalBills / $overallTotal) * 100);

        $lastSevenDays = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());

        $transact = Transaction::select([
            DB::raw('DATE(created_at) AS date'),
        ])->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
        $visitsChartByDay = array();

        if (!empty($transact)) {
            foreach ($transact as $transdate) {
                $transc = Transaction::whereDate('created_at', '=', $transdate->date);

                $trans_c = $transc->sum('amount');

                $counts[] = $trans_c;

            }

            if (empty($counts)) {
                $counts = ['0', '0', '0', '0', '0', '0', '0'];
            }

        } else {
            $counts = ['0', '0', '0', '0', '0', '0', '0'];
        }

        //Pending Trips

        foreach ($lastSevenDays as $date) {
            $dateString = $date->format('jS M Y');
            $dates[] = $dateString;
        }

        $dates = array_reverse($dates);

        //return $counts;

        //return $Tperc;
        return view('index', compact('dates', 'counts', 'Gperc', 'Tperc', 'Bperc', 'user_role', 'log_user', 'usersCount', 'transactionsCount', 'GivingsSum', 'topUpsSum'));
    }

}