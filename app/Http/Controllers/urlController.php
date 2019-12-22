<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class urlController extends Controller
{



    public function index($code = null){
        

        if ($code != null) {
      
        }else{
            return view('urls.index');

        }
   
        
       
    
    }


    public function editurl(Request $request){
        

        if (Auth::check()) {


            $id = Auth::id();


            if ($request->isMethod('post')){
                $link=Link::where('user_id',$id)->where('gen_code',$request->code);

                
                


               
                if ($link) {
                
                 
                    $validatedData =  Validator::make($request->all(), [
                        'name'=>'required|min:5|string',
                        'or_link' => 'required|url',
                
                    ]);
                    
                    if ($validatedData->fails()) {
                        $error=$validatedData->errors();
                         return response()->json(compact('error'));
                        
                    }else{

                        $data=[
                            'name'=>$request->name,
                            'or_link'=>$request->or_link
                        ]
                        ;

                        $link->update($data);
                        $success ="Yop! it's done...";
                        return response()->json(compact('success'));

                    }
                }else{
                    $error ='This is not yours or never existed...';
                    return response()->json(compact('error'));
                }


            }else{
                $urls= Link::orderBy('id', 'desc')->where('user_id',$id)->where('id',$request->code)->get();
           
        
                if ($urls->count() > 0) {
                    return response()->json(compact('urls'));
                }else{
                    $error ='This is not yours or never existed...';
                    return response()->json(compact('error'));
                }
            }


        
         
        
        
        }else{
            $error ='You must be connected';
            return response()->json(compact('error'));
        }

    }

  


    public function getallurl(){
        
        if (Auth::check()) {
            $id = Auth::id();
        
            $urls= Link::orderBy('id', 'desc')->where('user_id',$id)->get();
           
        
            if ($urls->count() > 0) {
                return response()->json(compact('urls'));
            }else{
                $error ='Nothing Yet...';
                return response()->json(compact('error'));
            }
        
        
        }else{
            $error ='You must be connected';
            return response()->json(compact('error'));
        }
        
    }

    public function storeit(Request $request){

        if (Auth::check()) {
            $id = Auth::id();
        $validatedData =  Validator::make($request->all(), [
            'name'=>'required|min:5|string',
            'or_link' => 'required|url',
    
        ]);

    
        
                if ($validatedData->fails()) {
                    $error=$validatedData->errors();
                    return response()->json(compact('error'));
                    
                }else{

                    $code =Str::random(40).strftime("%Y", time());


                    $link = new Link();
                    $link->name = $request->name;
                    $link->or_link=$request->or_link;
                    $link->user_id= $id ;
                    $link->gen_code=substr($code,0,6);
                    $link->save();

                    //Not how small it is, how the you use it
                    $success ='Yeey! You created something smaller';
                    return response()->json(compact('success'));
                    


                }

    }else{
        $error ='You must be connected';
        return response()->json(compact('error'));
    }
        


      
    }

    function delete(Request $request){
        if (Auth::check()) {
            $id = Auth::id();
            $link=Link::where('user_id',$id)->where('id',$request->code)->delete();
            if(!$link){
                $error ='This is not yours or never existed...';
                return response()->json(compact('error'));
            }

        }else{
            $error ='You must be connected';
            return response()->json(compact('error'));
        }

    }


    public function redirecturl(Request $request)
    {
        $code =$request->code;
        $link=Link::where('gen_code',$request->code)->first();

        if($link){
            return redirect($link->or_link);
        }else{
            return redirect(route('sendit'));
        }

        
    }
}
