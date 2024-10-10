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
                <h4 class="text-center">{{$title}}</h4>
                <form action="{{route('update-product',@$edit->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Product Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="@if($edit){{$edit->name}}@else{{old('name')}}@endif">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Product Image <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="image" @if(!$edit){{'required'}}@endif>
                        <input type="hidden" name="old_image" value="@if($edit){{$edit->image}}@endif">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Price <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="price" value="@if($edit){{$edit->price}}@else{{old('price')}}@endif">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Quantity <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="quantity" value="@if($edit){{$edit->quantity}}@else{{old('quantity')}}@endif">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description">@if($edit){{$edit->description}}@else{{old('description')}}@endif</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{$btn}}</button>
                        <a href="{{route('dashboard')}}" class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>
