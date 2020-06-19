<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Image;
class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
    return view('create',compact('users'));
    }
      public function index2()
    {
        $users=User::all();
    return view('welcome',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function save(Request $request){

        $messages=array(
            'name.required'=>'This field is required',
            'image.required'=>'This field is required',
            'image.image'=>'Please select a image file',
        );
        $rules=array(
            'name'=>'required|string',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        );
        $validator=\Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return Response::json(['success'=>'0','validation'=>'0','message'=>$validator->errors()]);
        }
        else{
            
        if($request->hasFile('image')&& $request->image->isValid())
        {
            $name = $request->image->getClientOriginalName();
            $extension =$request->image->extension();
            $size = $request->image->getSize();
            $filename = $name;
            $request->image->move(public_path('images'),$filename);
        }
         
         $user = User::create([
           'name'=>$request->name,
            'image'=>$filename,
           
       ]);
            if($user){
              return Response::json(['success' => '1','message' => 'User added successfully']);

            }
            else {
              return Response::json(['success' => '0','message' => 'Something is wrong. Please try again.']);

            }
        }
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
        $users=User::find($id);
        return view('update',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request){

      $messages=array(
        'name.required'=>'This field is required',
       
      );
      $rules=array(
        'name'=>'required|string',
       
      );
      $validator=\Validator::make($request->all(),$rules,$messages);
      if($validator->fails()){
        return Response::json(['success'=>'0','validation'=>'0','message'=>$validator->errors()]);
      }
      else{
        if($request->hasFile('image')&& $request->image->isValid())
        {
            $name = $request->image->getClientOriginalName();
            $extension =$request->image->extension();
            $size = $request->image->getSize();
            $filename = $name;
            $request->image->move(public_path('images'),$filename);
             $product = User::find($request->id);
        $product->name = $request->name;
        $product->image = $filename;
        $saved=$product->save();
                if($saved)
            {
               return Response::json(['success' => '1','message' => 'User update successfully']);
             }
            else {
              return Response::json(['success' => '0','message' => 'Something is wrong. Please try again.']);

            }
        
        }
        else
        {
            $request->image=='';
        $category= User::find($request->id);
      $category->name=$request->name;
      $category->save();
               return Response::json(['success' => '1','message' => 'User update successfully']);

        }

        
      }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
    {
       $user =User::find($id);
       if($user->delete())
       {
          unlink(public_path().'/images/'.$user->image);
           //unlink(public_path() . $user->avatar->file);
         //    unlink(public_path().'images/thumb/'.$user->image);
        // Storage::disk('public')->delete($user->image);
         return response()->json([
        'success' => 'Record deleted successfully!'
    ]);
       }
  
    }
}
