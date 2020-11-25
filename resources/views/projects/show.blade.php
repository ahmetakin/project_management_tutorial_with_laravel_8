@extends('layouts.app') 

@section('content')


    <div class="col-md-9 col-lg-9 col-sm-9 pull-left"><!-- sol tarafa çektik -->
        <!-- The justified navigation menu is meant for single line per list item.
            Multiple lines will require custom code not provided by Bootstrap. -->
        <!-- Jumbotron -->
        <div class="well well-lg ">
          <h1>{{$project->name}}</h1>
          <p class="lead">{{$project->description}}</p>
          <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
        </div>
        <!-- Example row of columns -->        
        @include('partials.comments'); <!--tekrar kodlamaktan kurtulduk-->
          
            <!--<a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a>-->
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 com-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">
                          <span class="glyphicon glyphicon-comment"></span> 
                         Add Comment
                      </h3>
                  </div>
                  <div class="panel-body">
                    <form class="" method="post" action="{{ route('comments.store') }}"><!-- post action url update method of controller -->
                        @csrf<!-- korumak için validate to request middleware-->
                        <div class="form-group">
                          <input type="hidden" name="commentable_type" value="App\Models\Project"><!-- hangi class yani model olduğunu anlatıyor belirtiyor -->
                          <input type="hidden" name="commentable_id" value="{{$project->id}}">
                        </div>
                        <!--<input type="hidden" name="_method" value="put"> buna gerek yok create de method field can bi put/delete/patch spoof http verbs-->
                        <div class="form-group">
                            <label for="comment-body">Comment<span class="required"></label>
                            <textarea placeholder="Enter Comment" style="resize: vertical" id="comment-body" required name="body" rows="3" spellcheck="false" class="form-control text-left"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="comment-url">Proof of work done(Url/Photos)<span class="required"></label>
                          <textarea placeholder="Enter Url or Screenshoots" style="resize: vertical" id="comment-url" required name="url" rows="2" spellcheck="false" class="form-control text-left"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
             </div>             
              
        <!-- Site footer -->
        
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right"> <!-- sağ tarafa çektik -->
        <!--<div class="sidebar-module sidebar-module-inset">
          <h4>About</h4>
          <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>-->

        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
            <li><a href="/projects/{{$project->id}}/edit">Edit</a></li><!--Actions Handled By Resource Controller bak -->
            <li><a href="/projects">My projects</a></li>
            <li><a href="/projects/create">Create new project</a></li>

            <br/>
            @if($project->user_id == Auth::user()->id) <!--eğer aynı ise proje sahibi ile yanlışlıkla silmemek için-->           
            <li>
                <a href="#" onclick="
                          var result=confirm('Are you sure you wish to delete this Project?');
                          if(result){
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                          }">Delete</a>
                <form id="delete-form" action="{{route('projects.destroy',[$project->id])}}" method="POST" style="display:none;">
                  <input type="hidden" name="_method" value="delete"> <!-- ne yapmak istediğimizi gönderiyoruz method -->
                  @csrf
                </form>
                

              </li>
              @endif
              <!--<li><a href="#">Add new member</a></li>-->
            </ol>
            <hr/>
            <h4>Add Members</h4>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <form id="add-user" action="{{route('projects.adduser')}}" method="POST" >
                  @csrf
                <div class="input-group"> 
                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">
                  <input type="text" class="form-control" name="email" placeholder="Email">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Add!</button>
                  </span>
                </div>
                </form>
              </div>
          </div>

          <hr/>
        <div class="sidebar-module">
          <h4>Members</h4>
          <ol class="list-unstyled">
            @foreach($project->users as $user)
          <li><a href="#">{{$user->email}}</a></li>
            @endforeach
          </ol>
        </div>
    </div>

    

  @endsection