<!doctype html>
<html lang="en">

<head>
    <title>Payment</title>
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
                    Total {{$title}} : ₹ {{Cart::total()}} /-
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
                <form action="{{route('order-now')}}" method="post">
                    @csrf
                    <tr>
                        <th>Name :</th>
                        <td>
                            <input class="form-control" type="text" name="name">
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                        <th>Email :</th>
                        <td>
                            <input class="form-control" type="text" name="email">
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Phone :</th>
                        <td>
                            <input class="form-control" type="text" name="phone">
                            @error('phone')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                        <th>Address :</th>
                        <td>
                            <textarea class="form-control" name="address" rows="3"></textarea>
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>District :</th>
                        <td>
                            <input class="form-control" type="text" name="district">
                            @error('district')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                        <th>Pin :</th>
                        <td>
                            <input class="form-control" type="text" name="pin">
                            @error('pin')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4"><button type="submit" class="btn btn-success">Submit</button></td>
                    </tr>
                </form>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
