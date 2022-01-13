<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::all();
        return Inertia::render('Post' , [ 'posts' => $posts ] );
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
        
        Validator::make($request->all(), [
            'title' => ['required' , 'max:255' ],
            'description' => ['required'],
            'image' => ['required', 'mimes:jpeg,jpg,png', 'max:10000']
        ])->validate();
        
        try {
            DB::beginTransaction();
            $fileName = "u_id_".auth()->id().'_'. time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $fileName);
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => 0,
                'user_id' => auth()->id(),
                'image' => '/'.'upload/'.$fileName
            ]);

            DB::commit();
            return  back()->with('success', 'Images uploaded successfully');

        }
        catch(\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }


    }

    public function makeActive($id){
        $post = Post::find($id);
        $post->status = 1;
        $post->update();
        return back()->withSuccess("Done");
    }
    public function makeInactive($id){
        $post = Post::find($id);
        $post->status = 0;
        $post->update();
        return back()->withSuccess("Done");
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
        //
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
        //
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
        $post = Post::find($id);
        $post->delete();
        return back()->withSuccess("Post Deleted!");
    }
}
