<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $title = "Products List";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $products = Product::where('is_delete','0')->orderBy('id','DESC')->get();
        $data = compact('title','total','products');
        return view('dashboard')->with($data);
    }
    public function add_product(){
        $title = "Add New Product";
        $btn = "Add";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $edit = null;
        $data = compact('title','total','edit','btn');
        return view('product-form')->with($data);
    }
    public function edit_product($pid){
        $title = "Edit Product";
        $btn = "Update";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $edit = Product::where('pid',$pid)->where('is_delete','0')->first();
        $data = compact('title','total','edit','btn');
        return view('product-form')->with($data);
    }
    public function delete_product($pid){
        $check = Product::where('pid',$pid)->where('is_delete','0')->first();
        if($check){
            $data = Product::find($check->id);
            $data->is_delete = '1';
            $data->update();
            toastr()->success('Successfully Deleted', 'Congrats');
        }else{
            toastr()->error('Failed! Try again');
        }
        return redirect()->back();
    }
    public function update_product(Request $request, $id = 0){
        $request->validate([
            "name" => 'required',
            "price" => 'required|numeric',
            "quantity" => 'required|numeric',
            "description" => 'required',
        ]);
        if($request->file('image')){
            $path = public_path('assets/website/products');
            $image = "pr-".time().".".$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($path, $image);
        }else{
            $image = trim($request->input('old_image'));
        }
        if($id){
            $message = "Updated";
            $data = Product::find($id);
        }else{
            $message = "Added";
            $data = new Product();
            $data->pid = 'PR'.rand(10000,99999);
        }
        $data->name = $request->input('name');
        $data->image = $image;
        $data->price = $request->input('price');
        $data->quantity = $request->input('quantity');
        $data->description = $request->input('description');
        if($data->save()){
            toastr()->success('Successfully '.$message, 'Congrats');
        }else{
            toastr()->error('Failed! Try again');
        }
        return redirect()->route('dashboard');
    }
}
