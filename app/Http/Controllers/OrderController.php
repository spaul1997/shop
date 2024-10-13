<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductStatus;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $title = "Orders List";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $orders = Order::select('orders.*','u.name','u.email')->join('users as u','u.id','=','orders.user_id')->orderBy('orders.id','DESC')->get();
        $data = compact('title','total','orders');
        return view('orders')->with($data);
    }

    public function orders_details($oid){
        $title = "Order Details";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $orders = Order::select('orders.*','u.name as username','u.email','oa.name','oa.phone','oa.addresss','oa.dist','oa.pin','op.trn','op.price','op.mode')
            ->join('order_addresses as oa','oa.order_id','=','orders.id')
            ->join('order_payments as op','op.order_id','=','orders.id')
            ->join('users as u','u.id','=','orders.user_id')
            ->where('orders.oid',$oid)
            ->first();
        $orders->products = OrderProduct::where('order_id',$orders->id)->get();
        $pro = collect($orders->products)->map(function($item){
            $item->status = OrderProductStatus::select('order_product_statuses.os_id','os.status','order_product_statuses.created_at')
                ->join('order_statuses as os','os.id','=','order_product_statuses.os_id')
                ->where('order_product_statuses.op_id',$item->id)
                ->orderBy('order_product_statuses.id','DESC')
                ->get();
        });
        $all_status = OrderStatus::get();
        $data = compact('title','total','orders','all_status');
        // dd($data);
        return view('orders-details')->with($data);
    }

    public function update_status(Request $request){
        $check = OrderProductStatus::where('op_id',$request->input('op_id'))->where('os_id',$request->input('status'))->first();
        if(!$check){
            $data = new OrderProductStatus();
            $data->op_id = $request->input('op_id');
            $data->os_id = $request->input('status');
            $data->save();
            toastr()->success('Successfully Updated', 'Congrats');
        }
        return redirect()->back();
    }

    public function my_orders(){
        $title = "My Orders List";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $orders = Order::select('orders.*','u.name','u.email')->join('users as u','u.id','=','orders.user_id')->where('user_id',session('user')['id'])->orderBy('orders.id','DESC')->get();
        $data = compact('title','total','orders');
        return view('orders')->with($data);
    }

    public function my_orders_details($oid){
        $title = "My Order Details";
        $total['products'] = Product::where('is_delete','0')->count();
        $total['users'] = User::where('role_id','2')->count();
        $total['orders'] = Order::count();
        $orders = Order::select('orders.*','u.name as username','u.email','oa.name','oa.phone','oa.addresss','oa.dist','oa.pin','op.trn','op.price','op.mode')
            ->join('order_addresses as oa','oa.order_id','=','orders.id')
            ->join('order_payments as op','op.order_id','=','orders.id')
            ->join('users as u','u.id','=','orders.user_id')
            ->where('orders.oid',$oid)
            ->where('user_id',session('user')['id'])
            ->first();
        $orders->products = OrderProduct::where('order_id',$orders->id)->get();
        $data = compact('title','total','orders');
        return view('orders-details')->with($data);
    }
}
