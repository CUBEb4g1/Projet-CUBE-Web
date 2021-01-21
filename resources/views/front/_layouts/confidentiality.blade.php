@extends('front._layouts.app')

@section('title', 'Confidentialité')

@section('content')
    <div class="confidentiality">
        <div class="container text-justify">
            <div class="row"> {{-- First row --}}
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="img">
                        <img src="{{ asset_cache('media/favicons/favicon.png') }}">
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <h1 class="font-weight-medium">Qui sommes-nous ?</h1>
                    <p>
                        <strong>Dénomination : </strong>Ressources Relationnelles</br>
                        <strong>Siège social : </strong>33 Avenue du Maréchal de Lattre de Tassigny, 70100 GRAY</br>
                        <strong>Téléphone : </strong>06 42 78 01 70</br>
                        <strong>Statut juridique : </strong>Association de loi du 1er Juillet 1901
                    </p>
                    <div class="accordion" id="accordionWho">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapsePropretary" aria-expanded="false" aria-controls="collapsePropretary">
                                                Propriétaire du site
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapsePropretary" class="collapse" data-parent="#accordionWho">
                                        <div class="card-body">
                                            Conformément aux dispositions de l’article 6 III-1 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique, nous vous informons que le présent site est la propriété de Ressources Relationnelles.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor">
                                                Editeur de service sur le sous site
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseEditor" class="collapse" data-parent="#accordionWho">
                                        <div class="card-body">
                                            <strong>Directeur de la publication : </strong>AMAMA Kayreddine à Phoenixia Productions</br>
                                            <strong>Responsable de la rédaction : </strong>HAUTEVELLE Nathan à Phoenixia Productions</br>
                                            <strong>Graphisme : </strong>KOUVTANOVITCH Corentin à Phoenixia Productions</br>
                                            <strong>Webmestre : </strong>ARRACHART Quentin à Phoenixia Productions</br>
                                            <strong>Hébergement : </strong>Rayformatics.fr
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> {{-- Second row --}}
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <h1 class="font-weight-medium">Règles d'usage</h1>
                    <p>
                        L’utilisateur reconnait avoir pris connaissance des présentes conditions d’utilisation et s’engage à les respecter. L’utilisateur du site web reconnaît disposer de la compétence et des moyens nécessaires pour accéder à ce site et l’utiliser.</br>
                        L’internaute s’engage à ne pas effectuer d’opérations pouvant nuire au bon fonctionnement du site, à l’intégrité des informations diffusées, et à l’image de Ressources Relationnelles.</br>
                        Il s’engage également à exercer une vigilance toute particulière dans l’utilisation des éléments qui lui sont mis à disposition et à observer toutes les précautions d’usage.
                    </p>
                    <h1 class="font-weight-medium">Responsabilités de R2sources</h1>
                    <p>
                        Ressources Relationnelles met tout en oeuvre pour offrir aux utilisateurs des informations et/ou outils disponibles et vérifiés mais ne sauraient être tenus pour responsables des erreurs, d’une absence de disponibilité des informations et/ou présence de virus sur son site. Les informations fournies par Ressources Relationnelles le sont à titre indicatif et ne sauraient dispenser l’utilisateur d’une analyse complémentaire et personnalisée. Ressources Relationnelles ne saurait garantir l’exactitude, la complétude et l’actualité des informations diffusées sur son site.</br>
                        Ressources Relationnelles ne saurait être responsable des pages auxquelles accèdent les utilisateurs via les liens hypertexte mis en place dans le cadre du site web en direction d’autres ressources présentes sur le réseau internet.</br>
                        En conséquence, l’utilisateur reconnaît utiliser les informations mises à sa disposition par Ressources Relationnelles sous sa responsabilité exclusive.
                    </p>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="img">
                        <img src="{{ asset_cache('media/front/statistics.png') }}">
                    </div>
                </div>
            </div>
            <div class="row"> {{-- Third row --}}
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="img">
                        <img src="{{ asset_cache('media/front/analysis.png') }}">
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <h1 class="font-weight-medium">Données à caractère personnel</h1>
                    <div class="accordion" id="accordionRGPD">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseLaws" aria-expanded="false" aria-controls="collapseLaws">
                                                Respect des lois en vigueur
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseLaws" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Le site r2sources.com respecte la vie privée de l’internaute et se conforme strictement aux lois en vigueur sur la protection de la vie privée et des libertés individuelles. Aucune information personnelle n’est collectée à votre insu. Aucune information personnelle n’est cédée à des tiers.</br>
                                            Les courriels, les adresses électroniques ou autres informations nominatives dont ce site est destinataire ne font l’objet d’aucune exploitation et ne sont conservés que pour la durée nécessaire de leur traitement.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseRights" aria-expanded="false" aria-controls="collapseRights">
                                                Droit des internautes : droit d'accès et de rectification
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseRights" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Conformément aux dispositions sur la loi n° 78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, les internautes disposent d’un droit d’accès, de modification, de rectification et de suppression des données qui les concernent. Ce droit s’exerce par voie postale, en justifiant de son identité, à l’adresse suivante :</br>
                                            <blockquote>
                                                <p>
                                                    Ressources Relationnelles</br>
                                                    33 Avenue du Maréchal de Lattre de Tassigny</br>
                                                    70100 GRAY
                                                </p>
                                            </blockquote>
                                            La politique du site r2sources.com est en conformité avec la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row"> {{-- Fourth row --}}
                <div class="accordion" id="accordionSite">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapsePropretary" aria-expanded="false" aria-controls="collapsePropretary">
                                            Propriétaire du site
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapsePropretary" class="collapse" data-parent="#accordionSite">
                                    <div class="card-body">
                                        Conformément aux dispositions de l’article 6 III-1 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique, nous vous informons que le présent site est la propriété de Ressources Relationnelles.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor">
                                            Editeur de service sur le sous site
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseEditor" class="collapse" data-parent="#accordionSite">
                                    <div class="card-body">
                                        Directeur de la publication : AMAMA Kayreddine à Phoenixia Productions</br>
                                        Responsable de la rédaction : HAUTEVELLE Nathan à Phoenixia Productions</br>
                                        Graphisme : KOUVTANOVITCH Corentin à Phoenixia Productions</br>
                                        Webmestre : ARRACHART Quentin à Phoenixia Productions</br>
                                        Hébergement : Rayformatics.fr
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor">
                                            Editeur de service sur le sous site
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseEditor" class="collapse" data-parent="#accordionSite">
                                    <div class="card-body">
                                        Directeur de la publication : AMAMA Kayreddine à Phoenixia Productions</br>
                                        Responsable de la rédaction : HAUTEVELLE Nathan à Phoenixia Productions</br>
                                        Graphisme : KOUVTANOVITCH Corentin à Phoenixia Productions</br>
                                        Webmestre : ARRACHART Quentin à Phoenixia Productions</br>
                                        Hébergement : Rayformatics.fr
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor">
                                            Editeur de service sur le sous site
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseEditor" class="collapse" data-parent="#accordionSite">
                                    <div class="card-body">
                                        Directeur de la publication : AMAMA Kayreddine à Phoenixia Productions</br>
                                        Responsable de la rédaction : HAUTEVELLE Nathan à Phoenixia Productions</br>
                                        Graphisme : KOUVTANOVITCH Corentin à Phoenixia Productions</br>
                                        Webmestre : ARRACHART Quentin à Phoenixia Productions</br>
                                        Hébergement : Rayformatics.fr
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor">
                                            Editeur de service sur le sous site
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseEditor" class="collapse" data-parent="#accordionSite">
                                    <div class="card-body">
                                        Directeur de la publication : AMAMA Kayreddine à Phoenixia Productions</br>
                                        Responsable de la rédaction : HAUTEVELLE Nathan à Phoenixia Productions</br>
                                        Graphisme : KOUVTANOVITCH Corentin à Phoenixia Productions</br>
                                        Webmestre : ARRACHART Quentin à Phoenixia Productions</br>
                                        Hébergement : Rayformatics.fr
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1>Durée de stockage de vos données</h1>
                        Si vous laissez un commentaire, le commentaire et ses métadonnées sont conservés indéfiniment. Cela permet de reconnaître et approuver automatiquement les commentaires suivants au lieu de les laisser dans la file de modération.</br>
                        Pour les utilisateurs et utilisatrices qui s’inscrivent sur notre site (si cela est possible), nous stockons également les données personnelles indiquées dans leur profil. Tous les utilisateurs et utilisatrices peuvent voir, modifier ou supprimer leurs informations personnelles à tout moment (à l’exception de leur nom d’utilisateur·ice). Les gestionnaires du site peuvent aussi voir et modifier ces informations.
                        <h1>Droits que vous avez sur vos données</h1>
                        Si vous avez un compte ou si vous avez laissé des commentaires sur le site, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Vous pouvez également demander la suppression des données personnelles vous concernant. Cela ne prend pas en compte les données stockées à des fins administratives, légales ou pour des raisons de sécurité.
                        <h1>Transmission de vos données personnelles</h1>
                        Les commentaires des visiteurs peuvent être vérifiés à l’aide d’un service automatisé de détection des commentaires indésirables.
                    </div>
                </div>
            </div>


            <div class="row"> {{-- Filth row --}}
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="img">
                        <img src="{{ asset_cache('media/favicons/favicon.png') }}">
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12">
                    <h1 class="font-weight-medium">Droits d'auteur et reproduction</h1>
                    <div class="accordion" id="accordionAuthor">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseContents" aria-expanded="false" aria-controls="collapseContents">
                                                Droits de reproduction des documents publics ou officiels
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseContents" class="collapse" data-parent="#accordionAuthor">
                                        <div class="card-body">
                                            Depuis la publication de l’ordonnance n°2005-650 du 6 juin 2005 relative à la liberté d’accès aux documents administratifs et à la réutilisation des informations publiques, ces informations peuvent être réutilisées à d’autres fins que celles pour lesquelles elles ont été produites, et particulièrement les informations faisant l’objet d’une diffusion publique.</br>
                                            Les documents publics ou officiels ne sont couverts par aucun droit d’auteur et peuvent donc être reproduits librement.</br>
                                            Le graphisme, l’iconographie ainsi que le contenu éditorial demeurent la propriété de l’État, et, à ce titre, font l’objet des protections prévues par le Code de la propriété intellectuelle.</br>
                                            Si la reprise de ces contenus de façon partielle ou intégrale est autorisée, elle doit être obligatoirement assortie de la mention du nom de l’auteur, de la source, et éventuellement d’un lien renvoyant vers le document original en ligne sur le site. La mention "© r2sources.com" devra donc être indiquée.</br>
                                            Tous les autres contenus présents sur le site sont couverts par le droit d’auteur. Toute reprise est dès lors conditionnée à l’accord de l’auteur en vertu de l’article L.122-4 du Code de la propriété intellectuelle. Les informations utilisées ne doivent l’être qu’à des fins personnelles, associatives ou professionnelles ; toute diffusion ou utilisation à des fins commerciales ou publicitaires étant interdites.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseLogo" aria-expanded="false" aria-controls="collapseLogo">
                                                Demande d'autorisation de reproduction du logo
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseLogo" class="collapse" data-parent="#accordionAuthor">
                                        <div class="card-body">
                                            Si, dans le cadre d’une communication officielle, vous avez besoin d’utiliser le logotype de l’association pour tous supports internes et externes (brochures, publications, sites…), merci d’envoyer votre demande à l’adresse suivante :</br>
                                            <blockquote>
                                                <p>
                                                    Ressources Relationnelles</br>
                                                    33 Avenue du Maréchal de Lattre de Tassigny</br>
                                                    70100 GRAY
                                                </p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseAllows" aria-expanded="false" aria-controls="collapseAllows">
                                                Demande d'autorisation de reproduction des contenus
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseAllows" class="collapse" data-parent="#accordionAuthor">
                                        <div class="card-body">
                                            Toute copie partielle ou intégrale sur support papier ou sous forme électronique de pages du site doit faire l’objet d’une déclaration auprès du webmaster.</br>
                                            Les demandes d’autorisation de reproduction d’un contenu doivent être adressées à la rédaction du site de l’association, en écrivant à :</br>
                                            <blockquote>
                                                <p>
                                                    Ressources Relationnelles</br>
                                                    33 Avenue du Maréchal de Lattre de Tassigny</br>
                                                    70100 GRAY
                                                </p>
                                            </blockquote>
                                            La demande devra préciser le contenu visé ainsi que la publication ou le site sur lequel ce dernier figurera. Une fois cette autorisation obtenue, la reproduction d’un contenu doit obéir aux principes suivants :</br>
                                            <li>gratuité de la diffusion</li>
                                            <li>respect de l’intégrité des documents reproduits (aucune modification, ni altération d’aucune sorte)</li>
                                            <li>mention obligatoire : "© r2sources.com – droits réservés" . Cette mention pointera grâce à un lien hypertexte directement sur le contenu.</li>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseImages" aria-expanded="false" aria-controls="collapseImages">
                                                Crédits photos et illustrations
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseImages" class="collapse" data-parent="#accordionAuthor">
                                        <div class="card-body">
                                            Toutes les photographies du site sont propriété de l’association ou de leurs auteurs et sont utilisées avec leur aimable autorisation. Pour les photos utilisées en page d’accueil et sur toutes les autres pages (sauf indication contraire) :.</br>
                                            © Ressources Relationnelles
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseLinks" aria-expanded="false" aria-controls="collapseLinks">
                                                Création de liens vers le site
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseLinks" class="collapse" data-parent="#accordionAuthor">
                                        <div class="card-body">
                                            Le site r2sources.com autorise sans autorisation préalable, la mise en place de liens hypertextes pointant vers ses pages, sous réserve de :</br>
                                            <li>ne pas utiliser la technique du lien profond, c’est-à-dire que les pages du site r2sources.com ne doivent pas être imbriquées à l’intérieur des pages d’un autre site, mais visibles par l’ouverture d’une fenêtre indépendante</li>
                                            <li>mentionner la source qui pointera grâce à un lien hypertexte directement sur le contenu visé</li>
                                            <li>ne pas utiliser le logotype de l’association sans autorisation</li>
                                            Les sites qui font le choix de pointer vers r2sources.com engagent leur responsabilité dès lors qu’ils porteraient atteinte à l’image du site public.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
