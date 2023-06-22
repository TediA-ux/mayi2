<?php

namespace App\Http\Controllers;

use App\Exports\BillsExport;
use App\Exports\GivingExport;
use App\Exports\SchedulingExport;
use App\Exports\TopupExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\Bills;
use App\Models\Giving;
use App\Models\Groups;
use App\Models\Scheduling;
use App\Models\Sections;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function Transactions()
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $data = Transaction::join('users*', 'users.id', 'transactions.user_id')
            ->select('transactions.*', 'users.contact', 'users.cardnumber')
            ->where('type', 'topup')
            ->orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();
        $transactionsData = new Transaction();

        //return $topups;

        return view('reports.transaction', compact('transactionsData', 'data', 'user_role', 'users', 'log_user', 'roles'));

    }

    public function TopUps()
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $data = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->select('transactions.*', 'users.contact', 'users.cardnumber')
            ->where('type', 'topup')->orderBy('id', 'DESC')->paginate(20);
        $users = User::orderBy('id', 'DESC')->get();
        $transactionsData = new Transaction();

        //return $topups;

        return view('reports.topups', compact('transactionsData', 'data', 'user_role', 'users', 'log_user', 'roles'));

    }

    public function topupfilter(Request $request)
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $users = User::orderBy('id', 'DESC')->get();

        $data = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->select('transactions.*', 'users.contact', 'users.cardnumber')
            ->where('type', 'topup')->orderBy('id', 'DESC')->paginate(20);
        $users = User::orderBy('id', 'DESC')->get();
        $transactionsData = new Transaction();

        return view('reports.topupfilter', compact('transactionsData', 'users', 'data', 'user_role', 'users', 'log_user', 'roles'));

    }

    public function topupsgenerate(Request $request)
    {

        $transactionsData = new Transaction();

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_id = $request->user_id;
        $status = $request->status;
        $action = $request->action;
        $userid = $request->userid;
        $type = $request->type;
        $format = $request->format;

        if ($user_role == 'Super-Admin') {

            if ($action == 'excel') {
                $fileNameToDownload = 'user_transaction_report' . '_' . time() . '.' . 'xlsx';
                return Excel::download(new TopupExport($start_date, $end_date, $user_id, $status, $type), $fileNameToDownload);

            } elseif ($action == 'pdf') {

                $datas = Transaction::whereBetween('transactions.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('transactions.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->where('transactions.type', 'topup')
                    ->join('users', 'users.id', 'transactions.user_id')
                    ->orderBy('transactions.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('transactions.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('transactions.type', $type);
                }

                $data = $datas->get();

                $total = $datas->sum('transactions.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.topupdf', compact('userid', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_transaction_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);

            } else {

                $datas = Transaction::whereBetween('transactions.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('transactions.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->where('transactions.type', 'topup')
                    ->join('users', 'users.id', 'transactions.user_id')
                    ->orderBy('transactions.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('transactions.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('transactions.type', $type);
                }

                $data = $datas->get();

                $total = $datas->sum('transactions.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.topupfilter', compact('userid', 'users', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
            }
        } else {

            if ($action == 'excel') {

                $fileNameToDownload = 'user_topup_report' . '_' . time() . '.' . 'xlsx';
                return Excel::download(new TopupExport($start_date, $end_date, $user_id, $status, $type), $fileNameToDownload);

            } elseif ($action == 'pdf') {

                $datas = Transaction::whereBetween('transactions.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('transactions.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->where('transactions.type', 'topup')
                    ->join('users', 'users.id', 'transactions.user_id')
                    ->orderBy('transactions.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('transactions.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('transactions.type', $type);
                }

                $data = $datas->get();

                $total = $datas->sum('transactions.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.topupdf', compact('userid', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_transaction_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);
            } else {

                $datas = Transaction::whereBetween('transactions.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('transactions.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->where('transactions.type', 'topup')
                    ->join('users', 'users.id', 'transactions.user_id')
                    ->orderBy('transactions.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('transactions.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('transactions.type', $type);
                }

                $data = $datas->get();

                $total = $datas->sum('transactions.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.topupfilter', compact('userid', 'users', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
            }
        }
    }

    public function Schedules()
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $datas = Scheduling::join('users', 'users.id', 'scheduling.userid')
            ->select('scheduling.*', 'users.contact', 'users.cardnumber')
            ->orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();

        $transactionsData = new Transaction();

        return view('transactions.schedules', compact('transactionsData', 'datas', 'users', 'user_role', 'log_user', 'roles'));
    }

    public function schedulesgenerate(Request $request)
    {

        $transactionsData = new Transaction();

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_id = $request->user_id;
        $status = $request->status;
        $action = $request->action;
        $userid = $request->userid;
        $type = $request->type;
        $category = $request->category;
        $format = $request->format;

        if ($action == 'excel') {

            $fileNameToDownload = 'schedule_giving_report' . '_' . time() . '.' . 'xlsx';

            return Excel::download(new SchedulingExport($start_date, $end_date, $user_id, $type, $category), $fileNameToDownload);

        } elseif ($action == 'pdf') {

            $datas = Scheduling::whereBetween('scheduling.created_at', [
                $request->start_date, $request->end_date,

            ])->select('scheduling.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                ->where('users.ez_account_no', '!=', null)
                ->where('users.cardnumber', '!=', null)
                ->join('users', 'users.id', 'scheduling.userid')
                ->orderBy('scheduling.created_at', 'desc');

            if (isset($userid)) {

                $datas->where('scheduling.user_id', $userid);
            }

            if (isset($type)) {

                $datas->where('scheduling.type', $type);
            }

            if (isset($category)) {

                $datas->where('scheduling.category', $category);
            }

            $data = $datas->get();

            //return $data;

            $total = $datas->sum('scheduling.amount');
            $user_details = User::where('id', $userid)->first();
            $users = User::orderBy('id', 'DESC')->get();

            $pdf = PDF::loadView('transactions.schedulepdf', compact('userid', 'datas', 'type', 'category', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
            $fileNameToDownload = 'schedule_givings_report' . '_' . time() . '.' . 'pdf';
            return $pdf->download($fileNameToDownload);

        } else {
            // return $request->end_date;

            $datas = Scheduling::whereBetween('scheduling.created_at', [
                $request->start_date, $request->end_date,

            ])->select('scheduling.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                ->where('users.ez_account_no', '!=', null)
                ->where('users.cardnumber', '!=', null)
                ->join('users', 'users.id', 'scheduling.userid')
                ->orderBy('scheduling.created_at', 'desc');

            if (isset($userid)) {

                $datas->where('scheduling.user_id', $userid);
            }

            if (isset($type)) {

                $datas->where('scheduling.type', $type);
            }

            if (isset($category)) {

                $datas->where('scheduling.category', $category);
            }

            $data = $datas->get();

            // return $data;

            $total = $datas->sum('scheduling.amount');
            $user_details = User::where('id', $userid)->first();
            $users = User::orderBy('id', 'DESC')->get();

            return view('transactions.schedulefilter', compact('userid', 'datas', 'type', 'category', 'users', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
        }
    }

    public function givings()
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $data = Giving::join('users', 'users.id', 'givings.user_id')
            ->select('givings.*', 'users.contact', 'users.cardnumber')
            ->orderBy('id', 'DESC')->paginate(20);

        $users = User::orderBy('id', 'DESC')->get();
        $transactionsData = new Transaction();

        //return $topups;

        return view('reports.givings', compact('transactionsData', 'data', 'user_role', 'users', 'log_user', 'roles'));

    }

    public function givingsgenerate(Request $request)
    {

        //return 'hi';

        $transactionsData = new Transaction();

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_id = $request->user_id;
        $status = $request->status;
        $action = $request->action;
        $userid = $request->userid;
        $type = $request->type;
        $category = $request->category;
        $format = $request->format;

        if ($user_role == 'Super-Admin') {

            if ($action == 'excel') {

                $fileNameToDownload = 'user_giving_report' . '_' . time() . '.' . 'xlsx';

                return Excel::download(new GivingExport($start_date, $end_date, $user_id, $type, $category), $fileNameToDownload);

            } elseif ($action == 'pdf') {
                //return $request->end_date;

                $datas = Giving::whereBetween('givings.created_at', [
                    $request->start_date, $request->end_date,
                ])
                    ->select('givings.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'givings.user_id')
                    ->orderBy('givings.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('givings.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('givings.type', $type);
                }

                if (isset($category)) {

                    $datas->where('givings.category', $category);
                }

                $data = $datas->get();

                //return $data;

                $total = $datas->sum('givings.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.givingpdf', compact('userid', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_giving_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);

            } else {

                $datas = Giving::whereBetween('givings.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('givings.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'givings.user_id')
                    ->orderBy('givings.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('givings.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('givings.type', $type);
                }

                if (isset($category)) {

                    $datas->where('givings.category', $category);
                }

                $data = $datas->get();

                //return $data;

                $total = $datas->sum('givings.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.givingsfilter', compact('userid', 'type', 'category', 'users', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
            }
        } else {

            if ($action == 'excel') {
                //return $type;

                $fileNameToDownload = 'user_giving_report' . '_' . time() . '.' . 'xlsx';
                return Excel::download(new GivingExport($start_date, $end_date, $user_id, $type, $category), $fileNameToDownload);
            } elseif ($action == 'pdf') {
                $datas = Giving::whereBetween('givings.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('givings.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'givings.user_id')
                    ->orderBy('givings.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('givings.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('givings.type', $type);
                }

                if (isset($category)) {

                    $datas->where('givings.category', $category);
                }

                $data = $datas->get();

                //return $data;

                $total = $datas->sum('givings.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.givingpdf', compact('userid', 'type', 'category', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_giving_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);

            } else {

                $datas = Giving::whereBetween('givings.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('givings.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'givings.user_id')
                    ->orderBy('givings.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('givings.user_id', $userid);
                }

                if (isset($type)) {

                    $datas->where('givings.type', $type);
                }

                if (isset($category)) {

                    $datas->where('givings.category', $category);
                }

                $data = $datas->get();

                //return $data;

                $total = $datas->sum('givings.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.givingsfilter', compact('userid', 'users', 'type', 'category', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));

            }
        }
    }

    public function bills()
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $data = Bills::join('users', 'users.id', 'bills.user_id')
            ->select('bills.*', 'users.contact', 'users.cardnumber')->orderBy('id', 'DESC')->paginate(20);
        $users = User::orderBy('id', 'DESC')->get();
        $transactionsData = new Transaction();

        //return $topups;

        return view('reports.bills', compact('transactionsData', 'data', 'user_role', 'users', 'log_user', 'roles'));

    }

    public function billsgenerate(Request $request)
    {

        $transactionsData = new Transaction();

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_id = $request->user_id;
        $status = $request->status;
        $action = $request->action;
        $type = $request->type;
        $userid = $request->userid;
        $format = $request->format;

        if ($user_role == 'Super-Admin') {

            if ($action == 'excel') {
                $fileNameToDownload = 'user_bill_report' . '_' . time() . '.' . 'xlsx';

                return Excel::download(new BillsExport($start_date, $end_date, $user_id, $type, $status), $fileNameToDownload);
            } elseif ($action == 'pdf') {

                $datas = Bills::whereBetween('bills.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('bills.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber', 'users.contact')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'bills.user_id')
                    ->orderBy('bills.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('bills.user_id', $userid);
                }

                if (isset($request->type)) {

                    $datas->where('bills.type', $request->type);
                }

                $data = $datas->get();

                $total = $datas->sum('bills.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.billpdf', compact('userid', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_bill_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);

            } else {
                $datas = Bills::whereBetween('bills.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('bills.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber', 'users.contact')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'bills.user_id')
                    ->orderBy('bills.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('bills.user_id', $userid);
                }

                if (isset($request->type)) {

                    $datas->where('bills.type', $request->type);
                }

                $data = $datas->get();

                $total = $datas->sum('bills.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.billsfilter', compact('userid', 'transactionsData', 'users', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
            }
        } else {
            if ($action == 'excel') {

                $fileNameToDownload = 'user_bill_report' . '_' . time() . '.' . 'xlsx';

                return Excel::download(new BillsExport($start_date, $end_date, $userid, $type, $status), $fileNameToDownload);
            } elseif ($action == 'pdf') {
                $datas = Bills::whereBetween('bills.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('bills.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber', 'users.contact')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'bills.user_id')
                    ->orderBy('bills.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('bills.user_id', $userid);
                }

                if (isset($request->type)) {

                    $datas->where('bills.type', $request->type);
                }

                $data = $datas->get();

                $total = $datas->sum('bills.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                $pdf = PDF::loadView('reports.billpdf', compact('userid', 'transactionsData', 'total', 'user_details', 'data', 'start_date', 'end_date'))->setPaper('a4', 'landscape');
                $fileNameToDownload = 'user_bill_report' . '_' . time() . '.' . 'pdf';
                return $pdf->download($fileNameToDownload);
            } else {

                $datas = Bills::whereBetween('bills.created_at', [
                    $request->start_date, $request->end_date,
                ])->select('bills.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber', 'users.contact')
                    ->where('users.ez_account_no', '!=', null)
                    ->where('users.cardnumber', '!=', null)
                    ->join('users', 'users.id', 'bills.user_id')
                    ->orderBy('bills.created_at', 'desc');

                if (isset($userid)) {

                    $datas->where('bills.user_id', $userid);
                }

                if (isset($request->type)) {

                    $datas->where('bills.type', $request->type);
                }

                $data = $datas->get();

                $total = $datas->sum('bills.amount');
                $user_details = User::where('id', $userid)->first();
                $users = User::orderBy('id', 'DESC')->get();

                return view('reports.billsfilter', compact('userid', 'transactionsData', 'users', 'total', 'user_details', 'data', 'start_date', 'end_date', 'user_role', 'log_user', 'roles'));
            }
        }
    }

    public function userReports(Request $request)
    {
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);

        $usercount = User::where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

        $active_users = $usercount->count();

        $user_giving = User::join('givings', 'givings.user_id', 'users.id')
            ->select('givings.user_id')
            ->groupBy('givings.user_id')
            ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

        $active_givers = $user_giving->count();

        $user_topups = User::join('transactions', 'transactions.user_id', 'users.id')
            ->where('transactions.type', 'topup')
            ->select('transactions.user_id')
            ->groupBy('transactions.user_id')
            ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

        $active_toppers = $user_topups->count();

        $user_bills = User::join('bills', 'bills.user_id', 'users.id')
            ->select('bills.user_id')
            ->groupBy('bills.user_id')
            ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

        $active_billers = $user_bills->count();

        return view('reports.ureports', compact('active_givers', 'active_toppers', 'active_billers', 'active_users', 'user_role', 'log_user', 'roles'));

    }

    public function userReportsData(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(10);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $groups = Groups::orderBy('created_at', 'DESC')->get();
        $sections = Sections::orderBy('created_at', 'DESC')->get();

        return view('reports.udata', compact('data', 'user_role', 'log_user', 'groups', 'sections'));

    }

    public function userReportsDataGenerate(Request $request)
    {

        $transactionsData = new Transaction();

        $data = User::orderBy('id', 'DESC')->paginate(10);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $groups = Groups::orderBy('created_at', 'DESC')->get();
        $sections = Sections::orderBy('created_at', 'DESC')->get();

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $user_id = $request->user_id;
        $status = $request->status;
        $action = $request->action;
        $userid = $request->userid;
        $type = $request->type;
        $title = $request->title;
        $category = $request->category;
        $total = $request->total;

        if ($action == 'excel') {
            //return $type;

            $fileNameToDownload = 'user_report' . '_' . time() . '.' . 'xlsx';
            return Excel::download(new UserExport($start_date, $end_date, $user_id, $type), $fileNameToDownload);
        } elseif ($action == 'pdf') {

            $type = $request->type;

            if ($type == 'Active') {

                $data = User::where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Active Users';

            } elseif ($type == 'Bill') {
                $data = User::join('bills', 'bills.user_id', 'users.id')
                    ->select('bills.user_id', 'users.*')
                    ->groupBy('bills.user_id')
                    ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Users Paying Bills';

            } elseif ($type == 'TopUps') {

                $data = User::join('transactions', 'transactions.user_id', 'users.id')
                    ->where('transactions.type', 'topup')
                    ->select('transactions.user_id', 'users.*')
                    ->groupBy('transactions.user_id')
                    ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Users Topping Up';

            }

            $pdf = PDF::loadView('reports.udatapdf', compact('transactionsData', 'user_role', 'sections', 'log_user', 'groups', 'title', 'total', 'data'))->setPaper('a4', 'landscape');
            $fileNameToDownload = 'user_report' . '_' . time() . '.' . 'pdf';
            return $pdf->download($fileNameToDownload);

        } else {

            $type = $request->type;

            if ($type == 'Active') {

                $data = User::where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Active Users';

            } elseif ($type == 'Bill') {
                $data = User::join('bills', 'bills.user_id', 'users.id')
                    ->select('bills.user_id', 'users.*')
                    ->groupBy('bills.user_id')
                    ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Users Paying Bills';

            } elseif ($type == 'TopUps') {

                $data = User::join('transactions', 'transactions.user_id', 'users.id')
                    ->where('transactions.type', 'topup')
                    ->select('transactions.user_id', 'users.*')
                    ->groupBy('transactions.user_id')
                    ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

                $total = $data->count();

                $title = 'Users Topping Up';

            }

            return view('reports.udatafilter', compact('transactionsData', 'user_role', 'sections', 'log_user', 'groups', 'title', 'total', 'data'));

        }
    }
}
