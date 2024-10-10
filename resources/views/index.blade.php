<!doctype html>
<html lang="en">

<head>
    <title>Product List</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
</head>

<body>
    <div class="container bg-white">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid p-0">
                <a class="navbar-brand text-uppercase fw-800" href="#">
                    <span class="border-red pe-2">New</span>Product
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav"
                    aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> <span
                        class="fas fa-bars"></span> </button>
                <div class="collapse navbar-collapse" id="myNav">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                        <a class="nav-link" href="{{route('checkout')}}">Checkout</a>
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row">
            @foreach ($products as $item)
            <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3">
                <div class="product">
                    <img src="{{asset('assets/website/products')}}/{{$item->image}}" alt="{{$item->pid}}">
                    <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                        <li class="icon mx-3" onclick="add_to_cart('{{$item->pid}}')"><i class="fas fa-cart-plus"></i></li>
                    </ul>
                </div>
                <div class="title pt-4 pb-1"><b>{{$item->name}}</b></div>
                <div class="d-flex align-content-center justify-content-center">
                    <small style="text-align: justify;">{{$item->description}}</small>
                </div>
                <div class="price">₹ {{$item->price}}</div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function add_to_cart(pid){
            $.ajax({
                type: "GET",
                url: "{{route('add-to-cart')}}/".pid,
                success: function(result){
                    if(result){
                        toastr.success("Added to Cart");
                    }else{
                        toastr.error("Failed! Try again");
                    }
                }
            });
        }
    </script>

</body>

</html>
