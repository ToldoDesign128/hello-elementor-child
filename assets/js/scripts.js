// Open list footer

jQuery(".footer-title").click(function () {
   jQuery(this).next().children().toggleClass("show-item");
});

jQuery(document).ready(function () {
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
});
