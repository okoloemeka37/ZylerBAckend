<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\notification;
use App\Models\PasswordReset;
use App\Mail\PassResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
function uploadToGitHub($file)
{
    $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
    $fileContent = base64_encode(file_get_contents($file->getRealPath()));

    $response = Http::withToken(env('GITHUB_TOKEN'))
        ->put("https://api.github.com/repos/" . env('GITHUB_REPO') . "/contents/" . env('GITHUB_FOLDER') . "/$fileName", [
            'message' => "Add $fileName",
            'content' => $fileContent,
            'branch' =>'main',
        ]);

    if ($response->successful()) {
        return $fileName; // Return the file URL
    } else {
        throw new \Exception("Failed to upload file: " . $response->body());
    }
}

class Login extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $user->load('orders');
            $user->load('carts');
            $token = $user->createToken('zyler')->plainTextToken;

            return response()->json(['token' => $token,'user'=>$user]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


  public function register(Request $request)  {
    $request->validate([
        'name'=>'required|min:5',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:8|confirmed',
        'address'=>'required',
        'phone'=>'required|integer'
    ]);

    try {
    User::create([
        'name'=>$request['name'],
        'email'=>$request['email'],
        'password'=>Hash::make($request['password']),
        'status'=>'user',
        'address'=>$request['address'],
        'phone'=>$request['phone'],
        'image'=>'05785d1e-eefc-47ed-9c3a-d6d3f127c4bd.jfif'
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('zyler')->plainTextToken;

//add to notice;

notification::create([
    'type_id'=>$user->id,
    'notice'=>"A new User registered",
    'type'=>'User',
    'view'=>'no'
  ]);

        return response()->json(['token' => $token,'user'=>$user]);
    }


    } catch (e) {
  return response()->json(['message'=>e], 200, $headers);
    }


    }

    public function Edit($id)  {
        $check=User::find($id);
        return response()->json($check, 200);
    }

    public function Update(Request $request, $id) {
     
        
     $request->validate([
            'name'=>'required|min:5',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required|min:1|max:11',
            'image'=>'required'
        ]);
        
        $check=User::find($id);
      
       
        $rt='';
        if (is_string($request['image'])) {
            $rt=$request['image'];
        }else{
             $file= $request->file('image');
            $rt=uploadToGitHub($request->file('image'));
        }
       
           
       
        
            $check->update([
                'name'=>$request['name'],
                'email'=>$request['email'],
                'address'=>$request['address'],
                'phone'=>$request['phone'],
                'image'=>$rt
            ]);
            $user=User::find($id);
return response()->json(['message'=>"Profile Updated Successfully",'user'=>$user], 200); 
        
    }

    public function CP(Request $request, $id){
        if (!Auth::user()) {
            $request->validate([
                
                'password'=>'required|min:8'
            ]);
            $check=User::where('email','=',$id)->first();
            $check->update([
             'password'=>Hash::make($request['password']),
            
         ]);
     return response()->json(['message'=>'Password Changed Successfully',], 200);
        }else{
        $request->validate([
            'oldPassword'=>'required|min:8',
            'password'=>'required|min:8|confirmed'
        ]);
        $pas=Hash::check($request['oldPassword'],Auth::user()->password);
       if ($pas) {
       $check=User::find(Auth::user()->id);
       $check->update([
        'password'=>Hash::make($request['password']),
       
    ]);
return response()->json(['message'=>'Password Changed Successfully',], 200);
       } else{
        return response()->json(['message'=>'The Old Password is Wrong'], 404);   
    }
        }
      

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out from all devices'], 200);
    }


    public function passReset(Request $request) {
        $request->validate([
            'email'=>'required|email'
        ]);
        
        if (PasswordReset::where('email',$request->email)->exists()) {
            PasswordReset::where('email',$request->email)->delete();
        }
       
     $code =random_int(100000,999999);
        $pit=PasswordReset::create([
            'email'=>$request->email,
            'token'=>$code
        ]);
        $data=['token'=>$code];
        Mail::to('okoloemeka47@gmail.com')->send(new PassResetMail($data));
        return response()->json(['message'=>"Reset Email Sent "], 200); 
    }

    public function TokenConfirm(Request $request)  {
        $request->validate([
            'code'=>'required'
        ]);
        $rt=PasswordReset::where('token',$request->code)->first();
        if ($rt) {
       
            PasswordReset::where('token',$request->code)->delete();
          
          return response()->json(['data'=>$rt['email']], 200);
        }
        
    }
    
}
