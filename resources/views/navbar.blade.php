<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Eflyer</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('assets/images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <style>
    .main-container {
        display: flex;
        /* position: fixed; */
        /* background-color:yellow; */
            top: 0;
           margin-left: 13%;
            width: 100%;
    
   
            z-index: 1000;
    }

    .inner-container {
        display: flex;
        /* Use flexbox for the inner container */
        width: 100%;
    margin-top:10px;
    }

    .inner-box {
        display: flex;
        width: 100%;



        /* Use flexbox for the inner box */
        /* Optional padding for better appearance */
    }

    .input-container2 {
        display: flex;
        /* Use flexbox for the form container */
        width: 100%;
        /* Take full width */

    }

    .input-container1 {
        display: flex;
        width: 100%;
        /* Take full width */

        margin: 23px;
        /* Space between items */
        /* Take full width */
    }

    .input-container1 form {
        display: flex;
        /* Use flexbox for the form */


    }

    .input-container1 input {
        width: 140%;
        padding-right: 172px;
    }

    .input-container1 input,
    /* .input-container1 select, */
    .input-container1 button {

        margin-top: 2px;
        height: 35px;
        /* Reset margin */
        /* Grow to take remaining space */
    }





    .input-container2 ul {
        display: flex;
        margin-left: 50px;

        padding: 0;
        /* Remove default padding */
        margin: 10px;
        /* Remove default margin */
        list-style-type: none;
        /* Remove default list styling */
    }
    .input-container2 li a {
        color:black;
    }
    .input-container2 li a:hover {
    color: #f26522;
}
    .input-container2 li  {

        /* Optional background color for list items */
        padding: 10px;
        /* Optional padding inside list items */
        /* Optional border for list items */
        display: flex;
        margin: 10px;

        /* font-weight: bold; */

        /* Use flexbox for list items */
    }
    </style>
    </head>

    <body>
        <div class="main-container">
            <div class="inner-container">
                <div class="inner-box">
                    <div class="input-container1">
                        <form id="search-form" action="{{ route('search') }}" method="GET" class="search">
                            <div class="input-container2" style="margin-right:73px;">
                                <select class="form-control" id="category" name="category_id">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categories }}</option>
                                    @endforeach
                                </select>
                         
                            </div>
                      
                        <form id="search-form" action="{{ route('search') }}" method="GET" class="search">
                                @csrf
                                <input type="text" name="search" id="search-input" class="form-cont"
                                    placeholder="Search for product title">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"
                                        style="background-color: #f26522; border-color:#f26522 ">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="input-container2">
                        <ul>
                            <!-- @auth
                            @else
                            <li>
                                <a href="{{ route('register') }}">
                                    <i class="fa fa-user-plus"></i> Register
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-user"></i>


                                    login

                                </a>
                            </li>
                            @endauth-->

                            <li>
                                <a href="{{ route('cart.index') }}">
                                    <i class="fa fa-shopping-cart fa-1x"></i> Cart
                                </a>
                            </li> 
                            <li>
                                <a href="{{ route('orders.index') }}">
                                    <i class="fa fa-truck"></i>

                                     Orders
                                </a>
                            </li>
                            <!-- <li> <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a></li> -->
                            <li>
                                <a href="{{ route('products.filter') }}">
                         
                                <i class="fa fa-shopping-basket"></i>

                                View All
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
      

    </body>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>
</body>

</html>