<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderPayment;
use App\Models\OrderProduct;
use App\Models\OrderProductStatus;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index(){
        $title = 'New Products';
        $products = Product::where('is_delete','0')->orderBy('id','DESC')->get();
        return view('index')->with(compact('products','title'));
    }
    public function checkout(){
        $title = 'Checkout';
        $cart = Cart::content();
        return view('checkout')->with(compact('title','cart'));
    }
    public function payment(){
        $title = 'Payment';
        return view('payment')->with(compact('title'));
    }
    public function order_now(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
            'district' => 'required',
            'pin' => 'required|numeric|digits:6',
        ]);
        $check = User::where('email',$request->input('email'))->first();
        if($check){
            $user_id = $check->id;
        }else{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt('123456');
            $user->role_id = 2;
            $user->save();

            $user_id = $user->id;
        }
        $order = new Order();
        $order->user_id = $user_id;
        $order->oid = 'OD'.rand(10000,99999);
        $order->total = Cart::total();
        $order->quantity = Cart::count();
        if($order->save()){
            $address = new OrderAddress();
            $address->order_id = $order->id;
            $address->name = $request->input('name');
            $address->phone = $request->input('phone');
            $address->addresss = $request->input('address');
            $address->dist = $request->input('district');
            $address->pin = $request->input('pin');
            $address->save();

            $pay = new OrderPayment();
            $pay->order_id = $order->id;
            $pay->trn = uniqid();
            $pay->price = Cart::total();
            $pay->mode = 'ONLINE';
            $pay->save();

            foreach(Cart::content() as $row){
                $product = new OrderProduct();
                $product->order_id = $order->id;
                $product->product_id = Product::where('pid',$row->id)->first()->id;
                $product->name = $row->name;
                $product->image = $row->options->image;
                $product->price = $row->price;
                $product->quantity = $row->qty;
                $product->save();

                $status = new OrderProductStatus();
                $status->op_id = $product->id;
                $status->os_id = 1;
                $status->save();
            }
            Cart::destroy();
            toastr()->success('Successfully Placed Order', 'Congrats');
            return redirect()->Route('home');
        }else{
            toastr()->error('Failed! try again.');
            return redirect()->back();
        }


    }
    public function add_to_cart(Request $request){
        $pid = $request->input('pid');
        $product = Product::where('pid',$pid)->first();
        $check = Cart::content()->firstWhere('id', $pid);
        if($check){
            $currentQuantity = $check->qty;
            Cart::update($check->rowId, $currentQuantity + 1);
        }else{
            Cart::add([
                'id' => $product->pid,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => [
                    'image' => $product->image,
                ]
            ]);
        }
        return true;
    }
    public function remove_cart($pid){
        $check = Cart::content()->firstWhere('id', $pid);
        if($check){
            Cart::remove($check->rowId);
            toastr()->success('Successfully Remove Item', 'Congrats');
        }else{
            toastr()->error('Failed! Try again');
        }
        return redirect()->back();
    }
}
