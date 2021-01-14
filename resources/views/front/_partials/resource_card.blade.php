<div class="col-lg-5 m-3">
    <div class="card ">
        <a href="{{route('front.resource_get', $resource->id)}}" class="text-decoration-none resource-link">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between">
                    <span><h6>{{$resource->title}}</h6></span>
                    <div>
                        @auth()
                            @if($resource->isFavoritedBy(Auth::user() ?? ''))
                                <i class="fas fa-heart fa-fw text-danger" title="Ressource en favoris"></i>
                            @endif
                            @if($resource->isSubscribedBy(Auth::user() ?? ''))
                                <i class="fas fa-bookmark fa-fw text-danger" title="Ressource suivie"></i>
                            @endif
                        @endauth
                        <span title="Nombre de vues"><i class="fal fa-eye fa-fw"></i> {{$resource->views}}</span>
                    </div>

                </div>
                {{--                <h5 class="card-title"></h5>--}}
                <hr>
                <p class="card-text">
                    P'tit Jésus de ciboire de purée de saint-ciboire de verrat de géritole de bout d'crisse d'astie de
                    ciarge de torvisse de calvince de saint-sacrament de torrieux.
                </p>
            </div>
        </a>

        <div class="card-footer text-muted">
            <div class="d-flex justify-content-between small flex-wrap mx-0">
                <a href="{{route('search', ['category' => $resource->category->id])}}"
                   class="card-link col-12 mx-0 px-0">{{$resource->category->label}}</a>
                <a href="{{route('search', ['relation' => $resource->relation->id])}}"
                   class="card-link col-12 mx-0 px-0">{{$resource->relation->label}}</a>
                <a href="{{route('search', ['type' => $resource->resourceType->id])}}"
                   class="card-link col-12 mx-0 px-0">{{$resource->resourceType->label}}</a>
            </div>

            <div class="justify-content-between d-flex align-items-center">

            <span class="small text-muted text-right">
                {{ucfirst($resource->created_at->translatedFormat('D d F Y')) . ' à ' . $resource->created_at->format('H:i')}}
            </span>
                <span class="text-muted text-right">
                - {{$resource->user->getInitials()}}
            </span>
            </div>
        </div>
    </div>

</div>

