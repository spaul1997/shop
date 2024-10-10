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
        @isok("product")<button><i class="fas fa-layer-group"></i> Products</button>@endisok
        @isok("order")<button><i class="fas fa-folder-open"></i> Orders</button>@endisok
        @isok("role-and-permission")<button><i class="fas fa-user-lock"></i> Role & Permission</button>@endisok
        @isok("user-order")<button><i class="fas fa-folder-open"></i> My Orders</button>@endisok
        <a href="{{route('logout')}}"><button><i class="fa-solid fa-right-from-bracket"></i> Logout</button></a>
    </div>

    <div class="container">
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
        <div class="dashboard">
            <div class="panel">
                <div class="d-flex justify-content-between">
                    <h4 class="text-left">Latest Products</h4>
                    <a href="{{route('add-product')}}" class="btn btn-sm btn-success text-right">Add Product</a>
                </div>
                <table id="product-list">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th colspan="2">Product</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$item->pid}}</td>
                            <td><img width="50px" height="80px" src="{{asset('assets/website/products').'/'.$item->image}}" alt="{{$item->pid}}"></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                <a href="{{route('edit-product', $item->pid)}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="{{route('delete-product', $item->pid)}}" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
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
