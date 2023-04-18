<header class="header__nav">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="header__content">

               <a class="header__content__logo" href="<?php echo get_home_url(); ?>">
                  <svg width="49" height="38" viewBox="0 0 49 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M0.00390625 37.8841H1.38022V34.9319H4.13284V37.8841H5.50915V31.15H4.13284V33.8706H1.38022V31.15H0.00390625V37.8841Z" fill="white" />
                     <path d="M8.7305 34.4977C8.7305 36.5623 9.89054 37.9998 12.0926 37.9998C14.2652 37.9998 15.4548 36.5334 15.4548 34.4977C15.4548 32.462 14.2456 31.0342 12.0926 31.0342C9.9102 31.0342 8.7305 32.4331 8.7305 34.4977ZM10.1658 34.4977C10.1658 33.311 10.7262 32.0954 12.0926 32.0954C13.4591 32.0954 14.0195 33.311 14.0195 34.4977C14.0195 35.7133 13.4984 36.9386 12.0926 36.9386C10.6868 36.9386 10.1658 35.7133 10.1658 34.4977Z" fill="white" />
                     <path d="M19.8031 37.8841H21.5825L22.8015 32.5006H22.8212L24.0599 37.8841H25.8294L27.6186 31.15H26.2816L24.9938 36.5334H24.9741L23.7649 31.15H21.8971L20.7272 36.5334H20.7076L19.4296 31.15H17.9844L19.8031 37.8841Z" fill="white" />
                     <path d="M36.4301 37.8841H37.8065V32.2112H39.7726V31.15H34.464V32.2112H36.4301V37.8841Z" fill="white" />
                     <path d="M42.2762 34.4977C42.2762 36.5623 43.4362 37.9998 45.6383 37.9998C47.8109 37.9998 49.0004 36.5334 49.0004 34.4977C49.0004 32.462 47.7912 31.0342 45.6383 31.0342C43.4559 31.0342 42.2762 32.4331 42.2762 34.4977ZM43.7115 34.4977C43.7115 33.311 44.2718 32.0954 45.6383 32.0954C47.0048 32.0954 47.5651 33.311 47.5651 34.4977C47.5651 35.7133 47.0441 36.9386 45.6383 36.9386C44.2325 36.9386 43.7115 35.7133 43.7115 34.4977Z" fill="white" />
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.13581V4.27153H6.41824H12.8365L12.8132 2.15812L12.79 0.0447085L6.395 0.0223968L0 0V2.13581ZM37.6515 5.42942L32.2511 10.8577L32.3107 13.0035L32.3705 15.1495L37.7129 20.5184L43.0553 25.8873L46.0277 25.8643L49 25.8414L42.6241 19.4358C39.1173 15.9127 36.2475 12.9945 36.2469 12.9508C36.2462 12.9071 39.0522 10.0503 42.4826 6.60238C45.9131 3.15452 48.7871 0.258665 48.8694 0.167331C49.0164 0.00418442 48.965 0.00113301 46.0355 0.00113301H43.0519L37.6515 5.42942ZM0 12.9431V15.0783H6.41668H12.8334V12.9431V10.8079H6.41668H0V12.9431ZM17.2557 12.9332V15.07L20.3122 15.0959C23.2715 15.121 23.3846 15.1282 23.8633 15.3226C24.7825 15.6959 25.5462 16.5684 25.8033 17.539C26.2572 19.253 25.214 21.026 23.4784 21.4904C23.131 21.5834 22.3338 21.6127 20.1388 21.6135L17.2557 21.6146V23.7569V25.8993L20.5724 25.8616C24.1298 25.8212 24.3662 25.7953 25.4839 25.3224C27.5348 24.4549 29.0549 22.8282 29.7347 20.7737C30.4105 18.7314 30.274 16.8792 29.3042 14.9317C28.3676 13.0509 26.6255 11.6456 24.4961 11.0534C23.8484 10.8733 23.5854 10.8584 20.529 10.8285L17.2557 10.7965V12.9332Z" fill="white" />
                  </svg>
               </a>

               <nav class="header__content__nav d-none d-xl-flex" role="navigation">
                  <?php $header_menu_items = NP_get_menu_by_slug('header', false);
                  $header_children = array();
                  foreach ($header_menu_items as $menu_item) :
                     $menu_item_parent = $menu_item->menu_item_parent;
                     if ($menu_item_parent != 0) :
                        $header_children[] = $menu_item;
                     endif;
                  endforeach;

                  foreach ($header_menu_items as $menu_item) :
                     $menu_item_parent = $menu_item->menu_item_parent;
                     if ($menu_item_parent == 0) :
                        $page_title = $menu_item->title;
                        $page_url = $menu_item->url;
                        $page_ID = $menu_item->ID;
                  ?>
                        <div class="menu-item-wrapper">

                           <?php $check_children = array();
                           foreach ($header_children as $child) :
                              $child_menu_item_parent = $child->menu_item_parent;
                              $child_menu_item_object = $child->object;
                              if ($child_menu_item_parent == $page_ID && $child_menu_item_object != 'custom') :
                                 $check_children[] = $child;
                              endif;
                           endforeach;

                           // se la pag di primo livello ha dei figli
                           if (!empty($check_children)) : ?>
                              <a href="<?php echo $page_url ?>" class="header-parent has-dropdown">
                                 <div class="header-parent__content">
                                    <?php echo $page_title ?>
                                    <svg class="arrow" width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M0.94 0.333008L4 3.38634L7.06 0.333008L8 1.27301L4 5.27301L0 1.27301L0.94 0.333008Z" fill="white" />
                                    </svg>
                                    <!-- <div class="trapezio"></div> -->
                                 </div>
                                 <div class="pointer">
                                    <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M7 0L14 8H0L7 0Z" />
                                    </svg>
                                 </div>
                                 <div class="backdrop"></div>
                              </a>
                              <?php if (!empty($header_children)) :
                                 $check_button = array();
                                 foreach ($header_children as $child) :
                                    $child_menu_item_parent = $child->menu_item_parent;
                                    if ($child_menu_item_parent == $page_ID && $child->object == 'custom') :
                                       $check_button[] = $child;
                                    endif;
                                 endforeach;
                              ?>
                                 <div class="drop-down<?php if (!empty($check_button)) : echo ' has-button';
                                                      endif; ?>">
                                    <div class="drop-down__content">
                                       <?php foreach ($header_children as $child) :
                                          $child_menu_item_parent = $child->menu_item_parent;
                                          $child_menu_item_object = $child->object;
                                          if ($child_menu_item_parent == $page_ID && $child_menu_item_object != 'custom') : ?>

                                             <div class="child-menu-item-wrapper">
                                                <a href="<?php echo $child->url ?>" class="header-child">
                                                   <?php echo $child->title ?>
                                                </a>
                                                <?php foreach ($header_children as $nipote) :
                                                   $nipote_menu_item_parent = $nipote->menu_item_parent;
                                                   $nipote_menu_item_object = $nipote->object;
                                                   if ($nipote_menu_item_parent == $child->ID && $nipote_menu_item_object != 'custom') : ?>
                                                      <a href="<?php echo $nipote->url ?>" class="header-nipote">
                                                         <?php echo $nipote->title ?>
                                                      </a>
                                                <?php endif;
                                                endforeach; ?>
                                             </div>

                                       <?php endif;
                                       endforeach; ?>
                                    </div>

                                    <?php if (!empty($check_button)) : ?>
                                       <div class="drop-down__button">
                                          <?php foreach ($header_children as $child) :
                                             $child_menu_item_parent = $child->menu_item_parent;
                                             if ($child_menu_item_parent == $page_ID && $child->object == 'custom') : ?>
                                                <div class="drop-down__button__item">
                                                   <a href="<?php echo $child->url ?>">
                                                      <?php echo $child->title ?>
                                                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7239 3.33333H2.66672V2H14V13.3333H12.6667V4.27614L3.13812 13.8047L2.19531 12.8619L11.7239 3.33333Z" />
                                                      </svg>
                                                   </a>
                                                </div>
                                          <?php endif;
                                          endforeach; ?>
                                       </div>
                                    <?php endif; ?>

                                 </div>

                              <?php endif;

                           // se la pagina di primo livello non ha figli
                           else : ?>
                              <a href="<?php echo $page_url ?>" class="header-parent">
                                 <div class="header-parent__content">
                                    <?php echo $page_title ?>
                                 </div>
                              </a>
                           <?php endif; ?>

                        </div>
                  <?php endif;
                  endforeach; ?>
               </nav>

               <div class="lingua">
                  <div class="wpml-custom-switcher">
                     <?php do_action('wpml_add_language_selector'); ?>
                  </div>
               </div>

               <a class="header__content__search" href="<?php echo get_home_url() . '?s='; ?>">
                  <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M27.0978 25.2449H26.1893L25.8673 24.9443C26.9943 23.6753 27.6729 22.0278 27.6729 20.2356C27.6729 16.2393 24.3263 13 20.1978 13C16.0692 13 12.7227 16.2393 12.7227 20.2356C12.7227 24.2319 16.0692 27.4712 20.1978 27.4712C22.0493 27.4712 23.7513 26.8145 25.0623 25.7236L25.3728 26.0353V26.9147L31.1229 32.4694L32.8364 30.8108L27.0978 25.2449V25.2449ZM20.1978 25.2449C17.3342 25.2449 15.0227 23.0074 15.0227 20.2356C15.0227 17.4638 17.3342 15.2263 20.1978 15.2263C23.0613 15.2263 25.3728 17.4638 25.3728 20.2356C25.3728 23.0074 23.0613 25.2449 20.1978 25.2449Z" fill="#FFF" />
                  </svg>
               </a>

               <div class="header__content__hamburger">
                  <button class="hamburger hamburger--collapse" type="button">
                     <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                     </span>
                  </button>
               </div>

            </div>
         </div>
      </div>
   </div>
   <nav class="header__mobile-nav d-xl-none" role="navigation">
      <div class="mobile-backdrop"></div>
      <div class="container">
         <div class="row">
            <div class="col-12">
               <ul>
                  <?php $header_menu_items = NP_get_menu_by_slug('header', false);
                  foreach ($header_menu_items as $menu_item) :
                     $menu_item_parent = $menu_item->menu_item_parent;
                     if ($menu_item_parent == 0) :
                        $page_title = $menu_item->title;
                        $page_url = $menu_item->url;
                  ?>
                        <li class="mobile-menu-item">
                           <a href="<?php echo $page_url; ?>"><?php echo $page_title; ?></a>
                        </li>
                  <?php endif;
                  endforeach; ?>
               </ul>
            </div>
         </div>
      </div>
   </nav>
</header>