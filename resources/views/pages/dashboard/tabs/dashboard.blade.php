<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                <div class="card card-cascade cascading-admin-card blue lighten-5">
                    <div class="admin-up">
                        <i class="fas fa-university light-blue lighten-1 mr-3 z-depth-2 float-left"></i>
                        <div class="data">
                            <h4 class="text-uppercase">دوره ها</h4>
                        </div>
                    </div>
                    <div class="card-body card-body-cascade">
                        <h3 class="font-weight-bold dark-grey-text">{{ $courses->total() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                <div class="card card-cascade cascading-admin-card blue lighten-5">
                    <div class="admin-up">
                        <i class="fas fa-shopping-bag red accent-2 mr-3 z-depth-2 float-left"></i>
                        <div class="data">
                            <h4 class="text-uppercase">سفارشات</h4>
                        </div>
                    </div>
                    <div class="card-body card-body-cascade">
                        <h3 class="font-weight-bold dark-grey-text">{{ $orders->total() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                <div class="card card-cascade cascading-admin-card blue lighten-5">
                    <div class="admin-up">
                        <i class="far fa-money-bill-alt primary-color mr-3 z-depth-2 float-left"></i>
                        <div class="data">
                            <h4 class="text-uppercase">تراکنش</h4>
                        </div>
                    </div>
                    <div class="card-body card-body-cascade">
                        <h3 class="font-weight-bold dark-grey-text">{{ $transactions->total() }}</h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

        </div>
    </div>
</div>
