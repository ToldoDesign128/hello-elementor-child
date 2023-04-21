// Dark mode storage
// jQuery(window).on("load", function () {
//    // local storage key
//    const currentDarkMode = localStorage.getItem("dark-mode");
//    if (currentDarkMode) {
//       jQuery("body").addClass(currentDarkMode);
//       if (currentDarkMode === "dark-mode-on") {
//          jQuery("#dark-mode-trigger").prop("checked", true);
//          jQuery(".dark-mode-label").addClass("dark-label");
//       } else {
//          // default theme style
//       }
//    }
//    jQuery(".dark-mode-label").on("change", switchColorTheme);
// });
// // Dark mode toggle class
// function switchColorTheme(e) {
//    jQuery(this).toggleClass("dark-label");
//    removeDarkClasses();
//    if (e.target.checked) {
//       // dark mode on
//       jQuery("body").addClass("dark-mode-on");
//       localStorage.setItem("dark-mode", "dark-mode-on");
//       jQuery("#dark-mode-trigger").prop("checked", true);
//    } else {
//       // dark mode of
//       jQuery("body").addClass("dark-mode-off");
//       localStorage.setItem("dark-mode", "dark-mode-off");
//       jQuery("#dark-mode-trigger").prop("checked", false);
//    }
// }
// // Reset initial Dark mode state
// function removeDarkClasses() {
//    jQuery("body").removeClass("dark-mode-on");
//    jQuery("body").removeClass("dark-mode-off");
// }

jQuery(document).ready(function () {
   //Navbar Dopdown
   jQuery(".has-dropdown").hover(
      function () {
         jQuery(this).find(".arrow").addClass("arrow-up");
         jQuery(this).find(".pointer").addClass("pointer-show");
         jQuery(this).find(".backdrop").addClass("backdrop-show");
         jQuery(this).next(".drop-down").addClass("dropdown-show");
      },
      function () {
         jQuery(this).find(".arrow").removeClass("arrow-up");
         jQuery(this).find(".pointer").removeClass("pointer-show");
         jQuery(this).find(".backdrop").removeClass("backdrop-show");
         jQuery(this).next(".drop-down").removeClass("dropdown-show");
      }
   );
   jQuery(".drop-down").hover(
      function () {
         jQuery(this).prev().find(".arrow").addClass("arrow-up");
         jQuery(this).prev().find(".pointer").addClass("pointer-show");
         jQuery(this).prev().find(".backdrop").addClass("backdrop-show");
         jQuery(this).addClass("dropdown-show");
      },
      function () {
         jQuery(this).prev().find(".arrow").removeClass("arrow-up");
         jQuery(this).prev().find(".pointer").removeClass("pointer-show");
         jQuery(this).prev().find(".backdrop").removeClass("backdrop-show");
         jQuery(this).removeClass("dropdown-show");
      }
   );

   // Hamburger menu
   jQuery(".hamburger").click(function () {
      jQuery(this).toggleClass("is-active");
      jQuery(".header__mobile-nav").toggleClass("mobile-active");
   });
   jQuery(".mobile-backdrop").click(function () {
      jQuery(".hamburger").toggleClass("is-active");
      jQuery(".header__mobile-nav").toggleClass("mobile-active");
   });

   //FAQs widget
   jQuery(".faq-container").click(function () {
      jQuery(this).toggleClass("faq-active");
   });

   //Alert widget
   jQuery(".close-alert").click(function () {
      jQuery(this)
         .parent()
         .parent()
         .parent()
         .parent()
         .parent(".fbk-cw-alert")
         .addClass("closed-alert");
   });

   // Remove mt on first widget heading (h2 || h3 || h4) of single doc e single comunicazioni
   jQuery(".single .elementor-section .fbk-cw-single")
      .first()
      .find("h2")
      .css("margin-top", "0");
   jQuery(".single .elementor-section .fbk-cw-single")
      .first()
      .find("h3")
      .css("margin-top", "0");
   jQuery(".single .elementor-section .fbk-cw-single")
      .first()
      .find("h4")
      .css("margin-top", "0");

   //Add mt on widget FBK - Pagine placed after an FBK - Articoli
   // se i widget sono nella stessa sezione
   jQuery(
      ".single .elementor-section .elementor-column .elementor-widget-wrap .elementor-widget .fbk-cw-singlepost"
   )
      .parent()
      .parent()
      .next(".elementor-widget")
      .find(".fbk-cw-pages")
      .addClass("cw-pages-after-singlepost");
   // se i widget sono nella un due sezioni differenti
   jQuery(
      ".single .elementor-section .elementor-column .elementor-widget-wrap .elementor-widget .fbk-cw-singlepost"
   )
      .parent()
      .parent()
      .parent()
      .parent()
      .parent()
      .parent()
      .next(".elementor-section")
      .find(".elementor-widget:first-of-type() .fbk-cw-pages")
      .addClass("cw-pages-after-singlepost");
});
