<div class="card testimonial-card">

    <!-- Background color -->
    <div class="card-up card-image"
         style="background-image: url({{ asset('assets/img/brain-2.jpg') }});">
        <div class="rgba-black-strong h-100 p-3 white-text">
        </div>
    </div>

    <!-- Avatar -->
    <div class="avatar mx-auto white">
        <img id="profile-pic" src="{{ $authUser->image }}" class="rounded-circle"
             alt="{{ $authUser->fullname }}">
    </div>
    <form method="post" action="{{ route('dashboard.profile.image.update') }}"
          enctype="multipart/form-data">
        @csrf
        <div class="file-field">
            <div class="d-flex justify-content-center">
                <div class="btn btn-mdb-color btn-rounded float-left">
                    <span>ویرایش تصویر</span>
                    <input type="file" name="image" accept="image/*" onchange="form.submit()">
                </div>
            </div>
        </div>
    </form>

    <!-- Content -->
    <div class="card-body px-3 py-4">
        <div class="row text-center py-4">
            <h2 class="font-weight-bold mx-auto">ویرایش اطلاعات</h2>
        </div>
        <form id="editForm" method="post" class="text-center md-form"
              action="{{ route('dashboard.profile.update') }}">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="name">نام</label>
                        <input type="text" id="name" name="name"
                               class="form-control  @error('name') is-invalid @enderror"
                               value="{{ $authUser->name }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="md-form">
                        <label for="surname">نام خانوادگی</label>
                        <input type="text" id="surname" name="surname"
                               class="form-control  @error('surname') is-invalid @enderror"
                               value="{{ $authUser->surname }}">
                        @error('surname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="email">ایمیل</label>
                        <input type="text" id="email" name="email" value="{{ $authUser->email }}"
                               class="form-control  @error('email') is-invalid @enderror"
                               autocomplete="off">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="cell">شماره موبایل</label>
                        <input type="text" id="cell" name="cell"
                               class="form-control  @error('cell') is-invalid @enderror"
                               value="{{ $authUser->cell }}">
                        @error('cell')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                        class="btn btn-outline-info btn-rounded  my-4 waves-effect z-depth-0">
                    ویرایش
                </button>
            </div>
        </form>

        <div class="row text-center py-4">
            <h2 class="font-weight-bold mx-auto">تغییر گذرواژه</h2>
        </div>
        <form id="editPassForm" method="post" class="text-center md-form"
              action="{{ route('dashboard.profile.password.change') }}">
            @csrf
            <div class="row justify-content-center form-row">
                <div class="col-md-6 text-center">
                    <div class="md-form">
                        <label for="current_password">گذرواژه کنونی</label>
                        <input type="password" id="current_password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="password">گذرواژه جدید</label>
                        <input type="text" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="md-form">
                        <label for="password_confirmation">تکرار گذرواژه</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0">
                    تغییر گذرواژه
                </button>
            </div>
        </form>

    </div>

</div>
