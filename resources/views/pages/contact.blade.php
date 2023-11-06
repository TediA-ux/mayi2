@include('layouts.newheader')
<body id="page-top" class="sub-page">
    <div class="wrap-body">
    
<header>
    <div class="wrap-header" >
        
        <!---Main Header--->
        <div class="main-header">
            <div class="bg-overlay">
                <!---Hero Content--->
                <div class="hero-content-wrapper">
                  <div class="hero-content">
                    <h4 class="h-alt hero-subheading wow fadeIn" data-wow-duration="2s" data-wow-delay=".7s">Leave us a message</h4>
                    <h1 class="hero-lead wow fadeInLeft" data-wow-duration="1.5s">Contact us</h1>
                  </div>
                </div>
            </div>
        </div>
        
        <!---Top Menu--->
        <div id="cssmenu" >
            <ul>
               <li class="active"><a href="/"><span>Home</span></a></li>
               {{-- <li class="has-sub"><a href="#"><span>Category</span></a>
                  <ul>
                     <li class="has-sub"><a href="#"><span>Item 1</span></a>
                        <ul>
                           <li><a href="#"><span>Sub Item</span></a></li>
                           <li class="last"><a href="#"><span>Sub Item</span></a></li>
                        </ul>
                     </li>
                     <li class="has-sub"><a href="#"><span>Item 2</span></a>
                        <ul>
                           <li><a href="#"><span>Sub Item</span></a></li>
                           <li class="last"><a href="#"><span>Sub Item</span></a></li>
                        </ul>
                     </li>
                  </ul>
               </li> --}}
               <li><a href="/archive"><span>Archive</span></a></li>
               <li><a href="/about"><span>About</span></a></li>
               <li class="last"><a href="/contact"><span>Contact</span></a></li>
            </ul>
        </div>
        
    </div>
</header>

<section id="page-content">
    <div class="wrap-container zerogrid">
        <div class="crumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">Contact</a></li>
            </ul>
        </div>
        <div id="contact-area">
            <h1 class="">Contact Us</h1>
            <div class="contact-map_wrapper wow fadeIn" data-wow-delay=".1s" data-wow-duration="1.5s">
                <!-- Map -->
                <div id="map" style="height: 550px;"></div>

                <!-- Show Info Button -->
                <div class="show-info-link">
                  <a href="#" class="show-info"><i class="fa fa-info"></i>Show info</a>
                </div>
                <div class="zerogrid">
                    <!-- Address Info -->
                    <div class="xs-5-6 offset-md-1-6 md-1-2 contact-info-wrapper">
                        <address>
                            <div class="row">
                              <!-- Phone -->
                              <div class="sm-1-2 address-group">
                                <span>Phone</span>
                                <a href="#">+ 123 4567 890</a>
                                <a href="#">+ 123 7654 098</a>
                              </div>
                              <!-- Address -->
                              <div class="sm-1-2 address-group">
                                <span>Address</span>
                                <p>1200 some street, il, US</p>
                              </div>
                            </div>
                            <div class="row">
                              <!-- Email -->
                              <div class="sm-1-2 address-group">
                                <span>Email</span>
                                <a href="mailto:sayhello@email.com">sayhello@email.com</a>
                              </div>
                              <!-- Hours -->
                              <div class="sm-1-2 address-group">
                                <span>Open Hours</span>
                                <p>Mon-Fri: 9am-5pm</p>
                                <p>Sat: 10am-1pm</p>
                              </div>
                            </div>
                            <!-- Show Map Button -->
                            <div class="row show-map-link">
                              <a href="#" class="show-map"><i class="fa fa-map-o"></i> Show on map</a>
                            </div>
                        </address>
                    </div>
                </div>
            </div>
            <div class="contact-main_wrapper">
                <div class="row">
                    <div class="sm-2-5 ">
                        <div class="wrap-col">
                            <div class="wow fadeInLeft" data-wow-delay=".1s" data-wow-duration="1s">
                                <h3>Have any questions? Let's get in touch!</h3>
                                <p>Contact us if your are thinking of redesigning your garden, adding some garden features or simply looking for a bit of garden maintenance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="sm-2-5 offset-sm-1-5">
                        <div class="wrap-col">
                            <div id="contact_form" class="wow fadeInUp" data-wow-delay=".1s" data-wow-duration="1s">
                                <div id="contact_results"></div>
                                <div id="contact_body">
                                    <label>
                                        <input type="text" name="name" id="name" required="true" placeholder="Your Name"/>
                                    </label>
                                    <label>
                                        <input type="email" name="email" required="true" placeholder="Your Email"/>
                                    </label>
                                    <label for="field5">
                                        <textarea name="message" id="message" class="textarea-field" required="true" placeholder="Message"></textarea>
                                    </label>
                                    <label>
                                        <button class="button button-skin" type="submit" id="submit_btn">Submit</button>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.newfooter')
