<div class="card">
    <div class="card-header bg-botitle h2 d-flex justify-content-between">
        Utilisateurs
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="d-flex justify-content-end btn btn-primary">Plus de stats</button>
        </div>
    </div>
    <div class="card-body bg-bobody bo-cardpadding my-0">
        <div class="list-group list-group-flush bg-bobody text-left p-3">
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres d'utilisateurs enregistrés :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $UserTotalCount }}</span>
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres d'utilisateurs non confirmés :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $UserNotVerifiedCount }}</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres d'utilisateurs confirmés :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $UserVerifiedCount }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex bg-light p-1 align-items-end">
        {!! $Userchart->container() !!}
    </div>
</div>
@push('scripts')
    <script src="{{ asset('modules/apexcharts/dist/apexcharts.js') }}"></script>
    {{ $Userchart->script() }}
@endpush
