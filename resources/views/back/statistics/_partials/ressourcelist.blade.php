
<div class="card">
    <div class="card-header bg-botitle h2">Ressources</div>
    <div class="card-body bg-bobody bo-cardpadding ">
        <div class="list-group list-group-flush bg-bobody text-left p-3">
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres de ressources créer :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $ResourceTotalCount }}</span>
                </div>
            </div>
            <div class="clearfix">
                <hr>
            </div>
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres de ressources validées :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $ResourceVerifiedCount }}</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres de ressources supprimées :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $ResourcesDeletedCount }}</span>
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex align-items-start mr-3 w-100">
                    <span class="h5">Nombres de ressources en attente :</span>
                </div>
                <div class="d-flex align-items-end">
                    <span class="align-items-end h5">{{ $ResourceNotVerifiedCount }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex bg-light w-100 justify-content-end">
            {!! $Resourcechart->container() !!}
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('modules/apexcharts/dist/apexcharts.js') }}"></script>
    {{ $Resourcechart->script() }}
@endpush
