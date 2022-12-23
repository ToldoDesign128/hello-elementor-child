<!-- Questa sezione gestisce i contenuti del footer che sono gestiti tramite widget in maniera dinamica,
 il file di registrazione dei widget si trova in assets/function-parts/theme/footer-functions-widget.php -->

<footer>
    <div class="container">
        <div class="mb-5">
            <!-- Sitemap -->
            <aside class="mb-5">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'prima-footer-widget-area' ); ?>
                    </div>
                
                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'seconda-footer-widget-area' ); ?>
                    </div>
                
                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'terza-footer-widget-area' ); ?>
                    </div>
                </div>
                <div class="row justify-content-between mt-md-5 mt-0">            
                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'quarta-footer-widget-area' ); ?>
                    </div>

                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'quinta-footer-widget-area' ); ?>
                    </div>

                    <div class="col-12 col-md-3 mt-2 footer-menu-list">
                        <?php dynamic_sidebar( 'sesta-footer-widget-area' ); ?>
                    </div>
                </div>
            </aside>
        </div>
        <!-- Informazioni -->
        <section class="footer-info">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-md-5 d-flex justify-content-between mb-4 mb-md-0"> <!-- Logo -->
                    <svg width="42" height="22" viewBox="0 0 42 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1.78835V3.57662H5.3741H10.7482L10.7287 1.80703L10.7093 0.0374352L5.35464 0.0187532L0 0V1.78835ZM31.5262 4.54614L27.0044 9.09133L27.0543 10.8881L27.1043 12.6849L31.5776 17.1804L36.0509 21.6759L38.5397 21.6566L41.0285 21.6374L35.6898 16.2739C32.7535 13.324 30.3507 10.8805 30.3501 10.8439C30.3495 10.8073 32.6991 8.41531 35.5714 5.52828C38.4438 2.64133 40.8503 0.216585 40.9192 0.140109C41.0422 0.00350368 40.9992 0.000948684 38.5463 0.000948684H36.0481L31.5262 4.54614ZM0 10.8374V12.6253H5.37279H10.7456V10.8374V9.04959H5.37279H0V10.8374ZM14.4484 10.8292V12.6183L17.0078 12.64C19.4856 12.6611 19.5803 12.6671 19.9811 12.8299C20.7508 13.1424 21.3902 13.873 21.6055 14.6857C21.9856 16.1208 21.1121 17.6055 19.6589 17.9943C19.368 18.0721 18.7004 18.0967 16.8626 18.0974L14.4484 18.0982V19.8921V21.686L17.2256 21.6544C20.2043 21.6205 20.4022 21.5988 21.3381 21.2029C23.0554 20.4765 24.3281 19.1145 24.8974 17.3941C25.4632 15.6841 25.3489 14.1333 24.5369 12.5026C23.7527 10.9278 22.294 9.75108 20.511 9.25523C19.9686 9.1044 19.7485 9.09192 17.1893 9.06689L14.4484 9.04011V10.8292Z" fill="white"/>
                    </svg>
                    <p> FBK | FONDAZIONE BRUNO KESSLER  © 2022 </p>
                </div>
                <div class="col-8 col-md-3 d-flex justify-content-between"> <!-- Social -->
                    <a href="#"> <img src=" <?php echo get_stylesheet_directory_uri() . '/assets/image/icon/FB.png';?>" alt="Logo facebook"> </a>
                    <a href="#"> <img src=" <?php echo get_stylesheet_directory_uri() . '/assets/image/icon/IG.png';?>" alt="Logo Instagram"> </a>
                    <a href="#"> <img src=" <?php echo get_stylesheet_directory_uri() . '/assets/image/icon/IN.png';?>" alt="Logo Linkedin"> </a>
                    <a href="#"> <img src=" <?php echo get_stylesheet_directory_uri() . '/assets/image/icon/TW.png';?>" alt="Logo Twitter"> </a>
                    <a href="#"> <img src=" <?php echo get_stylesheet_directory_uri() . '/assets/image/icon/YT.png';?>" alt="Logo Youtube"> </a>
                </div>
                <div class="col-4 col-md-3 lingua"> 
                    <p>ITA</p>
                </div>
            </div>
        </section>
    </div>
         
</footer>
