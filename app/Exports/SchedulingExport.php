<?php

namespace App\Exports;

use App\Models\Scheduling;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class SchedulingExport implements FromView
{

    protected $start_date, $end_date, $user_id, $type, $category;

    public function __construct($start_date, $end_date, $user_id = null, $type = null, $category = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->category = $category;

    }

    public function view(): View
    {

        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        // Retrieve the transactions data from your database or any other source

        $datas = Scheduling::whereBetween('scheduling.created_at', [
            $this->start_date, $this->end_date,
        ])->select('scheduling.*', 'users.contact', 'users.cardnumber', 'users.accountholdername', 'users.ez_account_no')
        // ->where('users.ez_account_no', '!=', null)
        // ->where('users.cardnumber', '!=', null)
            ->join('users', 'users.id', 'scheduling.userid')
            ->orderBy('scheduling.created_at', 'desc');

        if (isset($this->user_id)) {

            $datas->where('scheduling.user_id', $this->user_id);
        }

        if (isset($this->type)) {

            $datas->where('scheduling.type', $this->type);
        }

        if (isset($this->category)) {

            $datas->where('scheduling.category', $this->category);
        }

        $data = $datas->get();

        //return $data;

        $total = $datas->sum('scheduling.amount');
        $user_details = User::where('id', $this->user_id)->first();
        $users = User::orderBy('id', 'DESC')->get();

        return view('transactions.scheduleexcel', [

            'data' => $data,
            'users' => $users,
            'total' => $total,
            'type' => $this->type,
            'category' => $this->category,
            'user_details' => $user_details,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

        ]);
    }
}
