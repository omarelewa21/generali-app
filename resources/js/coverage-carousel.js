// Function to initialize Slick carousel
// Function to initialize Slick carousel
function initSlickCarousel() {
<<<<<<< HEAD
  const windowWidth = $(window).width();

  if (windowWidth < 1025) {
    $('.coverage-avatar[data-carousel="true"]').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      infinite: false,
      prevArrow: $('.prev-arrow'), // Use the class of the left arrow
      nextArrow: $('.next-arrow'), // Use the class of the right arrow
      responsive: [
        {
          breakpoint: 768, // Mobile breakpoint
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
=======
    const windowWidth = $(window).width();
    
    if (windowWidth < 1025) {
    $('.coverage-avatar[data-carousel="true"]').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    infinite: false,
    prevArrow: $('.prev-arrow'), // Use the class of the left arrow
    nextArrow: $('.next-arrow'), // Use the class of the right arrow
    responsive: [
      {
        breakpoint: 768, // Mobile breakpoint
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
>>>>>>> 98fca7e (latest)
        },
        {
          breakpoint: 1024, // Tablet breakpoint
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
    // Show the arrows since we are in the mobile view
    $('.prev-arrow, .next-arrow').show();
  }
  else {
    // Hide the arrows since we are in the desktop view
    $('.prev-arrow, .next-arrow').hide();
  }
  if (windowWidth < 1025) {
    $('.retirement-ideal-avatar[data-carousel="true"]').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      infinite: false,
      prevArrow: $('.prev-arrow'), // Use the class of the left arrow
      nextArrow: $('.next-arrow'), // Use the class of the right arrow
      responsive: [
        {
          breakpoint: 768, // Mobile breakpoint
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 1024, // Tablet breakpoint
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
    // Show the arrows since we are in the mobile view
    $('.prev-arrow, .next-arrow').show();
  }
  else {
    // Hide the arrows since we are in the desktop view
    $('.prev-arrow, .next-arrow').hide();
  }
}


// Call the initialization function when the DOM is ready
jQuery(function () {
  initSlickCarousel();

})
// $(document).ready(function() {
//   initSlickCarousel();
// });
