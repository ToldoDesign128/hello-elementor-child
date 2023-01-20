jQuery(document).ready(function () {
   jQuery(".single-page-content h2").each(function () {
      var h2_title = jQuery(this).text();
      var h2_slug = jQuery(this).attr("id");

      jQuery(".single-page-content .sidebar .index").append(
         '<a href="#' +
            h2_slug +
            '" class="index_item"><span>' +
            h2_title +
            "</span></a>"
      );
   });

   var selects = jQuery(".single-page-content h2");
   console.log(selects.length);
   jQuery(window).on("scroll", function () {
      selects.each(function (index, el) {
         var h2_slug = jQuery(this).attr("id");
         var h2_offset = jQuery(this).offset().top;

         if (jQuery(window).scrollTop() >= h2_offset - 120) {
            //se non è il primo H2..
            if (index !== 0) {
               // ..aggiungo .reading..
               jQuery('.index_item[href="#' + h2_slug + '"]').addClass(
                  "reading"
               );
               // ..e la tolgo a tutti i precedenti
               var h2_prev_slug = selects.eq(index - 1).attr("id");
               jQuery('.index_item[href="#' + h2_prev_slug + '"]').removeClass(
                  "reading"
               );
            } else {
               jQuery('.index_item[href="#' + h2_slug + '"]').addClass(
                  "reading"
               );
            }
         } else {
            jQuery('.index_item[href="#' + h2_slug + '"]').removeClass(
               "reading"
            );
         }
      });
   });
});
