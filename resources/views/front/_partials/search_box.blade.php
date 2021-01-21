<div class="col-lg-6 align-justify-center contact-form">
    <div class="d-lg-flex align-items-center p-xl-5 p-0 text-center justify-content-center">
        <form action="{{route('search')}}" method="get" class="__js-sb-form mt-4">
            <div class="border p-xl-5 p-3 bg-soft-dark">
                <h3 class="mb-4">Super formulaire de recherche</h3>

                <div class="form-group">
                    @include('front._partials.searchbox.title')
                </div>

                <div class="form-group">
                    @include('front._partials.searchbox.categories')
                </div>

                <div class="form-group">
                    @include('front._partials.searchbox.relations')
                </div>

                <div class="form-group">
                    @include('front._partials.searchbox.types')
                </div>

                <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">
                    Je cherche
                </button>
            </div>
        </form>
    </div>
</div>
