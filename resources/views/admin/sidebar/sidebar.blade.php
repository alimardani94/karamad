<li class="@yield('home')">
    <a href="{{ route('admin.home')}}">
        <i class="fa fa-home"></i>
        <span>خانه</span>
    </a>
</li>

<li class="header">دوره</li>
<li class="treeview @yield('course.category')">
    <a href="#">
        <i class="fa fa-th"></i>
        <span>دسته بندی ها</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('course.category1')">
            <a href="{{ route('admin.categories.index', ['type' =>  \App\Enums\CategoryType::Course]) }}">
                <i class="fa fa-circle-o"></i>
                لیست دسته بندی ها
            </a>
        </li>
        <li class="@yield('course.category2')">
            <a href="{{ route('admin.categories.create', ['type' =>  \App\Enums\CategoryType::Course]) }}">
                <i class="fa fa-circle-o"></i>
                افزودن دسته بندی
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('instructor')">
    <a href="#">
        <i class="fa fa-graduation-cap"></i>
        <span>مدرسان</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('instructor1')">
            <a href="{{ route('admin.instructors.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست مدرسان
            </a>
        </li>
        <li class="@yield('instructor2')">
            <a href="{{ route('admin.instructors.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن مدرس
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('course')">
    <a href="#">
        <i class="fa fa-book"></i>
        <span>دوره ها</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('course1')">
            <a href="{{ route('admin.courses.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست دوره ها
            </a>
        </li>
        <li class="@yield('course2')">
            <a href="{{ route('admin.courses.create') }}">
                <i class="fa fa-circle-o"></i>
                افزودن دوره
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('syllabus')">
    <a href="#">
        <i class="fa fa-file"></i>
        <span>جلسات</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('syllabus1')">
            <a href="{{ route('admin.syllabuses.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست جلسات
            </a>
        </li>
        <li class="@yield('syllabus2')">
            <a href="{{ route('admin.syllabuses.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن جلسه
            </a>
        </li>
    </ul>
</li>

<li class="header">آزمون</li>
<li class="treeview @yield('exam')">
    <a href="#">
        <i class="fa fa-check"></i>
        <span>آزمون ها</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('exam1')">
            <a href="{{ route('admin.exams.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست آزمون ها
            </a>
        </li>
        {{--        <li class="@yield('exam2')">--}}
        {{--            <a href="{{ route('admin.exams.create') }}">--}}
        {{--                <i class="fa fa-circle-o"></i>--}}
        {{--                افزودن آزمون--}}
        {{--            </a>--}}
        {{--        </li>--}}
    </ul>
</li>

<li class="treeview @yield('question')">
    <a href="#">
        <i class="fa fa-question"></i>
        <span>سوالات</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('question1')">
            <a href="{{ route('admin.questions.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست سوالات
            </a>
        </li>
        {{--        <li class="@yield('question2')">--}}
        {{--            <a href="{{ route('admin.questions.create')}}">--}}
        {{--                <i class="fa fa-circle-o"></i>--}}
        {{--                افزودن سوال--}}
        {{--            </a>--}}
        {{--        </li>--}}
    </ul>
</li>

<li class="header">مقاله</li>
<li class="treeview @yield('post')">
    <a href="#">
        <i class="fa fa-bold"></i>
        <span>مقاله</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('post1')">
            <a href="{{ route('admin.posts.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست مقالات
            </a>
        </li>
        <li class="@yield('post2')">
            <a href="{{ route('admin.posts.create') }}">
                <i class="fa fa-circle-o"></i>
                افزودن مقاله
            </a>
        </li>
        <li class="@yield('post3')">
            <a href="{{ route('admin.posts.comments.index')}}">
                <i class="fa fa-circle-o"></i>
                <span>دیدگاه ها</span>
            </a>
        </li>
    </ul>
</li>

<li class="header">فروشگاه</li>
<li class="treeview @yield('shop.category')">
    <a href="#">
        <i class="fa fa-th"></i>
        <span>دسته بندی ها</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('shop.category1')">
            <a href="{{ route('admin.categories.index', ['type' =>  \App\Enums\CategoryType::Shop]) }}">
                <i class="fa fa-circle-o"></i>
                لیست دسته بندی ها
            </a>
        </li>
        <li class="@yield('shop.category2')">
            <a href="{{ route('admin.categories.create', ['type' =>  \App\Enums\CategoryType::Shop]) }}">
                <i class="fa fa-circle-o"></i>
                افزودن دسته بندی محصول
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('product')">
    <a href="#">
        <i class="fa fa-suitcase"></i>
        <span>محصول</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('product1')">
            <a href="{{ route('admin.products.index') }}">
                <i class="fa fa-circle-o"></i>
                لیست محصولات
            </a>
        </li>
        <li class="@yield('product2')">
            <a href="{{ route('admin.products.create') }}">
                <i class="fa fa-circle-o"></i>
                افزودن محصول
            </a>
        </li>
        <li class="@yield('product3')">
            <a href="{{ route('admin.products.comments.index')}}">
                <i class="fa fa-circle-o"></i>
                <span>دیدگاه ها</span>
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('product')">
    <a href="#">
        <i class="fa fa-shopping-cart"></i>
        <span>فروش</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('product1')">
            <a href="{{ route('admin.orders.index')}}">
                <i class="fa fa-circle-o"></i>
                سفارشات
            </a>
        </li>
    </ul>
</li>

<li class="header">مالی</li>
<li class="@yield('transaction')">
    <a href="{{ route('admin.transactions.index')}}">
        <i class="fa fa-money"></i>
        <span>تراکنش ها</span>
    </a>
</li>

<li class="header">مدیریت</li>
<li class="@yield('contact-form')">
    <a href="{{ route('admin.contact-form.index')}}">
        <i class="fa fa-money"></i>
        <span>پیام ها</span>
    </a>
</li>
<li class="treeview @yield('post')">
    <a href="#">
        <i class="fa fa-tag"></i>
        <span>برچسب</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('post3')">
            <a href="{{ route('admin.tags.create') }}">
                <i class="fa fa-circle-o"></i>
                افزودن برچسب
            </a>
        </li>
    </ul>
</li>
<li class="treeview @yield('admin')">
    <a href="#">
        <i class="fa fa-user-secret"></i>
        <span>مدیران</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('admin1')">
            <a href="{{ route('admin.admins.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست مدیران
            </a>
        </li>
        <li class="@yield('admin2')">
            <a href="{{ route('admin.admins.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن مدیر
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('user')">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>کاربران</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('user1')">
            <a href="{{ route('admin.users.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست کاربران
            </a>
        </li>
    </ul>
</li>
