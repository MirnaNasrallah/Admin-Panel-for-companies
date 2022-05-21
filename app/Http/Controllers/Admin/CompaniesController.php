<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Support\Str;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $items = Companies::all();
      $user_items = User::where('role_id','2')->get();

       return view('auth.admin.dashboard',[
           'companies' => $items,
           'users'=>$user_items,
           'title' => 'Companies List',
       ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view ('auth.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    $request->all();
    // //    $request->name;
       $company = new Companies();
       $company->name = $request->post('name');
       $company->email = $request->post('email');
       $company->logo = $request->post('logo');
       $company->website = $request->post('website');
       $company->save();
    //    dd($company);
    //    $request->email;
    //    $request->logo;
    //    $request->website;
    return redirect(route('companies.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::find($id);


       return view('auth.admin.edit',compact('company'));
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
        $company = Companies::find($id);
        $company->name = $request->post('name');
        $company->email = $request->post('email');
        $company->logo = $request->post('logo');
        $company->website = $request->post('website');
        $company->save();

        return redirect(route('companies.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $company = Companies::find($id);
      $company->delete();
      return redirect(route('companies.index'));

    }
    public function addUserToCompany(Request $request,$id)
    {
         $company = Companies::find($id);
        $user_company = new UserCompany();
        $user_company->user_id = $request->abc;
        $user_company->company_id = $id;
        $user_company->save();
        return redirect(route('view.user.company',$id));
    }
    public function viewUserFromCompany($id)
    {
       $company = Companies::find($id);
       return view('auth.admin.company',compact('company'),
       [
           'users'=>User::join('user_company','user_company.user_id','=','users.id')
           ->where('company_id',$company->id)->paginate(10),
           'newComers'=>User::where('role_id',2)->get(),
       ]);
    }

    public function deleteUserFromCompany($id,$user_id)
    {
      $company = Companies::find($id);
      $user_company = UserCompany::where('company_id',$company->id)
      ->where('user_id',$user_id)->first();
      $user_company->delete();
      return redirect(route('view.user.company',$id));

    }
}
