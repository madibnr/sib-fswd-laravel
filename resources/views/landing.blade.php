<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Gede Comp</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('images/web-icon.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('images/web-icon.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href=""><img src="images/web-icon.png" style="width:150px; height:81px" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="">About Us</a></li>
                        <li class="dropdown megamenu-fw">
                            <a href="#" class="nav-link ">Product</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
                                <li><a href="">Cart</a></li>
                                <li><a href="">Checkout</a></li>
                                <li><a href="">My Account</a></li>
                                <li><a href="">Wishlist</a></li>
                                <li><a href="">Shop Detail</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="">Our Service</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Login</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @foreach ($slider as $slider)
                @if ($slider->status == 'active')
                    <li class="text-left">
                        <img src="{{ asset('storage/slider/' . $slider->image) }}" alt="">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="m-b-20"><strong>{{ $slider->title }}</strong></h1>
                                    <p class="m-b-40">{{ $slider->caption }}</p>
                                    <p><a class="btn btn-danger" href="#">Shop New</a></p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>Featured Products</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            @foreach ($kategori as $cat)
                                <button data-filter=".{{ $cat->id }}">{{ $cat->nama }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .special-grid {
                    margin-bottom: 30px;
                }
            </style>

            <div class="row special-list">
                @foreach ($produk as $produk)
                    @if ($produk->status == 'approve')
                        <div class="col-lg-3 col-md-6 special-grid {{ $produk->kategori_id }}">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <div class="type-lb">
                                        <p class="sale">Sale</p>
                                    </div>
                                    <img src="{{ asset('storage/produk/' . $produk->image) }}" class="img-fluid" alt="Image" style="width:270px; height:350px;">
                                </div>
                                <div class="why-text">
                                    <h5>{{ $produk->name }}</h5>
                                    <div class="caption-text">
                                        <h6 class="caption-truncated">{{ strlen($produk->caption) > 30 ? substr($produk->caption, 0, 30) . '...' : $produk->caption }}</h6>
                                        <h6 class="caption-full" style="display: none;">{{ $produk->caption }}</h6>
                                    </div>
                                    @if (strlen($produk->caption) > 30)
                                        <h5>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h5>
                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                            <i class="show-more-btn fa-solid fa-angle-down" style="color: #ff2e2e; cursor: pointer;"></i>
                                            <div class="buy-now" style="display: none;">
                                                <a class="btn btn-danger fas fa-cart-shopping" href="https://api.whatsapp.com/send/?phone=62895121420"></a>
                                            </div>
                                            <i class="show-less-btn fa-solid fa-angle-up" style="color: #ff2e2e; display: none; cursor: pointer;"></i>
                                        </div>
                                    @endif
                                </div>                                              
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Our Store</h1>
                        <p>We have an offline store where you can visit and shop directly.</p>
                    </div>
                </div>
            </div>

                <div class="d-flex align-items-center justify-content-center" >
                    <div class="blog-box">
                        <div class="blog-img">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2092450422037!2d110.0690253760035!3d-6.984614468401571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7043426c0084f7%3A0x19bb72fbff8cb60c!2sGEDE%20COMPUTER!5e0!3m2!1sid!2sid!4v1686764275075!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- End Blog  -->

    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Gede Computer</h4>
                            <p>
                                At our store, we understand the importance of staying up-to-date with the latest technology trends. That's why we constantly strive to bring you the newest and most innovative products in the market. Whether you are a casual user, a professional, or a gaming enthusiast, we have the perfect solutions to enhance your computing experience.
                            </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Tamtama Street No. 12 Weleri <br>Central Java,<br> 51356 </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="">+1-888 705 770</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2023 <a href="">Gede Comp</a> Design By :
            <a href="">Adib</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var showMoreBtns = document.querySelectorAll(".show-more-btn");
            var showLessBtns = document.querySelectorAll(".show-less-btn");
            var showMoreContents = document.querySelectorAll(".show-more-content");
    
            showMoreBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var content = this.parentNode.querySelector(".show-more-content");
                    content.style.display = "block";
                });
            });
    
            showLessBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var content = this.parentNode.querySelector(".show-more-content");
                    content.style.display = "none";
                });
            });
        });
    </script>

    <!-- ALL JS FILES -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/inewsticker.js')}}"></script>
    <script src="{{asset('js/bootsnav.js')}}"></script>
    <script src="{{asset('js/images-loded.min.js')}}"></script>
    <script src="{{asset('js/isotope.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('js/form-validator.min.js')}}"></script>
    <script src="{{asset('js/contact-form-script.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".show-more-btn").click(function() {
                $(this).hide();
                $(this).siblings(".show-less-btn").show();
                $(this).parents(".why-text").find(".caption-truncated").hide();
                $(this).parents(".why-text").find(".caption-full").show();
                $(this).parents(".why-text").find(".buy-now").show();
            });
    
            $(".show-less-btn").click(function() {
                $(this).hide();
                $(this).siblings(".show-more-btn").show();
                $(this).parents(".why-text").find(".caption-truncated").show();
                $(this).parents(".why-text").find(".caption-full").hide();
                $(this).parents(".why-text").find(".buy-now").hide();
            });
        });
    </script>
</body>

</html>