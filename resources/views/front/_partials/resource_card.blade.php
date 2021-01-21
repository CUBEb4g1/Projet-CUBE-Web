<div class="col-lg-5 m-3">
    <div class="resource-card">
        <div class="card-banner">
            <p class="category-tag bg-success-gradiant">
                <a href="{{route('search', ['category' => $resource->category->id])}}" class="card-link col-12 mx-0">{{$resource->category->label}}</a>
                @auth()
                    @if($resource->isFavoritedBy(Auth::user() ?? ''))
                        <i class="fas fa-heart fa-fw text-danger" title="Ressource en favoris"></i>
                    @endif
                    @if($resource->isSubscribedBy(Auth::user() ?? ''))
                        <i class="fas fa-bookmark fa-fw text-danger" title="Ressource suivie"></i>
                    @endif
                @endauth
                <span title="Nombre de vues"><i class="fal fa-eye fa-fw"></i> {{$resource->views}}</span>
            </p>
            <img class="banner-img" class="banner-img" src='https://phoenixia-prods.com/wp-content/uploads/2020/12/3.jpg' alt=''>
        </div>
        <a href="{{route('front.resource_get', $resource->id)}}" class="text-decoration-none resource-link">
            <div class="card-body">
                <h2 class="resource-title">{{$resource->title}}</h2>
                <p class="resource-description">P'tit Jésus de ciboire de purée de saint-ciboire de verrat de géritole de bout d'crisse d'astie de
                    ciarge de torvisse de calvince de saint-sacrament de torrieux.</p>
                <div class="d-flex justify-content-between small flex-wrap mx-0">
                    <a href="{{route('search', ['type' => $resource->resourceType->id])}}"
                       class="card-link col-6 mx-0 px-0">{{$resource->resourceType->label}}</a>
                    <a href="{{route('search', ['relation' => $resource->relation->id])}}"
                       class="card-link col-6 mx-0 px-0">{{$resource->relation->label}}</a>
                </div>
                <div class="card-profile">
                    <img class="profile-img" src='{{ asset('/media/front/testimonial/KA.png') }}' alt=''>
                    <div class="card-profile-info">
                        <h3 class="profile-name">- {{$resource->user->getInitials()}}</h3>
                        <p class="profile-datetime">{{ucfirst($resource->created_at->translatedFormat('D d F Y')) . ' à ' . $resource->created_at->format('H:i')}}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

