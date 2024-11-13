<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    function getProduct($tag) {
        $product=Product::WHERE('tag','=',$tag)->get();
      return response()->json(['data'=>$product], 200);
      
    }


    function show($id) {
        $product=Product::find($id);
if (!$product) {
    return response()->json(["data"=>"Product Not Found"], 404);
}else{
    return response()->json(["data"=>$product], 200);
}

       
    }


    public function store(Request $request){
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
    Product::create([
        'name'=>$request['name'],
        'Description'=>$request['Description'],
        'price'=>$request['price'],
        'tag'=>$request['tag'],
        'category'=>$request['category'],
        'gender'=>$request['gender'],
        'stock'=>$request['stock']
    ]);


    return response()->json(['message'=>"Product Added"], 200);

   } catch (\Exception $e) {
    return response()->json(["message"=>"Something Went Wrong"], 500);
   }
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
    $data=Product::where('category','=',$type)->orderBy('id','DESC')->get();
    return response()->json(['data'=>$data], 200);
   }


   public function relatedPro($cat,$id)  {

    $data=Product::where('category','=','top')->where('id','!=',$id)->orderBy('id','DESC')->limit(5)->get();
    return response()->json(['message'=>$data], 200,);
   }
}
