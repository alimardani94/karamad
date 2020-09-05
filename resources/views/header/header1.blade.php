<header id="header1">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar white">

        <a class="navbar-brand" href="{{ route('home')}}">هوش کاپ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">دسته بندی
                        <span class="sr-only">(current)</span>
                    </a>
                    <div class="dropdown-menu mega-menu v-1 z-depth-1 white py-5 px-3"
                         aria-labelledby="navbarDropdownMenuLink1">
                        <div class="row">
                            <div class="col-md-5 col-xl-3 sub-menu mb-xl-0 mb-5">
                                <ul class="list-unstyled">
                                    <li class="sub-title text-uppercase">
                                        <a class="menu-item pr-1 mt-2" href="#!">دبستان</a>
                                    </li>
                                    <li class="sub-title text-uppercase">
                                        <a class="menu-item pr-1 mt-2" href="#!">دبیرستان</a>
                                    </li>
                                    <li class="sub-title text-uppercase">
                                        <a class="menu-item pr-1 mt-2" href="#!">دانشگاهی</a>
                                    </li>
                                    <li class="sub-title text-uppercase">
                                        <a class="menu-item pr-1 mt-2" href="#!">عمومی</a>
                                    </li>
                                    <li class="sub-title text-uppercase">
                                        <a class="menu-item pr-1 mt-2" href="#!">تکنولوژی</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 col-xl-4 sub-menu mb-xl-0 mb-4">
                                <h6 class="sub-title pb-3 text-uppercase font-weight-bold">ویژگی ها</h6>
                                <!--Featured image-->
                                <a href="#!" class="view overlay z-depth-1 p-0 my-3">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(42).jpg"
                                         class="img-fluid" alt="First sample image">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                                <a class="news-title font-weight-bold pl-0" href="#!">
                                    کنفرانس بزرگ استاد بنفشه
                                </a>
                                <p class="font-small text-uppercase text-muted">
                                    <span>توسط -</span>
                                    <a class="p-0 m-sm" href="#!"> شخس استاد</a>
                                    <span>- ۵ مهر </span>
                                </p>
                            </div>
                            <div class="col-md-12 col-xl-5 sub-menu mb-md-0 mb-xl-0 mb-4">
                                <h6 class="sub-title pb-3 text-uppercase font-weight-bold">دوره ها</h6>
                                <div class="news-single">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!--Image-->
                                            <a href="#!" class="view overlay z-depth-1 p-0 my-3">
                                                <img
                                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(43).jpg"
                                                    class="img-fluid" alt="First sample image">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <a class="news-title smaller mt-md-2 pl-0" href="#!">
                                                کلاس علوم اقای در پیت
                                            </a>
                                            <p class="font-small text-uppercase text-muted">July 14, 2017</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="news-single">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!--Image-->
                                            <a href="#!" class="view overlay z-depth-1 p-0 mb-3 mt-4">
                                                <img
                                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(44).jpg"
                                                    class="img-fluid" alt="First sample image">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <a class="news-title smaller mt-md-2 pl-0" href="#!">
                                                ریاضیات خیلی گسسته شمایی زاده
                                            </a>
                                            <p class="font-small text-uppercase text-muted">July 14, 2017</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="news-single">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!--Image-->
                                            <a href="#!" class="view overlay z-depth-1 p-0 mb-3 mt-4">
                                                <img
                                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Work/6-col/img%20(41).jpg"
                                                    class="img-fluid" alt="First sample image">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <a class="news-title smaller" href="#!">
                                                دوره مبارزه با گیاه خواری
                                            </a>
                                            <p class="font-small text-uppercase text-muted">July 14, 2017</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">دوره های آموزشی</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.index') }}">فروشگاه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">مقالات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact-us') }}">تماس با ما</a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto mb-4">
                <li class="nav-item">
                    <form class="search-form" role="search" action="{{ route('search') }}">
                        <div class="form-group md-form my-0 waves-light waves-effect waves-light">
                            <input type="text" name="q" class="form-control" placeholder="جستجو">
                        </div>
                    </form>
                </li>
            </ul>

            <ul class="navbar-nav nav-flex-icons mr-auto">
                @if( array_sum(Session::get('cart', [])) )
                    <li class="nav-item">
                        <a class="nav-link dark-grey-text font-weight-bold waves-effect waves-light pt-3"
                           href="{{ route('shop.cart.show') }}">
                                <span class="badge primary-color" id="cart_count">
                                    {{ array_sum(Session::get('cart', [])) }}
                                </span>
                            <i class="far fa-shopping-cart blue-text" aria-hidden="true"></i>
                            <span class="clearfix d-md-none">سبد خرید</span>
                        </a>
                    </li>
                @endif
                @auth
                    <li class="nav-item dropdown d-none d-md-block">
                        <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="clearfix d-none d-inline-block">
                                 <img id="profile-pic" src="{{ auth()->user()->image }}" class="rounded-circle avatar"
                                      alt="{{ auth()->user()->full_name }}">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu mt-2" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('dashboard.home') }}">داشبورد</a>
                            <a class="dropdown-item" href="{{ route('auth.sign-out') }}">خروج</a>
                        </div>
                    </li>

                    <li class="nav-item d-md-none">
                        <a class="nav-link pt-3" href="{{ route('dashboard.home') }}">داشبورد</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link pt-3" href="{{ route('auth.sign-out') }}">خروج</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link ml-3" href="{{ route('auth.sign-in')}}">ورود</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link pt-3 ml-3" href="{{ route('auth.sign-in')}}">ورود</a>
                    </li>
                @endguest
            </ul>
        </div>

    </nav>


    <div class="view jarallax" data-jarallax='{"speed": 0.2}'
         style="background-image: url({{$headerBG}}); background-repeat: no-repeat;
             background-size: cover; background-position: center center;">
        <div class="mask rgba-black-light">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="row pt-5 mt-3">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-3 wow fadeInDown"
                                data-wow-delay="0.3s">
                                <strong>{{ $headerTitle ?? trans('general.hooshcup') }}</strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
