<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section class="testimonial" id="testimonial">
    <div class="container">
        <div class="row  mt-md-0 mt-lg-4">
            <div class="col-sm-6 text-white">
                <p class="font-weight-bold mb-3">Testimonials</p>
                <h3 class="font-weight-medium">Our customers are our <br>biggest fans</h3>
                <ul class="flipster-custom-nav">
                    <li class="flipster-custom-nav-item"><a href="javascript:;" class="flipster-custom-nav-link" title="0"></a></li>
                    <li class="flipster-custom-nav-item"><a href="javascript:;" class="flipster-custom-nav-link"  title="1"></a></li>
                    <li class="flipster-custom-nav-item"><a href="javascript:;" class="flipster-custom-nav-link active" title="2"></a></li>
                    <li class="flipster-custom-nav-item"><a href="javascript:;" class="flipster-custom-nav-link"  title="3"></a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <div id="testimonial-flipster">
                    <ul>
                        <li>
                            <div class="testimonial-item">
                                <img src="{{ asset('/media/front/testimonial/KA.jpg') }}" alt="icon" class="testimonial-icons">
                                <p>Lorem ipsum dolor sit amet, consectetur pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium</p>
                                <h6 class="testimonial-author">Kayreddine Amama</h6>
                                <p class="testimonial-destination">Chef de projet</p>
                            </div>
                        </li>
                        <li>
                            <div class="testimonial-item">
                                <img src="{{ asset('/media/front/testimonial/QA.jpg') }}" alt="icon" class="testimonial-icons">
                                <p>Lorem ipsum dolor sit amet, consecteturpretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium</p>
                                <h6 class="testimonial-author">Quentin Arrachart</h6>
                                <p class="testimonial-destination">Développeur applicatif</p>
                            </div>
                        </li>
                        <li>
                            <div class="testimonial-item">
                                <img src="{{ asset('/media/front/testimonial/NH.jpg') }}" alt="icon" class="testimonial-icons">
                                <p>Lorem ipsum dolor sit amet, consecteturpretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium</p>
                                <h6 class="testimonial-author">Nathan Hautevelle</h6>
                                <p class="testimonial-destination">Développeur web</p>
                            </div>
                        </li>
                        <li>
                            <div class="testimonial-item">
                                <img src="{{ asset('/media/front/testimonial/CK.jpg') }}" alt="icon" class="testimonial-icons">
                                <p>Lorem ipsum dolor sit amet, consecteturpretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium</p>
                                <h6 class="testimonial-author">Corentin Kouvtanovitch</h6>
                                <p class="testimonial-destination">Designer</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
