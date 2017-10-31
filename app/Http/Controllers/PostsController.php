<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Post;
use DB;
use Auth;

class PostsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {  
        
       // $posts= Post::all();
       // $posts= Post::orderBy('title','desc')->get();
       // $posts= Post::where'title','Post 2')->get();   // LO traigo por titulo
       // $posts= Post::orderBy('title','asc')->take(2)->get();  // Muesto el ultimo al principio
        $posts= Post::orderBy('created_at','desc')->paginate(4);
       // $posts = DB::select('SELECT * FROM posts');  // Necesito USE DB;
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
       // Manejar subidas
       
       if($request->hasFile('cover_image')){
            //Get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get filename (no ext)
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //get extension (no filename)
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
       } else {
           $fileNameToStore = 'noimage.jpg';
       }

        //crear Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  return (Post::find($id));
         $post = Post::find($id);
         return view('posts.show')->with('post',$post);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Sin autorizacion para esta pagina');
        }    


        return view('posts.edit')->with('post',$post);
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
            'title' => 'required',
            'body' => 'required'
        ]);
         // Manejar subidas
       
        if($request->hasFile('cover_image')){
        //Get file name with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get filename (no ext)
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get extension (no filename)
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
   } 

        //crear Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');                            
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Editado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)


    {
        $post = Post::find($id);
        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Sin autorizacion para esta pagina');
        }   
        if($post->cover_image != 'noimage.jpg'){
           // Delete IMage
           Storage::delete('public/cover_images/'.$post->cover_image);
            
        }    
        $post->delete();

        return redirect('/posts')->with('success', 'Post Eliminado');
    }
}
