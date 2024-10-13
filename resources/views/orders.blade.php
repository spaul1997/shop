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
                    <h4 class="text-left">Latest Orders</h4>
                </div>
                <table id="product-list">
                    <thead>
                        <tr>
                            <th>Orders ID</th>
                            <th>User Info</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>{{$item->oid}}</td>
                            <td>
                                <span>Name : {{$item->name}}</span><br>
                                <span>Email : {{$item->email}}</span><br>
                            </td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->total}} /-</td>
                            <td>
                                <a href="{{route('orders-details', $item->oid)}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
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
