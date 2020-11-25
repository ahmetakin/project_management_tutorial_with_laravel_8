<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //kullanıcı bağlımı diye sorgulayabilmek için ekledik

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$projects = Project::all(); //tüm şirketleri alıyor
        if(Auth::check()){
            /*dump(Auth::id());// veriyi gösteriyo dd gibi
            $user_id=Auth::user()->id;
            dump($user_id);*/
            $projects = Project::where('user_id',Auth::user()->id)->get();//giren kullanıcnının projelerini listeliyor
            return view('projects.index',['projects'=> $projects]); //projects.index dosya yolu resource>view deki
        }else{
            return view('auth.login');
        }
        
    
        //return view('projects.index');
    }

    public function adduser(Request $request){
        //add user to project
        //take a project, add a user to it
        $project = Project::find($request->input('project_id'));

        
        if(Auth::user()->id == $project->user_id){ 
            $user = User::where('email',$request->input('email'))->first();//user modelini kullanarak
            if($user && $project){
                $project->users()>attach($user->id);
                return redirect()->route('projects.show',['project'=>$project.id])->with('success',$request->input('email') . ' was Added project succesfully');
            }
        }else{
            return redirect()->route('projects.show',['project'=>$project.id])->with('errors',' Error Adding user to project');
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)//eğer boş ise
    {
        //
        $companies = null;
        if(!$company_id){//eğer boş ise
            $companies = Company::where('user_id', Auth::user()->id)->get();//company modelini çağırdık yukarıda veri tabanı için
        }
        //dump($id);
        return view('projects.create',['company_id'=>$company_id,'companies'=>$companies]);
           

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
            $project = Project::create([//project clasındaki creati çağırdı
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'company_id'=>$request->input('company_id'),
                'user_id'=>Auth::user()->id //Auth::id();forma id koymadık çünkü güvenlik sebebi ile oturumdan aldık
                ]);
        
            if($project){
                return redirect()->route('projects.show',['project'=>$project->id])->with('success','project creates succesfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new project');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        //dd($project);
        
            $project = Project::find($project->id);

            $comments=$project->comments;
                       
            return view('projects.show',['project'=> $project,'comments'=>$comments]);
            
        
        //$project = Project::where('id',$project->id)->first();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        if(Auth::check()){
            $project = Project::find($project->id);
            return view('projects.edit',['project'=> $project]);
        }
        return view('auth.login');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data update data
        $projectUpdate = Project::where('id',$project->id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        //if true return işlem tamam ise
        if($projectUpdate){
            return redirect()->route('projects.show',['project'=>$project->id])->with('success','project updated Succesfully'); //mesaj göstericez
        }
        //redirect if not true eğer hatalı ise
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        //dd($project); //verileri gösteriyor silmiyor
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            //redirect
            return redirect()->route('projects.index')->with('success','project deleted succesfully');
        }
        return back()->withInput->with('errors','project could not be deleted');

    }

}
