<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Blog;
use Auth;
use DB;
use Storage;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=1;
        $status="Success";
        $categories=Category::all()->sortBy('name');
        return view('categories.index',['categories'=>$categories,'status'=>$status,'count'=>$count]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status='Success';
        $category= new Category;
        $categories=Category::all();
        if(Auth::user()->type=='admin')
        {  
            if(count(array_filter(array(DB::table('categories')->where('name',strtoupper($request->name))->value('id'))))==0)
            {
            $category->name=strtoupper($request->name);
            $category->save();
            $status="Category Added Successfully";
            return redirect()->route('categories.index')->with(['status'=>$status]);
            }
            else
            {
                $status="Category Already Exists";
                return redirect()->route('categories.index')->with(['status'=>$status]);
            }
        }
        else
        {
                $status="You Cannot Make a New Category";
                return redirect()->route('categories.index')->with(['status'=>$status]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function getid(Request $request)
    {
        $id=$request->category_id;
        return redirect()->route('categories.search',['id'=>$id]);
    }

    public function categorysearch($id)
    {
        $status='Success';
        $categories=Category::all();
        $category=Category::find($id);
        $blogs=Blog::all();
        return view('categories.show',['blogs'=>$blogs,'category'=>$category,'categories'=>$categories,'status'=>$status]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function update(Request $request, $id)
    {
        $status='Success';
        $categories=Category::all();
        $category=Category::find($id);
        if(Auth::user()->type=='admin')
        {
            if(count(array_filter(array(DB::table('categories')->where('name',strtoupper($request->name))->value('id'))))==0)
            {
                $category->name=strtoupper($request->name);
                $category->update();
                $status="Category Updated Successfully";
            }
            else
            {
                $status="Category Already Exists";
            }
        }
        else
        {
            $status="You Cannot Rename the Category";
        }
        return redirect()->route('categories.index')->with(['status'=>$status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $status="Success";
        $categories=Category::all();
        $category=Category::find($id);
        $blogs=Blog::all();
        if(Auth::user()->type=='admin')
        {
            foreach ($blogs as $blog)
            {
                if($blog->category_id==$category->id)
                {
                    $blog->category_id=NULL;
                    $blog->save();
                }
            }
            $category->delete();
            $status="Category Deleted Successfully";
        }
        else
        {
            $status="You Cannot Delete the Category";
        }
        return redirect()->route('categories.index')->with(['status'=>$status]);
    }
}
