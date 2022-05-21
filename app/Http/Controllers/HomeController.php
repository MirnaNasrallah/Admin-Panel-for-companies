<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\User;
use App\Models\UserCompany;
class HomeController extends Controller
{
    public function show()
    {
       return view('auth.user-dashboard');
    }

    public function edit($id)
    {
        $companies = Companies::all();
       return view('auth.user-edit',compact('companies'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->abc == null){

            $user_company = UserCompany::where('user_id',$id)->get();
            foreach($user_company as $user){
                $user->delete();
            }
            $company = Companies::all()->pluck('id')->toArray();
            $user_company = new UserCompany();
            $user_company->user_id = $id;
            $user_company->company_id = $company[0];
            $user_company->save();

        }
        else{
            $user_company = UserCompany::where('user_id',$id)->get();
            foreach($user_company as $user){
                $user->delete();
            }

            $user_company = new UserCompany();
            $user_company->user_id = $id;
            $user_company->company_id = $request->abc;
            $user_company->save();
        }
        $user->save();

        return redirect(route('user.show'));

    }


     public function index()
    {
        return view('home');
    }
}
