<?php

namespace App\Exports;

use App\Models\Bills;
use App\Models\Giving;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{

    protected $start_date, $end_date, $user_id, $status, $type;

    public function __construct($start_date, $end_date, $user_id = null, $status = null, $type = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->status = $status;
        // $this->givingsSum = $givingsSum;
        // $this->totalBills = $totalBills;

    }

    public function view(): View
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $bills = Bills::all();
        $givings = Giving::all();

        // Retrieve the transactions data from your database or any other source
        $datas = Transaction::whereBetween('transactions.created_at', [
            $this->start_date, $this->end_date,
        ])
            ->select('transactions.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber')
            ->join('users', 'users.id', 'transactions.user_id')
            ->orderBy('transactions.created_at', 'desc')
            ->where('users.ez_account_no', '!=', null)
            ->where('users.cardnumber', '!=', null);

        if (isset($this->user_id)) {

            $datas->where('transactions.user_id', $this->user_id);
        }
        if (isset($this->status)) {

            $datas->where('transactions.status', $this->status);
        }

        if (isset($this->type)) {

            $datas->where('transactions.type', $this->type);
        }

        $data = $datas->get();

        $givingsSum = $givings->sum('amount');
       
        $totalBills = $bills->sum('amount');

        $total = $datas->sum('transactions.amount');
        $user_details = User::where('id', $this->user_id)->first();

        return view('transactions.transactexcel', [

            'data' => $data,
            'totalBills' => $totalBills,
            'givingsSum' => $givingsSum,
            'total' => $total,
            'user_details' => $user_details,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);
    }
}