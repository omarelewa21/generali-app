// Get the height of any devices, and set a padding bottom to prevent footer overlay over the main content
$(document).ready(function() {
    function setMainContentPadding() {
        const windowWidth = $(window).width();
        const footerHeight = $(".footer").outerHeight();
        const mainContentPadding = footerHeight + 10; // Adding 10 pixels
        $(".main-content").css("padding-bottom", mainContentPadding + "px");
    }
  
    setMainContentPadding();
  
    $(window).resize(function() {
        setMainContentPadding();
    });
  });