<header id="header2">
    <nav class="navbar navbar-expand-lg navbar-light stylish-color-light white">

        <a class="navbar-brand" href="{{ route('home') }}">کارامد</a>

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
                                    @foreach($headerCategories as $category)
                                        <li class="sub-title text-uppercase">
                                            <a class="menu-item pr-1 mt-2"
                                               href="{{ route('home') }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-7 col-xl-4 sub-menu mb-xl-0 mb-4">
                                <h6 class="sub-title pb-3 text-uppercase font-weight-bold">مقالات</h6>
                                @if($headerPost)
                                    <a href="#!" class="view overlay z-depth-1 p-0 my-3">
                                        <img
                                            src="{{ asset('storage/' . $headerPost->image) }}"
                                            class="img-fluid" alt="First sample image">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                    <a class="news-title font-weight-bold pl-0" href="#!">
                                        {{ $headerPost->title }}
                                    </a>
                                    <p class="font-small text-uppercase text-muted">
                                        <span>توسط -</span>
                                        <a class="p-0 m-sm" href="#!"> {{ $headerPost->author->full_name  }} </a>
                                        <span>-  {{ jDate($headerPost->created_at, 'dd MMMM')  }}</span>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-12 col-xl-5 sub-menu mb-md-0 mb-xl-0 mb-4">
                                <h6 class="sub-title pb-3 text-uppercase font-weight-bold">دوره ها</h6>
                                @foreach($headerCourses as $course)
                                    <div class="news-single">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!--Image-->
                                                <a href="#!" class="view overlay z-depth-1 p-0 my-3">
                                                    <img
                                                        src="{{ asset('storage/'.$course->image) }}"
                                                        class="img-fluid" alt="First sample image">
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <a class="news-title smaller mt-md-2 pl-0" href="#!">
                                                    {{ $course->title }}
                                                </a>
                                                <p class="font-small text-uppercase text-muted">{{ $course->syllabuse_count }}
                                                    جلسه </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                    <li class="nav-item">
                        <a class="nav-link pt-3" href="{{ route('auth.otp') }}">ورود</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

</header>
