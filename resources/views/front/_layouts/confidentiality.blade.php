@extends('front._layouts.app')

@section('title', 'Confidentialité')

@section('content')
    <div class="confidentiality">
        <div class="container text-justify">
            <h1 class="h1-green font-weight-medium text-center">Confidentialité, termes et conditions</h1>
            <div class="row"> {{-- First row --}}
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="img">
                        <img src="{{ asset_cache('media/favicons/favicon.png') }}">
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <h3 class="font-weight-medium mb-4">Qui sommes-nous ?</h3>
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
                    <h3 class="font-weight-medium mb-4">Règles d'usage</h3>
                    <p>
                        L’utilisateur reconnait avoir pris connaissance des présentes conditions d’utilisation et s’engage à les respecter. L’utilisateur du site web reconnaît disposer de la compétence et des moyens nécessaires pour accéder à ce site et l’utiliser.</br>
                        L’internaute s’engage à ne pas effectuer d’opérations pouvant nuire au bon fonctionnement du site, à l’intégrité des informations diffusées, et à l’image de Ressources Relationnelles.</br>
                        Il s’engage également à exercer une vigilance toute particulière dans l’utilisation des éléments qui lui sont mis à disposition et à observer toutes les précautions d’usage.
                    </p>
                    <h3 class="font-weight-medium mb-4">Responsabilités de Ressources Relationnelles</h3>
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
                    <h3 class="font-weight-medium mb-4">Données à caractère personnel</h3>
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
                                            Le site {{url('/')}} respecte la vie privée de l’internaute et se conforme strictement aux lois en vigueur sur la protection de la vie privée et des libertés individuelles. Aucune information personnelle n’est collectée à votre insu. Aucune information personnelle n’est cédée à des tiers.</br>
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
                                            La politique du site {{url('/')}} est en conformité avec la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l’économie numérique.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                                                Commentaires
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseComments" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Quand vous laissez un commentaire sur notre site web, les données inscrites dans le formulaire de commentaire, mais aussi votre adresse IP et l’agent utilisateur de votre navigateur sont collectés pour nous aider à la détection des commentaires indésirables.</br>
                                            Après validation de votre commentaire, vos initiales seront visibles publiquement à coté de votre commentaire.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseMedias" aria-expanded="false" aria-controls="collapseMedias">
                                                Médias
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseMedias" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Si vous êtes un utilisateur ou une utilisatrice enregistré·e et que vous téléversez des images sur le site web, nous vous conseillons d’éviter de téléverser des images contenant des données EXIF de coordonnées GPS.</br>
                                            Les visiteurs de votre site web peuvent télécharger et extraire des données de localisation depuis ces images.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseCookies" aria-expanded="false" aria-controls="collapseCookies">
                                                Cookies
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseCookies" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Un cookie est un fichier texte déposé sur votre ordinateur lors de la visite d’un site ou de la consultation d’une publicité. Il a pour but de collecter des informations relatives à votre navigation et de vous adresser des services adaptés à votre terminal (ordinateur, mobile ou tablette). Les cookies sont gérés par votre navigateur internet.</br>
                                            Nous veillons dans la mesure du possible à ce que les prestataires de mesures d’audience respectent strictement la loi informatique et libertés du 6 janvier 1978 modifiée et s’engagent à mettre en œuvre des mesures appropriées de sécurisation et de protection de la confidentialité des données.</br>
                                            Si vous déposez un commentaire sur notre site, il vous sera proposé d’enregistrer votre nom, adresse de messagerie et site web dans des cookies. C’est uniquement pour votre confort afin de ne pas avoir à saisir ces informations si vous déposez un autre commentaire plus tard. Ces cookies expirent au bout d’un an.</br>
                                            Si vous vous rendez sur la page de connexion, un cookie temporaire sera créé afin de déterminer si votre navigateur accepte les cookies. Il ne contient pas de données personnelles et sera supprimé automatiquement à la fermeture de votre navigateur.</br>
                                            Lorsque vous vous connecterez, nous mettrons en place un certain nombre de cookies pour enregistrer vos informations de connexion et vos préférences d’écran. La durée de vie d’un cookie de connexion est de deux jours, celle d’un cookie d’option d’écran est d’un an. Si vous cochez « Se souvenir de moi », votre cookie de connexion sera conservé pendant deux semaines. Si vous vous déconnectez de votre compte, le cookie de connexion sera effacé.</br>
                                            En modifiant ou en publiant une publication, un cookie supplémentaire sera enregistré dans votre navigateur. Ce cookie ne comprend aucune donnée personnelle. Il indique simplement l’ID de la publication que vous venez de modifier. Il expire au bout d’un jour.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseEmbedded" aria-expanded="false" aria-controls="collapseEmbedded">
                                                Contenu embarqué
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseEmbedded" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Les articles de ce site peuvent inclure des contenus intégrés (par exemple des vidéos, images, articles…). Le contenu intégré depuis d’autres sites se comporte de la même manière que si le visiteur se rendait sur cet autre site.</br>
                                            Ces sites web pourraient collecter des données sur vous, utiliser des cookies, embarquer des outils de suivis tiers, suivre vos interactions avec ces contenus embarqués si vous disposez d’un compte connecté sur leur site web.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseBrowser" aria-expanded="false" aria-controls="collapseBrowser">
                                                Paramétrer son navigateur
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseBrowser" class="collapse" data-parent="#accordionRGPD">
                                        <div class="card-body">
                                            Vous pouvez à tout moment de choisir de désactiver les ces cookies. Votre navigateur peut également être paramétré pour vous signaler les cookies qui sont déposés dans votre ordinateur et vous demander de les accepter ou pas. Vous pouvez accepter ou refuser les cookies au cas par cas ou bien les refuser systématiquement.</br>
                                            En cas de refus de dépôt de cookie, vous ne pouvez pas consulter le site {{url('/')}}. Afin de gérer les cookies au plus près de vos attentes nous vous invitons à paramétrer votre navigateur en tenant compte de la finalité des cookies.
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
                            <h3 class="font-weight-medium mb-4">Durée de stockage de vos données</h3>
                            Si vous laissez un commentaire, le commentaire et ses métadonnées sont conservés indéfiniment. Cela permet de reconnaître et approuver automatiquement les commentaires suivants au lieu de les laisser dans la file de modération.</br>
                            Pour les utilisateurs et utilisatrices qui s’inscrivent sur notre site (si cela est possible), nous stockons également les données personnelles indiquées dans leur profil. Tous les utilisateurs et utilisatrices peuvent voir, modifier ou supprimer leurs informations personnelles à tout moment (à l’exception de leur nom d’utilisateur·ice). Les gestionnaires du site peuvent aussi voir et modifier ces informations.
                            <h3 class="font-weight-medium mb-4">Droits que vous avez sur vos données</h3>
                            Si vous avez un compte ou si vous avez laissé des commentaires sur le site, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Vous pouvez également demander la suppression des données personnelles vous concernant. Cela ne prend pas en compte les données stockées à des fins administratives, légales ou pour des raisons de sécurité.
                            <h3 class="font-weight-medium mb-4">Transmission de vos données personnelles</h3>
                            Les commentaires des visiteurs peuvent être vérifiés à l’aide d’un service automatisé de détection des commentaires indésirables.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> {{-- Filth row --}}
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="flip-card-container">
                        <div class="flip-card">
                            <div class="card-front">
                                <figure>
                                    <div class="img-bg"></div>
                                    <img src="https://phoenixia-prods.com/wp-content/uploads/2020/12/1.jpg" alt="Rayformatics">
                                    <figcaption>Hébergeur</figcaption>
                                </figure>
                                <ul>
                                    <li><h5>RAYFORMATICS</h5></li>
                                    <li>91 Grande Rue</li>
                                    <li>70100 GRAY</li>
                                    <li>rayformatics.fr</li>
                                </ul>
                            </div>
                            <div class="card-back">
                                <figure>
                                    <div class="img-bg"></div>
                                    <img src="https://phoenixia-prods.com/wp-content/uploads/2020/12/1.jpg" alt="Rayformatics">
                                </figure>
                                <a target="_blank" class="btn btn-md btn-outline-special btn-lg" href="http://rayformatics.fr">Site web</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12">
                    <h3 class="font-weight-medium mb-4">Droits d'auteur et reproduction</h3>
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
                                            Si la reprise de ces contenus de façon partielle ou intégrale est autorisée, elle doit être obligatoirement assortie de la mention du nom de l’auteur, de la source, et éventuellement d’un lien renvoyant vers le document original en ligne sur le site. La mention "© {{url('/')}}" devra donc être indiquée.</br>
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
                                            <li>mention obligatoire : "© {{url('/')}} – droits réservés" . Cette mention pointera grâce à un lien hypertexte directement sur le contenu.</li>
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
                                            Le site {{url('/')}} autorise sans autorisation préalable, la mise en place de liens hypertextes pointant vers ses pages, sous réserve de :</br>
                                            <li>ne pas utiliser la technique du lien profond, c’est-à-dire que les pages du site {{url('/')}} ne doivent pas être imbriquées à l’intérieur des pages d’un autre site, mais visibles par l’ouverture d’une fenêtre indépendante</li>
                                            <li>mentionner la source qui pointera grâce à un lien hypertexte directement sur le contenu visé</li>
                                            <li>ne pas utiliser le logotype de l’association sans autorisation</li>
                                            Les sites qui font le choix de pointer vers {{url('/')}} engagent leur responsabilité dès lors qu’ils porteraient atteinte à l’image du site public.
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
