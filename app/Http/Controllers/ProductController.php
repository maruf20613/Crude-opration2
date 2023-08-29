<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function index(){
       
        return view('Products.index',['products' => Product::latest()->paginate(5)]);
    }

    public function create(){
        return view('Products.create');
    }

    public function store (Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
       
       
        $product = new product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        
        return back()->withSuccess('Product Created!!!');
    
    }

    public function edit($id){ 
        $product = Product::where('id',$id)->first();
        return view('Products.edit',['product' => $product]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::where('id',$id)->first();

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;

        }
         
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        
        return back()->withSuccess('Product Updated!!!');

    }

    public function delete($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product Deleted!!!');

    }

    public function show($id){
        $product = Product::where('id',$id)->first();

        return view('Products.show',['product'=>$product]);

    }


}
