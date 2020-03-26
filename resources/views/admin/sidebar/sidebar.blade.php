<li @if(Route::is('admin.home')) class="active" @endif>
    <a href="{{route('admin.home')}}">
        <i class="fa fa-home"></i>
        <span>خانه</span>
    </a>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-users"></i>
        <span>مدرسان</span>
        <i class="fa fa-angle-left pull-left"></i>
    </a>
    <ul class="treeview-menu">
        <li @if(Route::is('admin.instructors.index')) class="active" @endif >
            <a href="{{route('admin.instructors.index')}}">
                <i class="fa fa-circle-o"></i>
                لیست مدرسان
            </a>
        </li>
        <li @if(Route::is('admin.instructors.create')) class="active" @endif >
            <a href="{{route('admin.instructors.create')}}">
                <i class="fa fa-circle-o"></i>
                افزودن مدرس
            </a>
        </li>
    </ul>
</li>


<li class="treeview @if(Route::is('admin.user.index')) active @endif">
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
