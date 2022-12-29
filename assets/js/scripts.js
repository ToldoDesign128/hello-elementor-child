// Open list footer

jQuery(".footer-title").click(function () {
   jQuery(this).next().children().toggleClass("show-item");
});

jQuery(document).ready(function () {
   //FAQs section
   jQuery(".faq-container").click(function () {
      jQuery(this).toggleClass("faq-active");
   });
});
