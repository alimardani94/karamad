<li class="@yield('home')">
    <a href="{{route('admin.home')}}">
        <i class="fa fa-home"></i>
        <span>خانه</span>
    </a>
</li>

<li class="treeview @yield('category')">
    <a href="#">
        <i class="fa fa-users"></i>
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
        <i class="fa fa-users"></i>
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


<li class="treeview @yield('user')">
    <a href="#">
        <i class="fa fa-users"></i>
        <span>کاربران</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="">
                <i class="fa fa-circle-o"></i>
                لیست کاربران
            </a>
        </li>

    </ul>
</li>
