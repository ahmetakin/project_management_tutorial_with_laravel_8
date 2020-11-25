@extends('layouts.app') 

@section('content')


    <div class="row col-md-9 col-lg-9 col-sm-9 pull-left"><!-- sol tarafa çektik -->
        <!-- Example row of columns -->
          <div class="row col-md-12 col-lg-12 col-sm-12" style="margin: 10px;">
            <form method="post" action="{{ route('projects.update',[$project->id]) }}"><!-- post action url update method of controller -->
                @csrf<!-- korumak için validate to request middleware-->
                <input type="hidden" name="_method" value="put"><!-- method field can bi put/delete/patch spoof http verbs-->
                <div class="form-group">
                    <label for="project-name">Name<span class="required">*</label>
                    <input placeholder="Enter Name" id="project-name" required name="name" spellcheck="false" class="form-control" value="{{$project->name}}"/>
                </div>
                <div class="form-group">
                    <label for="project-content">Description<span class="required"></label>
                    <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" required name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left">{{$project->description}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </form>
          </div>
        <!-- Site footer -->
        <footer class="footer">
          <p>© 2016 project, Inc.</p>
        </footer>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right"> <!-- sağ tarafa çektik -->
        <!--<div class="sidebar-module sidebar-module-inset">
          <h4>About</h4>
          <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>-->

        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
            <li><a href="/projects/{{$project->id}}">View  Projects</a></li><!--Actions Handled By Resource Controller bak -->
            <li><a href="/projects">All  projects</a></li><!--Actions Handled By Resource Controller bak -->
            </ol>
          </div>


        <!--<div class="sidebar-module">
          <h4>Members</h4>
          <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
          </ol>
        </div>-->
    </div>

    

  @endsection