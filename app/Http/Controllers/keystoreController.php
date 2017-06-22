<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class keystoreController extends Controller
{

	public function getKeystores()
	{
		$keystores = \App\Keystore::paginate(10);
		//return view('keystore.manageKeystore');
		//dd($keystores->toArray());
		return view('keystore.manageKeystore',compact('keystores'));
	}

    public function getupgrade($id)
    {
       $keystore = \App\Keystore::where('id','=',$id)->first();
       return view('keystore.upgrade',compact('keystore'));

    }
    public function getKeystoreToUpdate()
    {
        $keystore = Auth::user()->keystore;

        return view('keystore.updateKeystore',compact('keystore'));
    }
    public function setupgrade(Request $request ,$id)
    {
        //dd($request->toArray());
        
        $this->validate($request,['activeState' => 'required',
            'sDate' => 'required|date|before:eDate',
            'eDate' => 'required|date',
            ]);

        $sdate = str_replace("-", "", $request->input('sDate'));
        $edate = str_replace("-", "", $request->input('eDate'));
        $sDate = \Carbon\Carbon::parse($sdate)->format('Y-m-d');
        $eDate = \Carbon\Carbon::parse($edate)->format('Y-m-d');
        $keystore =\App\Keystore::where('id','=',$id)->first();
        $keystore->update(['activeStatues'=>$request->input('activeState'),'begin_day'=>$sDate,'end_day'=>$eDate]);
        return view('keystore.upgrade',compact('keystore'));

    }


    public function setupdate($id, Request $request)
    {
        $image_ids = $request->input('images_id');
        $keystore=\App\Keystore::where('id','=',$id)->first();
        $this->validate($request,['logo'=>'image|mimes:jpeg,jpg,png',
            'images.*'=>'image|mimes:jpeg,jpg,png',
            'imag.*'=>'image|mimes:jpeg,jpg,png',
            ]);
        $path1="";
        if(Input::hasFile('logo'))
        {
            $fileIm = Input::file('logo');
            $destPath = 'public/images/'.$keystore->user->mobile;
            $imageName = $fileIm->getClientOriginalName();
            $imExten = $fileIm->getClientOriginalExtension();
            $fileIm->move($destPath, $imageName);
            $path1 = $imageName;
            $keystore->update(['logo'=>$path1]);
        }
        
        $files = Input::file('image');
        if($files[0] !='')
        {
            foreach($files as $file)
            {
                //dd($file = Input::file($filealName));
                $destPath = 'public/images/'.$keystore->user->mobile.'/uploads';
                $imageName = $file->getClientOriginalName();
                $file->move($destPath, $imageName);
                \App\Image::create(['image_name'=>$imageName,'keystore_id'=>$id]);
            }
        }
        if($request->exists('images')!=null){
        $filImages=Input::file('images');
            foreach ($filImages as $key => $file) {
                if($file != null)
                {
                     $destPath = 'public/images/'.$keystore->user->mobile.'/uploads';
                     $imageName = $file->getClientOriginalName();
                     $file->move($destPath, $imageName);
                      \App\Image::where('id','=',$image_ids[$key])->update(['image_name'=>$imageName,'keystore_id'=>$id]);
              }
          }
      }
        

         return view('/home');
        
    }





	public function getKeystoreDetails()
	{
		$id = $_POST['id'];
		$keystore = \App\Keystore::where('id','=',$id)->with('user')->get();
		//dd($keystore->toArray());
		return json_encode($keystore);

	}

    public function storeKeystore(Request $request)
    {
        //dd($request->toArray());
    	$this->validate($request,['mobile' => 'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
            'shop_en_name' => 'required|',
            'shop_ar_name' =>'required',
            'address'=>'required',
            'typeOfService'=>'required',
            'n_w_hours'=>'required',
            'activeStatues'=>'required',
            'sDate' => 'required|date|before:eDate',
            'eDate' => 'required|date',
            'logo'=>'image|mimes:jpeg,jpg,png',
            ]);
    	$mobile = $request->input('mobile');
    	
        $path1="";
        if(Input::hasFile('logo'))
        {
            $fileIm = Input::file('logo');
            $destPath = 'public/images/'.$mobile;
            $imageName = $fileIm->getClientOriginalName();
            $imExten = $fileIm->getClientOriginalExtension();
            $fileIm->move($destPath, $imageName);
            $path1 = $imageName;
        }

        $user =  \App\User::create([
            'mobile' => $mobile,
            'password' => bcrypt($request->input('password')),
            'role' => '2',
        ]);
        $user_id = $user->id;
        $sdate = str_replace("-", "", $request->input('sDate'));
        $edate = str_replace("-", "", $request->input('eDate'));
        $sDate = \Carbon\Carbon::parse($sdate)->format('Y-m-d');
        $eDate = \Carbon\Carbon::parse($edate)->format('Y-m-d');
        \App\Keystore::create([
            'shop_en_name'=>$request->input('shop_en_name'),
            'shop_ar_name'=>$request->input('shop_ar_name'),
            'address'=>$request->input('address'),
            'typeOfService'=>$request->input('typeOfService'),
            'n_w_hours'=>$request->input('n_w_hours'),
            'activeStatues'=>$request->input('activeStatues'),
            'begin_day'=>$sDate,
            'end_day'=>$eDate,
            'logo'=>$path1,
            'user_id'=> $user_id,
            ]);
    
        return  redirect('/')  ;
    
    }

    public function getShops()
    {
    	$keystore = \App\Keystore::with('user')->with('images')->get();
    	if($keystore != null)
    	{
			$res = ['res'=>'true','info'=>$keystore];	
		}
		else
		{
			$res =['res'=>'flase'];
		}
    	return json_encode($res);
    }
    public function getKeystore()
    {
    	
       	$id = $_POST['id'];
       	$keystore = \App\Keystore::find($id);
       	if($keystore != null)
    	{
	    	$keystore = \App\Keystore::where('id','=',$id)->with('user')->with('images')->with('review')->get();
	    	$keystore->makeHidden(['created_at','updated_at']);
	    	$res = ['res'=>'true','info'=>$keystore];
    	}
    	else
    	{
			$res =['res'=>'flase'];
    	}
    	return json_encode($res);
    }
    public function register()
    {
    	
       	if(isset($_POST['mobile']) == false){
            $res =['res'=>'flase'];
            return json_encode($res);

        }
        else
        {
            $mobile = $_POST['mobile'];   
        }
       	$password = bcrypt($_POST['password']);
       	$user = \App\User::where('mobile','=',$mobile)->first();
       	if($user != null)
    	{
			$res =['res'=>'flase'];				
		}
		else
		{
			$user = \App\User::create(['mobile'=>$mobile,'password'=>$password,'role'=>1]);
            $user->makeHidden(['created_at','updated_at'])->toArray();
			$res = ['res'=>'true','info'=>$user];
		}
        
    	return json_encode($res);

    }

    public function userLogin()
    {
        if(isset($_POST['mobile']) == false){
            $res =['res'=>'flase'];
            return json_encode($res);

        }
        else
            $mobile = $_POST['mobile'];
        if(isset($_POST['password']) == false){
            $res =['res'=>'flase'];
            return json_encode($res);
        }
    	else
        	$password = $_POST['password'];

    	$user = \App\User::where('mobile','=',$mobile)->first();
    	if($user != null)
    	{           

            if($user->keystore != null)
            {
        		if (Hash::check($password,$user->password ))
    			{
                    $user1 = \App\User::where('mobile','=',$mobile)->first();
                    $user1->makeHidden(['created_at','updated_at'])->toArray();
    			   $res = ['res'=>'true','info'=>$user1,'statues'=>$user->keystore->activeStatues];
    			}
    			else
    			{
    				$res =['res'=>'flase'];
    			}

            }
            else
            {
                $user = \App\User::where('mobile','=',$mobile)->first();
                $user->makeHidden(['created_at','updated_at'])->toArray();
                $res = ['res'=>'true','info'=>$user];
            }
		}
		else
		{
			$res =['res'=>'flase'];				
		}
    	return json_encode($res);

    }

    public function setRate()
    {
    	$keystore_id = $_POST['key_id'];
    	$user_id = $_POST['user_id'];
    	$rate = $_POST['rate'];
    	$review = $_POST['review'];

    	$revi = \App\Review::where('user_id','=',$user_id)->where('keystore_id','=',$keystore_id)->first();
    	if($revi != null)
    	{
			$res =['res'=>'flase'];				
		}
		else
		{
			$revi = \App\Review::create(['review'=>$review,'rate'=>$rate,'user_id'=>$user_id,'keystore_id'=>$keystore_id]);
			$res = ['res'=>'true','info'=>$revi];
		}
    	return json_encode($res);
    }

     public function getStatues()
    {
        
        $id = $_POST['id'];
        $keystore = \App\Keystore::find($id);
        if($keystore != null)
        {
            $keystore = \App\Keystore::where('id','=',$id)->get();
            $keystore->makeHidden(['shop_ar_name','shop_en_name','lat','lng','address','n_w_hours','typeOfService','begin_day','end_day','logo']);
            $res = ['res'=>'true','info'=>$keystore];
        }
        else
        {
            $res =['res'=>'flase'];
        }
        return json_encode($res);
    

    }

}
