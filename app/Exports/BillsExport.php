<?php

namespace App\Exports;

use App\Models\Bills;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class BillsExport implements FromView
{

    protected $start_date, $end_date, $user_id, $type, $status;

    public function __construct($start_date, $end_date, $user_id = null, $type, $status)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->status = $status;

    }

    public function view(): View
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        // Retrieve the transactions data from your database or any other source
        $datas = Bills::whereBetween('bills.created_at', [
            $this->start_date, $this->end_date,
        ])->select('bills.*', 'users.accountholdername', 'users.email', 'users.ez_account_no', 'users.cardnumber', 'users.contact')
            ->where('users.ez_account_no', '!=', null)
            ->where('users.cardnumber', '!=', null)
            ->join('users', 'users.id', 'bills.user_id')
            ->orderBy('bills.created_at', 'desc');

        if (isset($this->user_id)) {

            $datas->where('bills.user_id', $this->user_id);
        }

        if (isset($this->type)) {

            $datas->where('bills.type', $this->type);
        }

        $data = $datas->get();

        $total = $datas->sum('bills.amount');
        $user_details = User::where('id', $this->user_id)->first();
        $users = User::orderBy('id', 'DESC')->get();

        return view('reports.billexcel', [

            'data' => $data,
            'total' => $total,
            'users' => $users,
            'user_details' => $user_details,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
    }
}