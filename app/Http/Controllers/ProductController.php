<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

function uploadToGitHub($file)
{
    $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
   
    $fileContent = base64_encode(file_get_contents($file->getRealPath()));
    

    $response = Http::withToken(env('GITHUB_TOKEN'))
        ->put("https://api.github.com/repos/" . env('GITHUB_REPO') . "/contents/" .env('GITHUB_FOLDER') . "/$fileName", [
            'message' => "Add $fileName",
            'content' => $fileContent,
            'branch' => 'main',
        ]);

    if ($response->successful()) {
        return $fileName; // Return the file URL
    } else {
        throw new \Exception("Failed to upload file: " . $response->body());
    }
}

class ProductController extends Controller
{

    public function getSum() {
        $product=Product::orderBy('id','desc')->limit(1)->get('id');
        $order=Order::orderBy('order_id','desc')->limit(1)->get('order_id');
        $user=User::orderBy('id','desc')->limit(1)->get('id');

        return response()->json([$product,$order,$user], 200);
    }


    function getProduct($tag) {
        $product=Product::WHERE('tag','=',$tag)->get();
      return response()->json(['data'=>$product], 200);
      
    }
    function getTagPro($tag) {
        $product=Product::WHERE('tag','=',$tag)->get();
      return response()->json(['data'=>$product], 200);
      
    }

   
    function getIndex() {
        $product=Product::orderBy("id",'desc')->limit(20)->get();
      return response()->json(['data'=>$product], 200);
      
    }


    function show($id) {
        $product=Product::where('id','=',$id)->with('cart')->get();
if (!$product) {
    return response()->json(["data"=>"Product Not Found"], 404);
}else{
    return response()->json(["data"=>$product], 200);
}

       
    }

    public function store(Request $request){
     $request->validate([
           /*  'name'=>"required",
            'Description'=>'required',
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'category'=>'required|string',
            'gender'=>'required|string',
            'tag'=>'required|string',
            'stock'=>'required|numeric', */
            'images.*'=>'required'
        ]);
 
    
    $url=[];
            foreach ($request->file('images') as $file) {
       $rt=uploadToGitHub($file);
          array_push($url,$file); // Return the file URL     
       }

       return response()->json(['message'=>"Product Added",'uploadfiles'=>$url], 500);


   $implUrl=implode(',',$url);
       Product::create([
        'name'=>$request['name'],
        'Description'=>$request['Description'],
        'price'=>$request['price'],
        'tag'=>$request['tag'],
        'category'=>$request['category'],
        'gender'=>$request['gender'],
        'stock'=>$request['stock'],
        'image'=>$implUrl
    ]); 

   
    }




    function update(Request $request, $id) {
        $request->validate([
            'name'=>"required",
            'Description'=>'required',
            'price'=>"required|numeric",
            'category'=>'required|string',
            'gender'=>'required|string',
            'tag'=>'required|string',
            'stock'=>'required|numeric'
        ]);
        try {
         $product=Product::find($id);


         $product->update([
            'name'=>$request['name'],
            'Description'=>$request['Description'],
            'price'=>$request['price'],
            'tag'=>$request['tag'],
            'category'=>$request['category'],
            'gender'=>$request['gender'],
            'stock'=>$request['stock']
         ]);

        return response()->json(['message'=>"Product Updated Successfully"], 200);

        } catch (\Exception $e) {
       return response()->json(["message"=>"Something Went Wrong"], 500);
        }
    }



    function destroy($id){
        $item = Product::find($id);
        $item->delete();
        return response()->json(["message"=>"Product Deleted Succesfully"], 200);
    }



    //selections by category

    function setCat($type)  {
        $red=Product::selectRaw('SUM(stock) as stockCount, tag')->groupBy('tag')->where('category','=',$type)->orderBy('tag')->get();

return response()->json(['data'=>$red], 200);
          
      }


   public function indexGet($type)  {
    $data=Product::where('category','=',$type)->orderBy('id','DESC')->limit(5)->get();
    return response()->json(['data'=>$data], 200);
   }


   public function relatedPro($cat,$id)  {

    $data=Product::where('category','=','top')->where('id','!=',$id)->orderBy('id','DESC')->limit(5)->get();
    return response()->json(['data'=>$data], 200,);
   }

  
   //get states;

 public  function getState()  {
    
    $data=State::get();
    return response()->json($data, 200);
   }

   public function lifeSearch(Request $request)  {
    $search=Product::where('name','like','%'.$request['search'].'%')
                    ->orWhere('description','like','%'.$request['search'].'%')
                    ->orWhere('tag','like','%'.$request['search'].'%')->orderBy('id','desc')->get();
return response()->json($search, 200);
   }
   
}
