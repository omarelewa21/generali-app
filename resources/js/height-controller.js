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
            $("#pdpa .main-content, #basic_details .main-content, #identity_details .main-content, #avatar_marital_status .main-content, #avatar_family_dependent_details .main-content, #top_priorities .main-content").css("padding-bottom", mainContentPadding + "px");            
        }
    }
  
    setMainContentPadding();

    function setResponsiveMainContentPadding() {
        const windowWidth = $(window).width();
        
        // Check if the window width is less than 767px
        if (windowWidth < 768) {
            const menuHeight = $(".navbar-scroll").outerHeight();
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
            const menuHeightAgent = $("#wrapper-navbar-agent .fixed-top").outerHeight();
            const responsiveHeader = menuHeight; 
            $(".content-section").css("padding-top", responsiveHeader + "px");
            $(".content-section-agent").css("padding-top", menuHeightAgent + "px");
        } else {
            // Reset padding if window width is 767px or more
            $(".content-section").css("padding-top", 0);
        }
    }
  
    setResponsiveHeader();

    function setResponsiveCalcuator(){
        const windowWidth = $(window).width();

        const needsMenuHeight = 85.5;
        const needsSubMenuHeight = 76;
        const calculatorHeight = $(".calculatorMob").outerHeight();
        const footerHeight = $(".footer.fixed-bottom").innerHeight();
        const titleHeight = $(".summary-page .heading .container").outerHeight();
        const responsiveHeight = needsMenuHeight + calculatorHeight;
        const gapMenu = needsMenuHeight + needsSubMenuHeight;
        const graphMenu = titleHeight + needsMenuHeight -30;

        if(windowWidth < 768){
            // $(".bottom-content .order-md-1.order-sm-2.order-2").css("padding-bottom" , footerHeight + "px");
            $(".bottom-content .calculatorContent").css("padding-bottom" , footerHeight + "px");
            $(".content-needs-grey").css("padding-top" , responsiveHeight + "px");
            $(".summary-page .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $(".summary-page .content-needs-grey .heading").css("padding-top" , gapMenu + "px");
            $(".summary-page .bottom-content .graph-col").css("padding-top" , graphMenu + "px");
            $(".bottom-content").css("padding-top" , needsSubMenuHeight + "px");
            $(".ideal .bottom-content").css("padding-top" , 0);
            $(".summary-page .bottom-content .gap-col").css("padding-bottom" , footerHeight + "px");
            $(".ideal .bottom-content").css("padding-bottom" , footerHeight + "px");
        } else if (windowWidth >=768 && windowWidth <= 1199 ){
            $(".summary-page .bottom-content .gap-col").css("padding-bottom" , footerHeight + "px");
            $(".summary-page .bottom-content .graph-col").css("padding-top" , titleHeight + "px");
            $(".summary-page .bottom-content .graph-col").css("padding-bottom" ,  "20px");
        } else if (windowWidth >=1200 && windowWidth <= 1450){
            $("#retirement_allocated_funds .bottom-content .col-xl-5 .h-100.row").css("padding-bottom" , footerHeight + "px");
        }
        else{
            $(".summary-page .bottom-content .gap-col").css("padding-bottom" , 0);
            $(".summary-page .bottom-content .graph-col").css("padding-top" , 0);
            // $(".bottom-content .order-md-1.order-sm-2.order-2").css("padding-bottom" , 0);
            $(".bottom-content .calculatorContent").css("padding-bottom" , 0);
            $(".content-needs-grey").css("padding-top" , 0);
            $(".summary-page .content-needs-grey .heading").css("padding-top" , 0);
            $(".summary-page .content-needs-grey .top-menu").css("padding-top" , 0);
            $(".bottom-content").css("padding-top" , 0);
        }
    }
    setResponsiveCalcuator();

    $(window).resize(function() {
        setMainContentPadding();
        setResponsiveMainContentPadding();
        setResponsiveHeader();
        setResponsiveCalcuator();
    });
});