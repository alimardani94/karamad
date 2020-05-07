<li class="@yield('home')">
    <a href="{{route('admin.home')}}">
        <i class="fa fa-home"></i>
        <span>خانه</span>
    </a>
</li>

<li class="treeview @yield('category')">
    <a href="#">
        <i class="fa fa-th"></i>
        <span>دسته بندی ها</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('category1')">
            <a href="{{route('admin.categories.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست دسته بندی ها
            </a>
        </li>
        <li class="@yield('category2')">
            <a href="{{route('admin.categories.create')}}">
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
            <a href="{{route('admin.instructors.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست مدرسان
            </a>
        </li>
        <li class="@yield('instructor2')">
            <a href="{{route('admin.instructors.create')}}">
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
            <a href="{{route('admin.courses.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست دوره ها
            </a>
        </li>
        <li class="@yield('course2')">
            <a href="{{route('admin.courses.create')}}">
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
            <a href="{{route('admin.syllabuses.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست جلسات
            </a>
        </li>
        <li class="@yield('syllabus2')">
            <a href="{{route('admin.syllabuses.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن جلسه
            </a>
        </li>
    </ul>
</li>

<li class="treeview @yield('post')">
    <a href="#">
        <i class="fa fa-bold"></i>
        <span>مجله</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('post1')">
            <a href="{{route('admin.posts.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست مجلات
            </a>
        </li>
        <li class="@yield('post2')">
            <a href="{{route('admin.posts.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن مجله
            </a>
        </li>
        <li class="@yield('post3')">
            <a href="{{route('admin.tags.create')}}">
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
            <a href="{{route('admin.admins.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست مدیران
            </a>
        </li>
        <li class="@yield('admin2')">
            <a href="{{route('admin.admins.create')}}">
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
            <a href="{{route('admin.users.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست کاربران
            </a>
        </li>
    </ul>
</li>
