<?php


namespace App\Http\Controllers\Auth;

use App\Events\AlertEvent;
use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function registerOpen()
    {
       $items = Companies::all();

       return view('auth.register',[
           'companies' => $items,
       ]);

    }

    public function register(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;

        $user->save();
        $user_company = new UserCompany();
        if($request->abc == null){
            $company = Companies::all()->pluck('id')->toArray();
            $user_company->user_id = $user->id;
            $user_company->company_id = $company[0];
        }
        else{
            $user_company->user_id = $user->id;
            $user_company->company_id = $request->abc;

        }
        $user_company->save();
        $company_name = Companies::where('id',$user_company->company_id)->pluck('name')->toArray()[0];
        $message = $request->name." entered ".$company_name;
        broadcast(new AlertEvent($message));
        return redirect()->route('user.login');
    }

}
