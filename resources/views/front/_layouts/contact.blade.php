<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section class="contactus" id="contact">
    <div class="container">
        <div class="row mb-5 pb-5">
            <div class="col-sm-5" >
                <img src="{{ asset('/media/front/contact.svg') }}" alt="contact" class="img-fluid">
            </div>
            <div class="col-sm-7" >
                <h3>Des questions ?</h3>
                <h6 class="mb-5 text-dark">N'hesitez pas a nous en faire part, ecrivez-nous !</h6>
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="Nom*">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="mail" placeholder="Email*">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" placeholder="Message*" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-md btn-block btn-outline-special btn-lg border-0">Envoyer</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>