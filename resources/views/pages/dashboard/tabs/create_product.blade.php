<div class="card">
    <div class="card-body px-3 py-4">
        <div class="row text-center py-4">
            <h2 class="font-weight-bold mx-auto">افزودن محصول</h2>
        </div>
        <form id="create_product_form" method="post" class="text-center"
              action="{{ route('dashboard.products.store') }}">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="name">عنوان</label>
                        <input type="text" class="form-control" id="name"
                               value="{{ old('name') }}" name="name">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <select type="text" class="mdb-select" id="category" name="category"
                                style="width: 100%;">
                            <option value="" disabled selected>
                                دسته
                            </option>
                            @foreach($productCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category') ? 'selected':''}}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="md-form">
                        <select type="text" class="mdb-select" id="tags" name="tags[]"
                                multiple="multiple" style="width: 100%;">
                            <option value="" disabled selected>
                                برچسب ها
                            </option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{in_array($tag->id, old('tags', [])) ? 'selected':''}}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="md-form">
                        <label for="price">قیمت</label>
                        <input type="text" class="form-control numeric-input" id="price"
                               value="{{ old('price') }}" name="price">
                    </div>
                </div>
                <div class="col">
                    <div class="md-form">
                        <label for="discount">تخفیف</label>
                        <input type="text" class="form-control percent-input" id="discount"
                               value="{{ old('discount', 0) }}" name="discount">
                    </div>
                </div>
                <div class="col" id="product_type_physical">
                    <div class="md-form">
                        <label for="quantity">تعداد</label>
                        <input type="text" class="form-control numeric-input" id="quantity"
                               value="{{ old('quantity') }}" name="quantity">
                    </div>
                </div>
            </div>

            <div class="form-row mt-5">
                <div class="col">
                    <label>تصاویر</label>
                    <div id="dropzone" class="needsclick dz-clickable"
                         data-action="{{ route('upload.dropzone') }}">
                        <div class="dz-message">
                            <div class="text-center"><i class="fas fa-plus"></i></div>
                            <div class="text-center">برای بارگذاری تصاویر اینجا کلیک کنید.</div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <label for="features">ویزگی ها
                        <small> (پس از وارد کردن هر کدام کلید Enter را فشار دهید) </small>
                    </label>
                    <select multiple name="features[]" id="features">
                        @foreach( old('features', []) as $feature)
                            <option value="{{ $feature}}">{{ $feature}}</option
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <label for="summery">خلاصه</label>
                    <textarea id="summery" name="summery"
                              style="width: 100%; height: 210px; border: 1px solid #dddddd; padding: 10px;"
                              class="form-control">{!! old('summery') !!}</textarea>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <label for="description">توضیحات</label>
                    <textarea id="description" name="description"
                              style="width: 100%; height: 210px; border: 1px solid #dddddd; padding: 10px;"
                              class="form-control">{!! old('description') !!}</textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-outline-info btn-rounded  my-4 waves-effect z-depth-0">
                    ارسال
                </button>
            </div>

        </form>
    </div>
</div>
