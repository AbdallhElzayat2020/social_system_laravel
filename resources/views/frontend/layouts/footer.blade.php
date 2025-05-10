<!-- Footer Start -->
<div class="footer" id="subscribers">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">{{$getSetting->site_name}}</h3>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i>{{$getSetting->street}} , {{$getSetting->city}} , {{$getSetting->country}}</p>
                        <p><i class="fa fa-envelope"></i>{{$getSetting->site_email}}</p>
                        <p><i class="fa fa-phone"></i>{{$getSetting->site_phone}}</p>
                        <div class="social">
                            <a target="_blank" href="{{$getSetting->twitter_link}}" title="twitter"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="{{$getSetting->facebook_link}}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="{{$getSetting->linkedin_link}}" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a target="_blank" href="{{$getSetting->instagram_link}}" title="instagram"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="{{$getSetting->youtube_link}}" title="youtube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Useful Links</h3>
                    <ul>
                        @foreach($relatedSites as $link)
                            <li><a target="_blank" title="{{$link->name}}" href="{{$link->url}}">{{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Quick Links</h3>
                    <ul>
                        <li><a href="#">Lorem ipsum</a></li>
                        <li><a href="#">Pellentesque</a></li>
                        <li><a href="#">Aenean vulputate</a></li>
                        <li><a href="#">Vestibulum sit amet</a></li>
                        <li><a href="#">Nam dignissim</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Newsletter</h3>
                    <div class="newsletter">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Vivamus sed porta dui. Class aptent taciti sociosqu
                        </p>
                        <form action="{{ route('frontend.news.subscribers') }}" method="post">
                            @csrf
                            <input class="form-control" type="email" name="email" required placeholder="Your email here"/>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <button class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer Menu Start -->
<div class="footer-menu">
    <div class="container">
        <div class="f-menu">
            <a href="">Terms of use</a>
            <a href="">Privacy policy</a>
            <a href="">Cookies</a>
            <a href="">Accessibility help</a>
            <a href="">Advertise with us</a>
            <a href="">Contact us</a>
        </div>
    </div>
</div>
<!-- Footer Menu End -->

<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>
                    Copyright &copy; <a href="">{{config('app.name')}}</a>. All Rights
                    Reserved
                </p>
            </div>

            <div class="col-md-6 template-by">
                <p>Designed By <a target="_blank" href="https://abdallh-elzayat.me/">Abdallh Elzayat</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->