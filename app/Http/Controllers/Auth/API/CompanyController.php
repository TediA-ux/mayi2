<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;


class CompanyController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','store']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);

    }

    public function createCompany(Request $request)
    {
       $company = new Company;
       $company -> name = $request->name;
       $company -> address = $request->address;
       $company -> email = $request->email;
       $company -> cost_per_trip = $request->cost_per_trip;
       $company -> cost_per_wait_min = $request->cost_per_wait_min;
       $company -> approval_steps = $request->approval_steps;
       $company -> approval_order = $request->approval_order;
       $company -> save();

       return response ()->json([ 
        "message" => "company record created"
       ], 201);
    }

    public function getCompany($id)
    {
      if(Company::where('id',$id)->exists()){
        $company = Company::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($company,200);
      }else{
        return response()->json([ 
            "message" => "Student not found"
        ],404);
      }
    }

    public function getAllCompanies()
    {
       $companies= Company::get() -> toJson(JSON_PRETTY_PRINT);
       return response($companies,200);
    }

    public function updateCompany(Request $request, $id)
    {
       if (Company::where('id',$id)->exists()){
            $company = Company::find($id);
            $company-> name = is_null($request->name)? $company->name : $request->name;
            $company -> address = is_null($request->address)? $company->address: $request->address;
            $company -> email = is_null($request->email)? $company->email: $request->email;
            $company -> cost_per_trip = is_null($request->cost_per_trip)? $company->cost_per_trip: $request->cost_per_trip;
            $company-> cost_per_wait_min = is_null($request->cost_per_wait_min)? $company->cost_per_wait_min : $request->cost_per_wait_min;
            $company-> approval_steps = is_null($request->approval_steps)? $company->approval_steps : $request->approval_steps;
            $company -> approval_order = is_null($request->approval_order)? $company->approval_order: $request->approval_order;
            $company->save();

            return response ()->json([ 
                "message" => "Records updated successfully"
               ], 200); 
        }else{
            return response ()->json([ 
                "message" => "Company not found"
               ], 404); 
        }
       }
    

    public function deleteCompany ($id)
    {
        if (Company::where('id',$id)->exists()){
            $company = Company::find($id);
            $company->delete();

            return response ()->json([ 
                "message" => "Records delete"
               ], 202); 
           
        }else {
            return response ()->json([ 
                "message" => "Company not found"
               ], 404); 
        }
    }
}


