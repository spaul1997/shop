<!doctype html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>
    <div class="mode-switcher">
        @isok("product")<a href="{{route('dashboard')}}"><button><i class="fas fa-layer-group"></i> Products</button></a>@endisok
        @isok("order")<a href="{{route('orders')}}"><button><i class="fas fa-folder-open"></i> Orders</button></a>@endisok
        @isok("user-order")<a href="{{route('my-orders')}}"><button><i class="fas fa-folder-open"></i> My Orders</button></a>@endisok
        <a href="{{route('logout')}}"><button><i class="fa-solid fa-right-from-bracket"></i> Logout</button></a>
    </div>

    <div class="container">
        @if (session('user')['id'] == 1)
        <div class="stats">
            <div class="stat-card">
                <div class="stat-value">{{$total['products']}}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{$total['orders']}}</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{$total['users']}}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        @endif
        <div class="dashboard">
            <div class="panel">
                <div class="d-flex justify-content-between">
                    <h4 class="text-left">{{$title}}</h4>
                    <h6>ID : {{$orders->oid}}</h6>
                </div>
                <table id="product-list">

                    <thead>
                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <span><b>Billing Address : </b></span><br>
                                        <div class="px-3">
                                            <span><b>Name : </b>{{$orders->name}}</span><br>
                                            <span><b>Phone : </b>{{$orders->phone}}</span><br>
                                            <span><b>Address : </b>{{$orders->addresss}}</span><br>
                                            <span><b>District : </b>{{$orders->dist}}</span><br>
                                            <span><b>Pin : </b>{{$orders->pin}}</span><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <span><b>Payment Info : </b></span><br>
                                        <div class="px-3">
                                            <span><b>Trx ID : </b>{{$orders->trn}}</span><br>
                                            <span><b>Amount : </b>{{$orders->price}}</span><br>
                                            <span><b>Mode : </b>{{$orders->mode}}</span><br>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Sl. No</th>
                            <th colspan="2">Products</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->products as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img width="50px" height="80px" src="{{asset('assets/website/products').'/'.$item->image}}"></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}} /-</td>
                            <td>
                                @foreach ($item->status as $sts)
                                <span class="badge bg-success">{{$sts->status}} ({{date('Y-m-d h:ia', strtotime($sts->created_at))}})</span><br>
                                @endforeach
                                <br>
                                @if (session('user')['role_id'] == 1)
                                <form action="{{route('update-status')}}" method="post" class="form-inline d-flex">
                                    @csrf
                                    <input type="hidden" name="op_id" value="{{$item->id}}">
                                    <select name="status" class="form-control form-control-sm w-50">
                                        @foreach ($all_status as $all)
                                        <option value="{{$all->id}}" @if($item->status[0]->os_id == $all->id){{'selected'}}@endif>{{$all->status}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Save" class="btn btn-sm btn-primary">
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>
