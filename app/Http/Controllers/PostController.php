<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\SiteMenu;
use App\Http\Controllers\common\ImageMaker;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post=Post::all();
        return response()->json($post);
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
        $fill = (new Post)->getFillable();

        $data=array_only($request->all(),$fill);

        $data['image']=(new ImageMaker)->base64ToImage('images\\gallery',$data['image']);
        // dd($data);
        $save=Post::create($data);
        return response()->json([
            'status'=>true,
            'message'=>'Data successfully saved.',
            'req'=>$data,
            'id'=>$save->id
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $menus=SiteMenu::all(['id as value','text']);
        return response()->json(['post'=>$post,'menus'=>$menus]);
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
        $fill = (new Post)->getFillable();

        $data=array_only($request->all(),$fill);
        $image = Post::find($id);
        if(@$data['image'] != @$image->image){
            $imageDelete=(new ImageMaker)->deleteFile(@$image->image);//delete old image after update data
        }
        $data['image']=(new ImageMaker)->base64ToImage('images\\gallery',$data['image']);
        Post::where('id',$id)
        ->update($data);
        return response()->json([
            'status'=>true,
            'message'=>'Data successfully saved.',
            'req'=>$data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
