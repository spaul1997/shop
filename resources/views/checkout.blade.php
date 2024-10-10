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
                    {{$title}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav"
                    aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> <span
                        class="fas fa-bars"></span> </button>
                <div class="collapse navbar-collapse" id="myNav">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                        <a class="nav-link active" aria-current="page" href="{{route('checkout')}}">Checkout</a>
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row px-3">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50%">Product</th>
                        <th style="width: 25%">Qty</th>
                        <th style="width: 25%">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $row)
                        <tr>
                            <td><strong>{{$row->name}}</strong></td>
                            <td>{{$row->qty}}</td>
                            <td>₹ {{$row->price}} /-</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>₹ {{Cart::total()}} /- <a class="btn btn-sm btn-success" href="{{route('payment')}}">Pay Now</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
