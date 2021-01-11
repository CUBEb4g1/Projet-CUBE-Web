@push('styles')
    <link href="{{ mix('css/back/statistics.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endpush

<div class="card">
    <div class="card-header bg-botitle">Utilisateurs</div>
    <div class="card-body bg-bobody bo-cardpadding">
        <div class="list-group list-group-flush bg-bobody text-left">
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="">Nombres d'utilisateur enregistrés :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end">{{ $TotalCount }}</span>
                </div>
            </div>

            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="">Nombres d'utilisateur confirmés :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end">{{ $VerifiedCount }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex bg-light w-100">
            {!! $chart->container() !!}
        </div>
    </div>
</div>
