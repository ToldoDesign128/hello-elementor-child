// Dark mode storage
jQuery(window).on("load", function () {
  // local storage key
  const currentDarkMode = localStorage.getItem("dark-mode");
  if (currentDarkMode) {
    jQuery("body").addClass(currentDarkMode);
    if (currentDarkMode === "dark-mode-on") {
      jQuery("#dark-mode-trigger").prop("checked", true);
      jQuery(".dark-mode-label").addClass("dark-label");
    } else {
      // default theme style
    }
  }
  jQuery(".dark-mode-label").on("change", switchColorTheme);
});
// Dark mode toggle class
function switchColorTheme(e) {
  jQuery(this).toggleClass("dark-label");
  removeDarkClasses();
  if (e.target.checked) {
    // dark mode on
    jQuery("body").addClass("dark-mode-on");
    localStorage.setItem("dark-mode", "dark-mode-on");
    jQuery("#dark-mode-trigger").prop("checked", true);
  } else {
    // dark mode of
    jQuery("body").addClass("dark-mode-off");
    localStorage.setItem("dark-mode", "dark-mode-off");
    jQuery("#dark-mode-trigger").prop("checked", false);
  }
}
// Reset initial Dark mode state
function removeDarkClasses() {
  jQuery("body").removeClass("dark-mode-on");
  jQuery("body").removeClass("dark-mode-off");
}

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

// Open list footer
jQuery(".footer-title").click(function () {
  jQuery(this).next().children().toggleClass("show-footer-item");
});
