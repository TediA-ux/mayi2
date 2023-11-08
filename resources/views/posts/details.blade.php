<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="canonical" href="">
    <meta name="robots" content="all">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>Qatalyst Ventures</title>
    <meta name="description" content="">
    <link rel="manifest" href="site.webmanifest">
    <meta name="msapplication-TileColor" content="#0F1624">
    <meta name="theme-color" content="#0F1624">
    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="shortcut icon" href="/fav/favicon.png">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>

<body>
    <nav class="site-nav">
        <div class="container">
            <a href="{{ url('/') }}" class="site-nav-logo">
                <img src="/img/qv-logo-c.svg" alt="">
            </a>
            <div class="site-nav-menu d-none d-md-block">
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">Investors</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('/for/investment/opportunities') }}">Investment Opportunities</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-invest-returns.html">Investor Returns</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-invest-how.html">Due Diligence Charter</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-invest-how.html">Funded Companies</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-invest-how.html">Help Centre</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">Businesses</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('/for/businesses') }}">Seed Funding</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Early Funding</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Growth Funding</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-community.html">Funded Community</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-how.html">Knowledge Hub</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-how.html">Refer a business</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-how.html">Help centre</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-how.html">Secondary Share Sale</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">About Us</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="p-about.html">About</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Careers</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Partner with Us</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-community.html">News</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-how.html">Press</a>
                            </li>                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">Legal</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="p-about.html">Risk Warning</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Terms of Use</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-early.html">Privacy policy</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="p-business-community.html">Contact Us</a>
                            </li>
</ul>
                    </li>

                </ul>
            </div>
            <div class="site-nav-btns d-none d-md-block">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link border btn" href="{{ url('/login/qatalyst') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary" href="{{ url('/user/join') }}">Join</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="site-nav-large">
        <div class="container"></div>
    </nav>
    <main>
        <section class="site-hero site-sec">
            <div class="container">
                <div class="txt">
                    <h1><?php echo $post->title ;?></h1>
                </div>
            </div>
        </section>
        <section class="area-investment site-sec">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-3">
                        <div class="sec-pic">
                            <img src="/img/qv-logo-c.svg" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="sec-snapshot">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="txt">
                                <span class="amount"><b>$300,000</b> Goal</span>
                                <span class="time">23 Days Left</span>
                                <span><b>$231,000</b> raised</span>
                                <span><b>102</b> investors</span>
                                <a href="{{ url ('/make/your/investment') }}" class="btn btn-secondary">Make your Investment</a>

                            </div>
                            <div class="type">
                                <h5>Convertible</h5>
                                <p>Rather than investing and immediately receiving shares, in this round payments will
                                    be transferred directly to the company and shares issued at a future date. A
                                    convertible allows a company to raise funds without having to agree a valuation.</p>
                            </div>
                            <div class="info">
                                <ul>
                                    <li>
                                        <a href="">mail@mail.com</a>
                                    </li>
                                    <li>
                                        <a href="">website.com</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="social">
                                <ul>
                                    <li>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="sec-details">
                            <h4>Business Details</h4>
                            <p>Est, exercitationem repellat. Ad obcaecati, nam laudantium quibusdam et quaerat, dolore voluptate, nostrum inventore accusantium molestiae minima corrupti corporis nesciunt tempora. Ullam.</p>
                            <p>Harum maiores mollitia aut quisquam itaque in quae corrupti soluta incidunt, magnam consectetur voluptate deleniti hic! Saepe veniam dolorem magni quisquam dolore!</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="sec-disclaimer">
                            <h4>Platform Info on Business</h4>
                            <p>Quibusdam culpa ut numquam tenetur ad modi magni dolore facilis. Expedita suscipit saepe voluptatibus odit esse a laborum iure cumque necessitatibus numquam?</p>
                            <p>Debitis placeat commodi harum, odio nobis optio quam explicabo maiores facere sapiente, aliquam ut officia cum voluptates architecto temporibus molestiae praesentium quidem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="site-footer site-sec">
            <div class="container">
                <div class="row g-5">
                    <div class="col-12">
                        <div class="top">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <ul>
                                        <li>
                                            <a href="p-invest-listing.html">Investment Opportunities</a>
                                        </li>
                                        <li>
                                            <a href="p-invest-returns.html">Investor Returns</a>
                                        </li>
                                        <li>
                                            <a href="p-invest-how.html">How it works</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul>
                                        <li>
                                            <a href="p-business-seed.html">Seed Funding</a>
                                        </li>
                                        <li>
                                            <a href="p-business-early.html">Early Funding</a>
                                        </li>
                                        <li>
                                            <a href="p-business-community.html">Funded Community</a>
                                        </li>
                                        <li>
                                            <a href="p-business-how.html">Knowledge Hub</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul>
                                        <li>
                                            <a href="p-about.html">About Us</a>
                                        </li>
                                        <li>
                                            <a href="p-careers.html">Careers</a>
                                        </li>
                                        <li>
                                            <a href="p-partners.html">Partnerships</a>
                                        </li>
                                        <li>
                                            <a href="p-press.html">Press</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul>
                                        <li>
                                            <a href="p-faqs.html">FAQs</a>
                                        </li>
                                        <li>
                                            <a href="p-contact.html">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="p-terms.html">Terms</a>
                                        </li>
                                        <li>
                                            <a href="p-privacy.html">Privacy</a>
                                        </li>
                                        <li>
                                            <a href="p-disclosures.html">Disclosures</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="social">
                            <ul>
                                <li>
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                            <path
                                                d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                            <path
                                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                            <path
                                                d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mid border-top pt-3">
                            <h6>Disclaimer</h6>
                            <p>Eligendi ut ratione suscipit molestiae aliquid magni, provident quibusdam officiis,
                                excepturi animi aspernatur sint voluptas, culpa possimus? Saepe exercitationem placeat
                                dolorem sapiente.</p>
                            <p>Perferendis ipsam distinctio itaque sapiente non commodi aliquam libero voluptatum earum
                                voluptas, molestiae totam tempora illo beatae enim explicabo!</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bottom d-flex justify-content-between align-items-center gap-5 border-top pt-3">
                            <span class="copyright">© Qatalyst Ventures</span>
                            <span class="btn btn-top">to top</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <script src="js/cdn.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>