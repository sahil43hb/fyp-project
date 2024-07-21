    <!-- start footer Area -->
    <footer class="footer-area">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p style="color: #fff; opacity: 0.9">
                            FootStep has been working in market since last 35 years.We are serving people with the
                            best quality fine shoes.Today FootStep has its own 2 branches.We believe in customer
                            satisfaction and provide our customers the best of best .
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p style="color: #fff; opacity: 0.9">Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">
                            <form action="{{ url('new_settler') }}" method="post" class="form-inline">
                                @csrf
                                <div class="d-flex flex-row">
                                    <input class="form-control" name="email" placeholder="Enter Email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                        required type="email" />
                                    <button type="submit" class="click-btn btn btn-default " style="border:1px solid #fff">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{ asset('img/i2.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i3.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i4.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i5.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i6.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i7.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i8.jpg') }}" alt="" /></li>
                            <li><img src="{{ asset('img/i1.jpg') }}" alt="" /></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p style="color: #fff; opacity: 0.9">Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#" target="_blank"><i class="fa fa-instagram" ></i></a>
                            <a href="#"
                                target="_blank"><i class="fa fa-facebook" ></i></a>
                            <a href="#"
                                target="_blank"><i class="fa fa-youtube" ></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap" style="background-color: #000">
            <p class="footer-text m-0 " >
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright
                <i>©</i> 2024
                <a href="#">DAAZ.</a>
                All rights reserved.
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div> 
    </footer>
    <!-- End footer Area -->
