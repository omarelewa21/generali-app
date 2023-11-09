// // Get the height of any devices, and set a padding bottom to prevent footer overlay over the main content
$(document).ready(function() {
    function setMainContentPadding() {
        const windowWidth = $(window).width();

        // Check if the window width is more than 767px
        if (windowWidth > 767) {
            const footerHeight = $(".footer").outerHeight();
            const mainContentPadding = footerHeight + 10; // Adding 10 pixels
            $(".main-content").css("padding-bottom", mainContentPadding + "px");
        } else {
            // Reset padding if window width is 767px or less
            $(".main-content").css("padding-bottom", 0);
        }
    }
  
    setMainContentPadding();

    function setResponsiveMainContentPadding() {
        const windowWidth = $(window).width();

        // Check if the window width is less than 767px
        if (windowWidth < 768) {
            const menuHeight = $(".sidebanner").outerHeight();
            const responsiveMainContentPadding = menuHeight; // Adding 10 pixels
            $(".content-section").css("padding-top", responsiveMainContentPadding + "px");
        } else {
            // Reset padding if window width is 767px or more
            $(".content-section").css("padding-top", 0);
        }
    }
  
    setResponsiveMainContentPadding();

    function setResponsiveHeader() {
        const windowWidth = $(window).width();

        // Check if the window width is less than 767px
        if (windowWidth < 768) {
            const menuHeight = $("#wrapper-navbar.fixed-top").outerHeight();
            const responsiveHeader = menuHeight; // Adding 10 pixels
            $(".content-section").css("padding-top", responsiveHeader + "px");
        } else {
            // Reset padding if window width is 767px or more
            $(".content-section").css("padding-top", 0);
        }
    }
  
    setResponsiveHeader();
  
    $(window).resize(function() {
        setMainContentPadding();
        setResponsiveMainContentPadding();
        setResponsiveHeader();
    });
});