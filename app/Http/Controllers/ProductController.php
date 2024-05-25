<?php 
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller{
    public function create(Request $request){ 
        // $this->validate($request,[
        //     'name' => 'required|string',
        //     'price' => 'required|interger',
        //     'color' => 'required|in:red,blue',
        //     'description' => 'string'
        // ]);
        $data = $request->all();
        $product = Product::create($data);
        return response()->json($product);
    }
    public function index(){
        $product = Product::all();
        return response()->json($product);
    }
    public function show($id){
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update(Request  $request, $id){
        $product = Product::find($id);

        if (!$product){
            return response()->json(['message' => 'Product not found'],404);
            
        }
        $this->validate($request,[
            'name' => 'string',
            'price' => 'interger',
            'color' => 'in:red,blue',
            'description' => 'string'
        ]);
        $data = $request->all();

        $product->fill($data);
        $product->save();
        return response()->json($product);
    }
    public function destroy($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['messege' => 'Product not found'],404);

        }
        $product->delete();
        return response()->json(['messege' => 'Product Deleted!']);
    }
}

