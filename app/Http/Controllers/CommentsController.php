<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $comment = Comment::create([//company clasındaki creati çağırdı
                'body'=>$request->input('body'),
                'url'=>$request->input('url'),
                'commentable_type'=>$request->input('commentable_type'),
                'commentable_id'=>$request->input('commentable_id'),
                'user_id'=>Auth::user()->id //Auth::id();forma id koymadık çünkü güvenlik sebebi ile oturumdan aldık
                ]);
        
            if($comment){
                return back()->with('success','Comment created succesfully');//nerden geldiysek oraya dönüyor
            }
        }

        return back()->withInput()->with('errors', 'Error creating comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
