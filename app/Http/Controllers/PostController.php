<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = post::all();
        $posts = DB::table('posts')->orderby('updated_at','desc')->paginate(5);
        return view("posts/index")->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        //Handle file upload
        if($request->hasFile('cover_image')){
            //get file name with extension
            $fileNameext = $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($fileNameext,PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileName = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileName);
        }
        else{
            $fileName = 'default.jpg';
        }

        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $query = DB::insert('insert into posts (title,body,created_at,updated_at,user_id,cover_image) values(?,?,?,?,?,?)',[
            $request->title,
            $request->body,
            $current_date_time,
            $current_date_time,
            auth()->user()->id,
            $fileName
            ]);
        return redirect('/posts')->with('success','Post Created Successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('posts')->where('id',$id)->get();
        return view("posts/show")->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('posts')->where('id',$id)->get();
        if(auth()->user()->id != $data[0]->user_id){
            return redirect('/posts')->with('error','Unauthorised Activity');
        }
        return view("posts/edit")->with('data',$data);
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);
        if($request->hasFile('cover_image')){
            //get file name with extension
            $fileNameext = $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($fileNameext,PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileName = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileName);
        }
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $query = DB::update('update posts set title = ?,body = ?,updated_at = ? where id = ?',[
            $request->title,
            $request->body,
            $current_date_time,
            $id,
        ]);
        if($request->hasFile('cover_image')){
            $imgquery = DB::update('update posts set cover_image = ? where id = ?',[
                $fileName,
                $id
            ]);
        }
        return redirect('/posts')->with('success','Post updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('posts')->where('id',$id)->get();
        if(auth()->user()->id != $data[0]->user_id){
            return redirect('/posts')->with('error','Unauthorised Activity');
        }
        $query = DB::delete('delete from posts where id = ?',[$id]);
        Storage::delete('storage/public/cover_images/'.$data[0]->cover_image);
        return redirect('/posts')->with('success','Post Deleted Successfully');
    }
}
