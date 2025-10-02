var $ = jQuery;
var mq = window.matchMedia("(max-width: 768px)");
var isMobile = mq.matches;
var isArabic = document.querySelector('body').classList.contains('lang-ar')
// lazy load images
AOS.init({disable: 'mobile',duration: 1000});
var marginFromLeft = $('.header .container').css('marginLeft')
var marginSmallContainer = $('.small-container').css('marginLeft')
$(document).ready(function() {
  $('.hidden').removeClass('hidden');
  
  headerSticky()
  initVideoJS();
  readMoreLines();


  // modal functions
  modalFn()

  // mobile menu
  mobileMenuAnitmation();

  // init mobile number
  initMobileNumber()

  

  // accordion
  accordionBox()


  // sliders
  sliders()

  // video modal
  initVideoModal()

  fullHalfWidth();
  
  toggleTabs();
  dropdownHeaderMenu();
    
  // custom scripts for the project
  filters();
  toggleGrid();
    
});

function modalFn(){
  // close modal
  $('body').on("click", "[close-modal]", function () {
      var modal = $(this).attr('close-modal');
      closeModal(modal)
  });
  // open modal
  $('body').on("click", "[open-modal]", function () {
      $('body').addClass('overflow-h')
      var modal = $(this).attr('open-modal');
      openModal(modal)
  });
  // *********************
  // close modals when click outside
  // *********************
  $('body').on("click", "[modal-body],[open-modal],[to-open]", function (e) {
      e.stopPropagation();
  });
  $(window).click(function(e) {
      var currentModal = $("body[opened-modal]").attr("opened-modal");
      if (currentModal) {
          closeModal(currentModal)
      }
  });
}

function openModal(modal) {
    $('[modal-name="' + modal + '"]').addClass('active').removeClass('out')
    $('body').addClass('overflow-hidden')
    if ($('body').attr('opened-modal') == undefined || $('body').attr('opened-modal') == '')
        $('body').attr('opened-modal', modal)
    else if ( $('body').attr('opened-modal').includes(modal)) {

    } else
        $('body').attr('opened-modal', $('body').attr('opened-modal') + ',' + modal)

}
function closeModal(modal) {
    
    $('[modal-name="' + modal + '"]').removeClass('active');
    if (document.querySelector('[modal-name="' + modal + '"]').hasAttribute('has-video')) {
      $('[modal-name="' + modal + '"] [target]').html('')
    }
    $('body').removeClass('overflow-hidden')
    var openedModals = $('body').attr('opened-modal').split(',')
    openedModals = openedModals.slice(0, openedModals.length - 1)

    $('body').attr('opened-modal', openedModals.join())
    
}


function mobileMenuAnitmation() {
  $('[open-mobile-menu]').click(function() {
    $(this).toggleClass('active')
    $('.mobile-menu-box').toggleClass('active')
    $('body').toggleClass('overflow-hidden')
  })
  $('[close-mobile-menu]').click(function(){
    $('.mobile-menu-box').removeClass('active')
    $('body').removeClass('overflow-hidden')
  })
  
}


function initMobileNumber() {
  if ($("#mobile_number").length > 0) {

    $("#mobile_number").intlTelInput({
      initialCountry: "ae",
      separateDialCode: true,
      excludeCountries: ["il"],
      geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
          callback(countryCode);
        });
      },
    });
  }
}
function formValidation() {
  $('[modal-form]').validate();
  // form in contact page
  if (document.querySelector('[contact-form]'))
    $('[contact-form]').validate();
}




function showAlert(status,msg) {
  var id = generateID()
  var alertTemplate = '<aside alert-id="'+id+'" class="custom-alert">'+msg+'</aside>';
  $('body').append(alertTemplate);
  setTimeout(function(){
    $('.custom-alert[alert-id="'+id+'"]').addClass('active')
    setTimeout(function(){
      $('.custom-alert[alert-id="'+id+'"]').removeClass('active')
      setTimeout(function(){
        $('.custom-alert[alert-id="'+id+'"]').remove()
      },400)
    },2000)
  },100)
}

function generateID(){
  return "id" + Math.random().toString(16).slice(2)
}
function toggleTabs() {
  $('[toggle]').click(function() {
    var eSelector = $(this).attr('toggle');
    var allTabs = eSelector.substr(0, 3);

    if (eSelector.includes('all')) {
        // Show all tabs when the "All" button is clicked
        $('[data-toggle-tab^=' + allTabs + ']').addClass('active');
        
        var allBtns = $('[toggle^=' + allTabs + ']');
        $(allBtns).removeClass('active');
        
        var btn = $('[toggle=' + eSelector + ']');
        $(btn).addClass('active').siblings().removeClass('active');
    } else {
        var allBtns = $('[toggle^=' + allTabs + ']');
        $(allBtns).removeClass('active');
    
        var btn = $('[toggle=' + eSelector + ']');
        $(btn).addClass('active').siblings().removeClass('active');
    
        var elList = $('[data-toggle-tab^=' + allTabs + ']');
        $(elList).removeClass('active');
    
        var element = $('[data-toggle-tab=' + eSelector + ']');
        $(element).addClass('active');
    }
});

  $('[toggle-fade]').click(function() {
    var eSelector = $(this).attr('toggle-fade');
    var btn = $('[toggle-fade="' + eSelector + '"]');
    $(btn).addClass('active').siblings().removeClass('active');

    var allTabs = eSelector.substr(0, 3);
    var elList = $('[data-toggle-fade^="' + allTabs + '"]');
    $(elList).hide().removeClass('active');

    var element = $('[data-toggle-fade="' + eSelector + '"]');
    $(element).fadeIn().addClass('active');
  })


}

  



function accordionBox() {
  $('.acc-head').click(function(){
    
    if ($(this).parents('[is-multiple]').attr('is-multiple') == 'true') {
      $(this).toggleClass('active').siblings('.acc-body').slideToggle();
    } else {
      if (!$(this).hasClass('active')) {
        $(this).parents('[accordion-root]').find('.accs-item').removeClass('active');
        $(this).parents('[accordion-root]').find('.acc-head').removeClass('active');
        $(this).parents('[accordion-root]').find('.acc-body').slideUp();
        $(this).addClass('active').siblings('.acc-body').slideDown();
        $(this).parents('.accs-item').addClass('active');
      } else {
        $(this).parents('[accordion-root]').find('.acc-head').removeClass('active');
        $(this).parents('[accordion-root]').find('.acc-body').slideUp();
        $(this).parents('[accordion-root]').find('.accs-item').removeClass('active');
      }
    }
  })
}

function sliders() {
  
  if ($('[dynamic-slider]').length > 0) {
    $('[dynamic-slider]').each(function () {
      var root = $(this).parents('[slider-section]');
      var el = $(this);
      var id = generateID();
      var options = {
        slidesPerView: 1,
        spaceBetween: 0,
      }
      // # ARROWS
      if ($(root).find('[arrow-left]').length > 0) {
        $(root).find('[arrow-left]').attr('id',`left_arr_${id}`);
        $(root).find('[arrow-right]').attr('id',`right_arr_${id}`);
        options.navigation = {
          nextEl: `#left_arr_${id}`,
          prevEl: `#right_arr_${id}`
        };
      }
      // # PAGINATION
      if ($(root).find(".swiper-custom-pagination").length > 0) {
        options.pagination = {
          el: $(root).find(".swiper-custom-pagination")[0],
          clickable: true
        }
      }

      // # per view
      if ($(this).attr('per-view') != undefined) {
        options.slidesPerView = +$(this).attr('per-view')
      }

      // # breakpoints
      if ($(this).attr('responsive') != undefined) {
        
        var responsiveData = $(this).attr('responsive');
        var breakpoints = JSON.parse("[" + responsiveData + "]");
        var grid = $(this).attr('grid');
        var breakpointsConfig = {};
  
        breakpoints.forEach(function (breakpoint,index) {
          var perView = breakpoint[0];
          var spaceBetween = breakpoint[1];
          var info = {
            slidesPerView: perView,
            spaceBetween: spaceBetween,
          };
          if (index == 0) {
            if (grid) {
              info.grid = {
                rows: grid[0],
              }
            };
            breakpointsConfig[320] = info
          }
          if (index == 1) {
            if (grid) {
              info.grid = {
                rows: grid[1],
              }
            };
            breakpointsConfig[800] = info
          }
          if (index == 2) {
            if (grid) {
              info.grid = {
                rows: grid[2],
              }
            };
            breakpointsConfig[1100] = info
          }
        });
        options.breakpoints = breakpointsConfig
      }

      // # loop
      if ($(this).attr('loop') != undefined) {
        options.loop = true;
      }
      // # autoplay
      if ($(this).attr('auto-play') != undefined) {
        options.autoplay = {
          delay: +$(this).attr('auto-play'),
          disableOnInteraction: false,
        };
      }

      var swiper = new Swiper(el[0], {
        ...options,
      });
    });
  }

  if ($('[banner]').length > 0) {
    $('[banner]').each(function(){
      $(this).slick({
        variableWidth: true,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 8000,
        pauseOnHover: false,
        cssEase: 'linear'
      });
    })
  }

  if ($('.listen-slider').length > 0) {
    var swiper = new Swiper(".listen-slider", {
      slidesPerView: 'auto',
      spaceBetween: 78,
      pagination: {
        el: ".listen-section .swiper-custom-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".listen-section .right-arrow",
        prevEl: ".listen-section .left-arrow",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        800: {
          slidesPerView: 2,
        },
        1100: {
          slidesPerView: 'auto',
          spaceBetween: 78,
        },
      },
      // loop:true,
    });
  }

  if ($('[equal-height]').length > 0) {
      
    $('[equal-height]').each(function(){
        var tallestSlideHeight = 0;
        var self = $(this);
        
        // Loop through each slide and find the tallest one
        $(self).find('.swiper-slide').each(function() {
            var slideHeight = $(this).height();
            
            if (slideHeight > tallestSlideHeight) {
                tallestSlideHeight = slideHeight;
            }
        });
    
        // Set the same height for all slides
        $(self).find('.swiper-slide').css('height', tallestSlideHeight + 'px');
    });
    
  }
  // pagination: {
  //   el: ".my-section .swiper-custom-pagination",
  //   clickable: true,
  // },
  // navigation: {
  //   nextEl: ".my-section .right-arrow",
  //   prevEl: ".my-section .left-arrow",
  // },
  // breakpoints: {
  //   320: {
  //     slidesPerView: 1,
  //     spaceBetween: 30,
  //   },
  //   800: {
  //     slidesPerView: 2,
  //   },
  //   1100: {
  //     slidesPerView: 3,
  //     spaceBetween: 50,
  //   },
  // },
  // loop:true,
  // autoplay: {
  //   delay: 3000,
  //   disableOnInteraction: false,
  // },
  
  
  // if ($('.landing-slider').length > 0) {
  //   var swiper = new Swiper(".landing-slider", {
  //     slidesPerView: 1,
  //     spaceBetween: 0,
  //     pagination: {
  //       el: ".landing-section .swiper-custom-pagination",
  //       clickable: true,
  //     },
  //     navigation: {
  //       nextEl: ".landing-section .right-arrow",
  //       prevEl: ".landing-section .left-arrow",
  //     },
  //   });
  // }

  // ******************
  // main slider with thumb
  // ******************
  // if ($('.inter-slider').length > 0) {
  //   var thumbs = new Swiper ('.int-ext-section .left .gallery-thumbs', {
  //       slidesPerView: 4,
  //       spaceBetween: 8,
  //       // centeredSlides: true,
  //       // loop: true,
  //       slideToClickedSlide: true,
  //       breakpoints: {
  //         320: {
  //           slidesPerView: 3,
  //           spaceBetween: 2,
  //         },
  //         1100: {
  //           slidesPerView: 4,
  //         },
  //       },
  //   });
  //   var slider = new Swiper(".inter-slider", {
  //     slidesPerView: 1,
      
  //     loopedSlides: 1,
  //     navigation: {
  //       nextEl: ".int-ext-section .left .right-arrow",
  //       prevEl: ".int-ext-section .left .left-arrow",
  //     },
  //     pagination: {
  //       el: ".int-ext-section .left .swiper-custom-pagination",
  //       clickable: true,
  //     },
  //     thumbs: {
  //       swiper: thumbs,
  //     },
  //   });
    
  //   slider.controller.control = thumbs;
    
  // }
  
}

function initVideoModal(){
  $('[play-video-modal]').click(function(){
    var modalName= $(this).attr('open-modal');
    var videoID = $('[play-video-modal]');
    var videoSrc = $('[video-id='+videoID+'][video-modal-src="'+modalName+'"]').html();
    $('[modal-name="'+modalName+'"] [target]').html(videoSrc)
    $('[modal-name="'+modalName+'"]').attr('has-video','')
  })
}



$('[read-more-root]').click(function(){
  var text = $(this).find('[target]').html();
  $('.read-more-modal [target]').html(text)
});


$('[video-play]').click(function(){
  var video = $(this).get(0)
  if ($(this).attr('is-init') != '') {
    $(this).parents('.play-icon-box').removeClass('play-icon-box');
  }
  if ( video.paused ) {
    video.play();
  } else {
    video.pause();
  }
})

function fullHalfWidth() {
  
  if (marginFromLeft) {
    $('[full-half]').css('width','calc(100% + '+marginFromLeft+')')
    marginNum = +(marginFromLeft.replace('px',''))
    $('[pull-left]').css('marginRight',(-marginNum) + 'px');
    $('[pull-right]').css('marginLeft',(-marginNum) + 'px');
    $('[pull-left-inner]').css('marginRight',(marginNum) + 'px');
    $('[padding-left]').css('paddingLeft',(marginNum) + 'px');
    $('[margin-left]').css('marginLeft',(marginNum) + 'px');
    
    $('[padding-right]').css('paddingRight',(marginNum) + 'px');

    $('[full-half-container]').css({'paddingLeft':marginNum / 2,'paddingRight':marginNum})
    $('[full-half-container-padding]').css({'paddingLeft':marginNum})
    
    if (isMobile) {
      $('[full-mobile-right]').css('width','calc(105% + '+((marginNum * 2) + 10)+'px)')
    }
  }
}


function headerSticky(){
  var header = document.querySelector("header.header");
  var body = document.querySelector("body");
  if (header) {
    var lastScrollTop = 0;
    var headerHeight = $("header.header").innerHeight()
    window.onscroll = function() {scrollHide()};
    // $('.mobile-menu-box').css({'top':headerHeight});
    // $('.mobile-menu > ul').css({'height':'calc(96% - '+headerHeight+'px)'})
    function scrollHide() {
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > headerHeight) {
        body.classList.add('sticky-header');
      } else {
        body.classList.remove('sticky-header');
      }
      lastScrollTop = st <= 0 ? 0 : st;
    }
    scrollHide()
  }
}


$.fn.isInViewport = function() {
  if ($(this) && $(this).offset()) {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();
  
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
  
    return elementBottom > viewportTop && elementTop < viewportBottom;
  }
};



function initVideoJS() {
  if ($('.video-el').length > 0) {
    // <video id="my-video" class="video-js video-el object-fit vjs-default-skin w-100" poster="layout/image/video-img.jpeg" controls preload="auto" width="640" height="360">
    //    <source src="layout/image/article-vid.mp4" type="video/mp4">
    // </video>
    $('.video-el').each(function(){
      var ID = $(this).attr('id');
      var player = videojs(ID);
    })
  }
}

function readMoreLines() {
  // <div read-root>
  //   <p class="three-line" read-lines="3">original text</p>
  //   <button read-more-btn >Read More</button>
  //   <button read-less-btn >Read Less</button>
  // </div>
  
  if ($('[read-lines]').length > 0) {
    $('[read-lines]').each(function () {
      var lines = $(this).attr('read-lines');
      $(this).attr('data-height',$(this).css('height'));
      var lineHeight = parseFloat($(this).css('line-height'));
      
      $(this).css({
        'overflow': 'hidden',
        'text-overflow': 'ellipsis',
        'display': '-webkit-box',
        '-webkit-box-orient': 'vertical',
        '-webkit-line-clamp': 'unset',
        'transition': 'max-height 0.3s ease-in-out',
        'max-height': (lineHeight * lines) + 'px',
      });
      $(this).attr('data-height-small',$(this).css('height'));
    });
  
    $('[read-more-btn]').click(function () {
      var targetText = $(this).parents('[read-root]').find('[read-lines]');
      var originalHeight = $(targetText).attr('data-height');
      
      $(targetText).css({
        'max-height': originalHeight,
      });
  
      $(this).hide();
      $(this).parents('[read-root]').find('[read-less-btn]').show();
    });
    $('[read-less-btn]').click(function () {
      var targetText = $(this).parents('[read-root]').find('[read-lines]');
      var originalHeight = $(targetText).attr('data-height-small');
      
      $(targetText).css({
        'max-height': originalHeight,
      });
  
      $(this).hide();
      $(this).parents('[read-root]').find('[read-more-btn]').show();
    });
      
  }
}

function dropdownHeaderMenu() {
  $('.mobile-menu .menu-item-has-children').each(function(){
    $(this).prepend('<i collapse-menu="" class="fa-solid fa-plus"></i>');
  });
  $('body').on("click", ".header [collapse-menu]", function () {
    $(this).toggleClass('active').siblings('.sub-menu').slideToggle();
  });
}

function filters() {
  if ($('[range-slider]').length > 0) {
    $('[range-slider]').each(function() {
      var root = $(this).parents('[range-slider-root]');
      var value = +$(this).attr('current-val');
      var step = Number($(this).attr('data-step'))
      var minVal = +$(root).find('[range-slider-min]').html();
      var maxVal = +$(root).find('[range-slider-max]').html();

      $this = $(this);

      $(this).slider({
        // range: 'min',
        min: minVal,
        max: maxVal,
        value: value, // Initial value
        tooltip: "always",
        step: step,
        slide: function(event, ui) {
          var currentValue = ui.value;
          // Callback function triggered while sliding
          $(this).find('.value').html(currentValue).attr('data-selected-value', ui.value);
        }
      });
      var sliderHandle = $this.find('.ui-slider-handle'),
          currentValue = sliderHandle.parent().attr('data-value');
      sliderHandle.append('<span class="value min-value" data-selected-value="'+ currentValue +'"></span>');
      
      $this.find('.value').html(value);
    });
  }
}

function toggleGrid() {
  $('[toggle-style]').click(function(){
    var view = $(this).attr('toggle-style');
    $('body').attr('view-style',view)
  });
  if ($('#calendar').length > 0) {

    $('#calendar').datepicker({
      inline:true,
      firstDay: 1,
      showOtherMonths:true,
      dayNamesMin:['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    });
  }  
    
}




function galleryspin(dotIndex) { 
  if (document.querySelector(".dot")) {
    var spinner = document.querySelector("#spinner");
    angle = dotIndex * 45;
    spinner.setAttribute("style","-webkit-transform: rotateY("+ angle +"deg); -moz-transform: rotateY("+ angle +"deg); transform: rotateY("+ angle +"deg);");
  
    // Update the active dot
    var dots = document.querySelectorAll(".dot");
    dots.forEach(function(dot, index) {
      if(index === dotIndex) {
        dot.classList.add("active");
      } else {
        dot.classList.remove("active");
      }
    });
    
    // Optional: Set the initial active dot
    document.querySelector(".dot").classList.add("active");
  }
}