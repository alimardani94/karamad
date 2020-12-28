<div class="">
    <table id="products_datatable"
           data-lang="{{  (app()->getLocale() != 'en') ? asset('assets/vendor/datatables/' . app()->getLocale() . '.json'): '' }}"
           data-action="{{ route('dashboard.products.datatable') }}">
    </table>
</div>
