<?php

namespace App\Exports;

use App\Models\Groups;
use App\Models\Sections;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{

    protected $start_date, $end_date, $user_id, $type;

    public function __construct($start_date, $end_date, $user_id = null, $type = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
        $this->type = $type;

    }

    public function view(): View
    {
        //

        $data = User::orderBy('id', 'DESC')->paginate(10);
        $roles = Auth::user()->roles()->first();
        $user_role = $roles->name;
        $user_id = Auth::user()->id;
        $log_user = User::find($user_id);
        $groups = Groups::orderBy('created_at', 'DESC')->get();
        $sections = Sections::orderBy('created_at', 'DESC')->get();
        // Retrieve the transactions data from your database or any other source

        $type = $this->type;

        if ($this->type == 'Active') {

            $data = User::where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

            $total = $data->count();

            $title = 'Active Users';

        } elseif ($this->type == 'Bill') {
            $data = User::join('bills', 'bills.user_id', 'users.id')
                ->select('bills.user_id', 'users.*')
                ->groupBy('bills.user_id')
                ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

            $total = $data->count();

            $title = 'Users Paying Bills';

        } elseif ($this->type == 'TopUps') {

            $data = User::join('transactions', 'transactions.user_id', 'users.id')
                ->where('transactions.type', 'topup')
                ->select('transactions.user_id', 'users.*')
                ->groupBy('transactions.user_id')
                ->where('ez_account_no', '!=', null)->where('cardnumber', '!=', null)->get();

            $total = $data->count();

            $title = 'Users Topping Up';

        }

        return view('reports.udataexcel', [

            'data' => $data,
            'type' => $type,
            'title' => $title,
            'total' => $total,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

        ]);
    }
}
