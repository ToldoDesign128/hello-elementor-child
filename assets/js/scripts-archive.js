jQuery(document).ready(function () {
   jQuery(function () {
      var loc = window.location.href; // returns the full URL
      var para = loc.split("?comunicazioni_tax=");

      if (para[1]) {
         console.log(para[1]);
         jQuery(".filter-chip#" + para[1]).addClass("current-filter-chip");
      } else {
         jQuery(".filter-chip#all-filter").addClass("current-filter-chip");
      }
   });
});
