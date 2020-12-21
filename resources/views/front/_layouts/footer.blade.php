<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <address>
                        <p>91 Grande Rue,</p>
                        <p class="mb-4">70100 GRAY</p>
                        <div class="d-flex align-items-center">
                            <p class="mr-4 mb-0">+33 642 780 170</p>
                            <a href="#" class="footer-link">info@yourmail.com</a>
                        </div>
                    </address>
                    <div class="social-icons">
                        <h6 class="footer-title font-weight-bold">Partagez sur les reseaux</h6>
                        <div class="d-flex">
                            <a href="#"><i class="fab fa-github"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-google "></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="footer-title">Navigation</h6>
                            <ul class="list-footer">
                                <li><a href="/" class="footer-link">Accueil</a></li>
                                <li><a href="#" class="footer-link">Contact</a></li>
                                <li><a href="{{ route('register') }}" class="footer-link">S'inscrire</a></li>
                                <li><a href="{{ route('login') }}" class="footer-link">Se connecter</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="footer-title">Services</h6>
                            <ul class="list-footer">
                                <li><a href="#" class="footer-link">Mon profil</a></li>
                                <li><a href="#" class="footer-link">Mes amis</a></li>
                                <li><a href="#" class="footer-link">Mes ressources</a></li>
                                <li><a href="#" class="footer-link">Recherche</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="footer-title">L'aventure</h6>
                            <ul class="list-footer">
                                <li><a href="#" class="footer-link">A propos</a></li>
                                <li><a href="#" class="footer-link">Confidentialite</a></li>
                                <li><a href="#" class="footer-link">Support</a></li>
                                <li><a href="#" class="footer-link">Jobs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <p class="mb-0 text-small pt-1">© 2020 <a href="https://phoenixia-prods.com" class="text-white" target="_blank">Phoenixia Productions</a>. Tous droits reserves.</p>
                </div>
                <div>
                    <div class="d-flex">
                        <a href="#" class="text-small text-white mx-2 footer-link">Confidentialite </a>
                        <a href="#" class="text-small text-white mx-2 footer-link">Support </a>
                        <a href="#" class="text-small text-white mx-2 footer-link">Jobs </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
