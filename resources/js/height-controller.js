// // Get the height of any devices, and set a padding bottom to prevent footer overlay over the main content
$(document).ready(function() {
    function setMainContentPadding() {
        const windowWidth = $(window).width();
        const footerHeight = $(".footer").outerHeight();
        const mainContentPadding = footerHeight + 10; // Adding 10 pixels

        // Check if the window width is more than 767px
        if (windowWidth > 767) {
            $(".main-content").css("padding-bottom", mainContentPadding + "px");
        } else {
            // Reset padding if window width is 767px or less
            $(".main-content").css("padding-bottom", 0);
            $("#pdpa .main-content, #basic_details .main-content, #identity_details .main-content, #avatar_marital_status .main-content").css("padding-bottom", mainContentPadding + "px");            
        }
    }
  
    setMainContentPadding();

    function setResponsiveMainContentPadding() {
        const windowWidth = $(window).width();

        // Check if the window width is less than 767px
        if (windowWidth < 768) {
            const menuHeight = $(".sidebanner").outerHeight();
            const descriptionHeight = $(".fixed-sm-top").outerHeight();
            const responsiveMainContentPadding = menuHeight + descriptionHeight - 85.5;
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
            const menuHeight = $("#wrapper-navbar.fixed-top.mobile").outerHeight();
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