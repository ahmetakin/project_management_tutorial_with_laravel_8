
@extends('layouts.app') <!-- biz ekledik layout app taki nav altına gelsin diye -->
@section('content') <!-- biz ekledik layout app taki nav altına gelsin diye -->
    

    <div class=" col-md-7 col-lg-7 col-sm-7 col-sm-offset-7 col-md-offset-3 col-lg-offset-3">
        <div class="panel panel-primary"> <!-- eger smal md eger large screen lg6 -->
            <div class="panel-heading">Projects
                <a class="pull-right btn btn-primary btn-sm" href="/projects/create">Create New</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($projects as $project)
                <li class="list-group-item"><a href="/projects/{{$project->id}}">{{$project->name}}</a></li>
                    @endforeach
                </ul><!-- linkler projects controllerin show una gidiyor -->
            </div>
        </div>
    </div>



  @endsection