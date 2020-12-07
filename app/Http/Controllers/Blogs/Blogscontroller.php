<?php

namespace App\Http\Controllers\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Blog;
use App\Category;
use App\User;
use Auth;
use DB;
use Storage;
use Image;


class Blogscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $status='Success';
        $categories=Category::all();
        $blogs=Blog::all();
        $top = DB::table('blogs')->max('views');
        return view('blogs.index',['blogs'=>$blogs,'categories'=>$categories,'status'=>$status,'top'=>$top]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('blogs.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog=new Blog;
        $status='Success';

        $this->validate($request,[
            'featured_image' =>'sometimes | image',
            'content' =>'required'
        ]);

        $blog->title=$request->title;
        $blog->content=$request->content;
        $blog->user_id=$request->user()->id;
        $blog->category_id=$request->category_id;
        if($request->hasfile('featured_image'))
        {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $blog->image = $filename;
            
        }
        $blog->save();
        $status='Blog created Successfully';
        $blogs=Blog::all();
        return redirect()->route('blog_path',['id'=>$blog->id])->with(['status'=>$status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status='Success';
        $blog=Blog::find($id);
        $blog->views=$blog->views+1;
        $blog->update();
        return view('blogs.show',['blog'=>$blog,'status'=>$status]);  
    }

    /**
     * Edit the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status='Success';
        $blog=Blog::find($id);
        $categories=Category::all();
        $user_id=$blog->user_id;
        if($user_id==Auth::user()->id || Auth::user()->type=='admin')
        {  
            return view('blogs.edit',['blog'=>$blog,'status'=>$status,'categories'=>$categories]);
        }
        else
        {
            $status="You Cannot Edit Blog";
            return redirect()->route('blog_path',['id'=>$blog->id])->with(['blog'=>$blog,'status'=>$status]);
        }
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
        $status="Success";
        $blog=Blog::find($id);

        $this->validate($request,[
            'featured_image' =>'sometimes | image',
            'content' => 'required'
        ]);

    
        $blog->title=$request->title;
        $blog->content=$request->content;
        $user_id=$blog->user_id;
        $blog->category_id=$request->category_id;
        $blog->views=$blog->views-1;
        if($request->hasfile('featured_image'))
        {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldfilename=$blog->image;
            $blog->image = $filename;
            Storage::delete($oldfilename);

        }

        if($user_id==Auth::user()->id || Auth::user()->type=='admin')
        {
            $blog->update();
            $status="Blog Updated Successfully";
        }
        else
        {
            $status="You Cannot Update Blog";
        }
        return redirect()->route('blog_path',['id'=>$blog->id])->with(['blog'=>$blog,'status'=>$status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status='Success';
        $blog=Blog::find($id);
        $user_id=$blog->user_id;
        if($user_id==Auth::user()->id || Auth::user()->type=='admin')
        {
            Storage::delete($blog->image);
            $blog->delete();
            $status='Blog Deleted Successfully';
            $blogs=Blog::all();
            return redirect()->route('blogs_path')->with(['status'=>$status]);
        }
        else
        {
            $status='You Cannot Delete Blog';
            return redirect()->route('blog_path',['id'=>$blog->id])->with(['blog'=>$blog,'status'=>$status]);
        }
    }

    /**
     * Edit the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $status='Success';
        $blog=Blog::find($id);
        $user_id=$blog->user_id;
        if($user_id==Auth::user()->id || Auth::user()->type=='admin')
        {
            return view('blogs.delete',['blog'=>$blog]);
        }
        else
        {
            $status="You Cannot Delete Blog";
            return view('blogs.show',['blog'=>$blog,'status'=>$status]);
        }
    }


    public function categorysearch(Request $request)
    {
        $category=$request->category_id;
        $blogs = DB::table('blogs')->where('category_id','like','%'.$category.'%')->get();
        return view('blogs.search',['blogs'=>$blogs]);  
        
        // return redirect()->route('categories.show',['id'=>$category]);
    }

    public function titlesearch(Request $request)
    {   
        $title = $request->input("title");
        $blogs = DB::table('blogs')->where('title','like','%'.$title.'%')->get();
        // return view('search')->with('users',$users);
        return view('blogs.search',['title'=>$title,'blogs'=>$blogs]);  


        // $status="Success";
        // $title=$request->title;
        // $blogs=Blog::all();
        // return view('blogs.search',['title'=>$title,'blogs'=>$blogs,'status'=>$status]);  
    }

    public function resetviews($id)
    {
        $status='Success';
        $blog=Blog::find($id);
        if(Auth::user()->type=='admin')
        {
            $blog->views=0;
            $blog->update();
            $status="Views Resetted Successfully";
        }
        else
        {
            $blog->views=$blog->views-1;
            $blog->update();
            $status="Only Admins Can Reset Views";
        }
        return redirect()->route('blog_path',['id'=>$blog->id])->with(['blog'=>$blog,'status'=>$status]);
    }

    public function yourprofile($id)
    {
        if(User::find($id))
        {
        $status='Success';
        $categories=Category::all();
        $blogs=Blog::all();
        return view('layouts.profile',['blogs'=>$blogs,'categories'=>$categories,'status'=>$status,'id'=>$id]);
        }
        else
        {
            $status="Account Not Found";
            return redirect()->route('blogs_path')->with(['status'=>$status]);
        }

    }

    public function profileupdate(Request $request,$id)
    {
        if(Auth::user()->id==$id || Auth::user()->type=='admin')
        {
            $user=User::find($id);
            $user->name = $request->name;
            $user->update();
            $status="Account Renamed Successfully";
            return redirect()->route('profile',['id'=>$id])->with(['status'=>$status]);
        }
        else
        {
            $status="You Cannot Rename Account";
            return redirect()->route('profile',['id'=>$id])->with(['status'=>$status]);
        }
    }

    public function profiledelete($id)
    {
        if(Auth::user()->id==$id || Auth::user()->type=='admin')
        {
            $blogs=DB::table('blogs')->where('user_id',$id)->get();
            foreach($blogs as $blog)
            {
                Storage::delete($blog->image);
            }
            DB::table('users')->where('id',$id)->delete();
            return redirect()->route('welcome');
        }
        else
        {
            $status="You Cannot Delete the Account";
            return redirect()->route('profile',['id'=>$id])->with(['status'=>$status]);
        }

    }




}
