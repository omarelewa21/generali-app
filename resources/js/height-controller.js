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
            $("#pdpa .main-content, #basic_details .main-content, #identity_details .main-content, #avatar_marital_status .main-content, #avatar_family_dependent_details .main-content, #top_priorities .main-content, #priorities_to_discuss .main-content, #existing_policy .main-content").css("padding-bottom", mainContentPadding + "px");            
        }
        if ($("#savingsGoalsButtonInput").length) $(".main-content").css("padding-bottom", mainContentPadding + "px");
    }

    function setResponsiveMainContentPadding() {
        const windowWidth = $(window).width();
        
        // Check if the window width is less than 767px
        if (windowWidth < 1024) {
            const menuHeight = $(".navbar-scroll").outerHeight();
            const descriptionHeight = $(".fixed-sm-top").outerHeight();
            const responsiveMainContentPadding = menuHeight + descriptionHeight - 85.5;
            $(".content-section").css("padding-top", responsiveMainContentPadding + "px");
        } else {
            // Reset padding if window width is 767px or more
            $(".content-section").css("padding-top", 0);
        }
    }

    function setResponsiveHeader() {
        const windowWidth = $(window).width();

        // Check if the window width is less than 767px
        if (windowWidth < 1024) {
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

    if (window.orientation !== 90 && window.orientation !== -90) {
        setResponsiveHeader();
        setMainContentPadding();
        setResponsiveMainContentPadding();
    }

    function setResponsiveCalcuator(){
        const windowWidth = $(window).width();

        const needsMenuHeight = 85.5;
        const needsSubMenuHeight = 65;
        const calculatorHeight = $(".calculatorMob").outerHeight();
        const footerHeight = $(".footer.fixed-bottom").innerHeight();
        const titleHeight = $(".summary-page .heading .container").outerHeight();
        const responsiveHeight = needsMenuHeight + calculatorHeight;
        const gapMenu = needsMenuHeight + needsSubMenuHeight;
        const graphMenu = titleHeight + needsMenuHeight -20;

        if(windowWidth < 768){
            // $(".bottom-content .order-md-1.order-sm-2.order-2").css("padding-bottom" , footerHeight + "px");
            $(".bottom-content .calculatorContent").css("padding-bottom" , footerHeight + "px");
            $(".content-needs-grey").css("padding-top" , responsiveHeight + "px");
            $(".summary-page .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $("#risk-profile .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $(".summary-page .content-needs-grey .heading").css("padding-top" , gapMenu + "px");
            $("#health-medical-selection .content-needs-grey .heading").css("padding-top" , gapMenu + "px");
            $("#health-medical-selection .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $("#medical-hospital-selection .content-needs-grey .heading").css("padding-top" , needsSubMenuHeight + "px");
            $("#medical-hospital-selection .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $(".coverage .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            $(".coverage .content-needs-grey .heading").css("padding-top" , gapMenu + "px");
            $(".coverage .content-needs-grey .bottom-content .coverage_slick").css("padding-top" , needsMenuHeight + "px");
            $("#health-medical-selection .bottom-content #hnm-selection").css("padding-top" , gapMenu + "px");
            $("#medical-hospital-selection .bottom-content #hnm-selection").css("padding-top" , needsSubMenuHeight + "px");
            $(".bottom-content").css("padding-top" , needsSubMenuHeight + "px");
            $("#risk-profile .bottom-content").css("padding-top" , needsMenuHeight + "px");
            $(".summary-page .bottom-content .graph-col").css("padding-top" ,  graphMenu + "px");
            $(".ideal .bottom-content").css("padding-top" , 0);
            // $(".ideal .content-needs-grey .top-menu").css("padding-top" , needsMenuHeight + "px");
            // $("#medical-hospital-selection .bottom-content").css("padding-top" , 0);
            $("#monthly_goals .bottom-content .last-content").css("padding-bottom" , footerHeight + "px");
            $(".summary-page .bottom-content .gap-col").css("padding-bottom" , footerHeight + "px");
            // $(".ideal .bottom-content").css("padding-bottom" , footerHeight + "px");
            $(".summary-overview .bottom-content .tertiary-mobile-bg").css("padding-top" ,"20px");
            $("#overview .table-wrapper").css("padding-bottom" , footerHeight-50 + "px");
            if(windowWidth < 385) {
                $("#education_coverage .bottom-content").css("padding-top" , "42px");
            } 
            if(windowWidth < 500) {
                $(".summary-page .bottom-content .graph-col").css("padding-top" , "115px");
            } 
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
            // $("#health-medical-selection .content-needs-grey .heading").css("padding-top" , 0);
            $("#health-medical-selection .content-needs-grey .top-menu").css("padding-top" , 0);
            $("#health-medical-selection .bottom-content #hnm-selection").css("padding-top" , 0);
            $("#medical-hospital-selection .content-needs-grey .heading").css("padding-top" , 0);
            $("#medical-hospital-selection .content-needs-grey .top-menu").css("padding-top" , 0);
            $("#medical-hospital-selection .bottom-content").css("padding-top" , 0);
            $(".summary-page .content-needs-grey .top-menu").css("padding-top" , 0);
            $("#risk-profile .content-needs-grey .top-menu").css("padding-top" , 0);
            $("#risk-profile .bottom-content").css("padding-top" , 0);
            $(".bottom-content").css("padding-top" , 0);
            $(".coverage .content-needs-grey .top-menu").css("padding-top" , 0);
            $(".coverage .content-needs-grey .heading").css("padding-top" , 0);
            $(".coverage .content-needs-grey .bottom-content").css("padding-top" , 0);
            $(".ideal .content-needs-grey .top-menu").css("padding-top" , 0);
            $(".summary-overview .bottom-content .tertiary-mobile-bg").css("padding-top" , 0);
            $("#monthly_goals .bottom-content .last-content").css("padding-bottom" , 0);
        }
    }
    setResponsiveCalcuator();

    $(window).resize(function() {
        if (window.orientation !== 90 && window.orientation !== -90) {
            setResponsiveMainContentPadding();
            setMainContentPadding();
            setResponsiveHeader();
            setResponsiveCalcuator();
        }
    });
});