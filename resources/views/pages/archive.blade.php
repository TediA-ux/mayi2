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
                    <h4 class="h-alt hero-subheading wow fadeIn" data-wow-duration="2s" data-wow-delay=".7s">CBO's Posts</h4>
                    <h1 class="hero-lead wow fadeInLeft" data-wow-duration="1.5s">CBO</h1>
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
                <li><a href="/about">About</a></li>
            </ul>
        </div>
        <div id="archive-post" class="sm-2-3 offset-sm-1-6">
            <div class="wrap-col">
                <article class="post-entry archive-post wow fadeInLeft" data-wow-delay=".1s" data-wow-duration="1s">
                    <div class="wrap-post">
                        <div class="entry-header">
                            <h2 class="entry-title"><a href="/about">Lorem ipsum dolor sit amet, consectetur adipisicing</a></h2>
                            <div class="entry-meta">
                                <a href="#"><i class="fa fa-calendar"></i> August 10, 2016</a>
                                <a href="#"><i class="fa fa-comments"></i> 1 Comment</a>
                                <a href="#"><i class="fa fa-tag"></i> Event, New</a>
                            </div>
                        </div>
                        <div class="post-thumbnail-wrap">
                            <img src="images/9.jpg" />
                        </div>
                        <div class="entry-content">
                            <p>New advanced technologies in the industry   Thousands of people dream of having their own business and even more so be a successful entrepreneur. But what does it take to achieve success in the business industry? One of the most successful entrepreneurs featured at the Forbes website, Wendy Lipton – Dibner said:   “The success</p>
                            <a href="/about" class="button button-skin">Read More</a>
                        </div>
                    </div>
                </article>
                <article class="post-entry archive-post wow fadeInRight" data-wow-delay=".1s" data-wow-duration="1s">
                    <div class="wrap-post">
                        <div class="entry-header">
                            <h2 class="entry-title"><a href="/about">Lorem ipsum dolor sit amet, consectetur adipisicing</a></h2>
                            <div class="entry-meta">
                                <a href="#"><i class="fa fa-calendar"></i> August 10, 2016</a>
                                <a href="#"><i class="fa fa-comments"></i> 1 Comment</a>
                                <a href="#"><i class="fa fa-tag"></i> Event, New</a>
                            </div>
                        </div>
                        <div class="post-thumbnail-wrap">
                            <img src="images/10.jpg" />
                        </div>
                        <div class="entry-content">
                            <p>New advanced technologies in the industry   Thousands of people dream of having their own business and even more so be a successful entrepreneur. But what does it take to achieve success in the business industry? One of the most successful entrepreneurs featured at the Forbes website, Wendy Lipton – Dibner said:   “The success</p>
                            <a href="/about" class="button button-skin">Read More</a>
                        </div>
                    </div>
                </article>
                <article class="post-entry archive-post wow fadeInLeft" data-wow-delay=".1s" data-wow-duration="1s">
                    <div class="wrap-post">
                        <div class="entry-header">
                            <h2 class="entry-title"><a href="/about">Lorem ipsum dolor sit amet, consectetur adipisicing</a></h2>
                            <div class="entry-meta">
                                <a href="#"><i class="fa fa-calendar"></i> August 10, 2016</a>
                                <a href="#"><i class="fa fa-comments"></i> 1 Comment</a>
                                <a href="#"><i class="fa fa-tag"></i> Event, New</a>
                            </div>
                        </div>
                        <div class="post-thumbnail-wrap">
                            <img src="images/11.jpg" />
                        </div>
                        <div class="entry-content">
                            <p>New advanced technologies in the industry   Thousands of people dream of having their own business and even more so be a successful entrepreneur. But what does it take to achieve success in the business industry? One of the most successful entrepreneurs featured at the Forbes website, Wendy Lipton – Dibner said:   “The success</p>
                            <a href="/about" class="button button-skin">Read More</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

@include('layouts.newfooter')
