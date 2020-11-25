<?php

namespace App\Http\Controllers;

use App\Models\Company; // model eklendi buraya böyle
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //kullanıcı bağlımı diye sorgulayabilmek için ekledik

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$companies = Company::all(); //tüm şirketleri alıyor
        if(Auth::check()){
            /*dump(Auth::id());// veriyi gösteriyo dd gibi
            $user_id=Auth::user()->id;
            dump($user_id);*/
            $companies = Company::where('user_id',Auth::user()->id)->get();
            return view('companies.index',['companies'=> $companies]); //companies.index dosya yolu resource>view deki
        }else{
            return view('auth.login');
        }
        
    
        //return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::check()){
            return view('companies.create');
        }
        return view('auth.login');

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
        if(Auth::check()){ //eğer kullanıcı bağlı ise auth clasındaki static method/fonksiyon checki cagırdı
            $company = Company::create([//company clasındaki creati çağırdı
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'user_id'=>Auth::user()->id //Auth::id();forma id koymadık çünkü güvenlik sebebi ile oturumdan aldık
                ]);
        
            if($company){
                return redirect()->route('companies.show',['company'=>$company->id])->with('success','Company creates succesfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new company');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        if(Auth::check()){
            $company = Company::find($company->id);
            return view('companies.show',['company'=> $company]);
        }else{
            return view('auth.login');
        }
        //$company = Company::where('id',$company->id)->first();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        if(Auth::check()){
            $company = Company::find($company->id);
            return view('companies.edit',['company'=> $company]);
        }
        return view('auth.login');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //save data update data
        $companyUpdate = Company::where('id',$company->id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        //if true return işlem tamam ise
        if($companyUpdate){
            return redirect()->route('companies.show',['company'=>$company->id])->with('success','Company updated Succesfully'); //mesaj göstericez
        }
        //redirect if not true eğer hatalı ise
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
        //dd($company); //verileri gösteriyor silmiyor
        $findCompany = Company::find($company->id);
        if($findCompany->delete()){
            //redirect
            return redirect()->route('companies.index')->with('success','Company deleted succesfully');
        }
        return back()->withInput->with('errors','Company could not be deleted');

    }
}
