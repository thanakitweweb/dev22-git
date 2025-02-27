var base_url_lang = $("html").attr("lang");
var path = $("base").attr("href");
window.onload = function () {
    // script
};

$(function () {
    ("use strict");
    // script
});

AOS.init({
    once: true,
    duration: 2000,
});

$(document).ready(function () {
    var siteheaderHeight = $(".site-header").outerHeight();
    if ($(window).width() > 991) {
        $(window).scroll(function () {
            if ($(window).scrollTop() > siteheaderHeight) {
                $(".site-header").addClass("tiny");
                $(".menu-full").addClass("tiny");
            } else {
                $(".site-header").removeClass("tiny");
                $(".menu-full").removeClass("tiny");
            }
        });
    } else {
        $(window).scroll(function () {
            if ($(window).scrollTop() > siteheaderHeight) {
                $(".site-header").addClass("blur");
            } else {
                $(".site-header").removeClass("blur");
            }
        });
    }

    let href = $(".popup-item").attr("data-href");
    // let popupId = $(".popup-item").attr("id");

    // if ($('.popup-item').attr("data-href") != '') {
    //     $( ".fancybox-image" ).wrap( "<a class='link' href='" + href + "' target='_blank'></a>" );
    // }

    var arrPopup = new Array();
    $("[data-fancybox='gallery-popup']").fancybox({
        thumbs: false,
        slideShow: true,
        protect: true,
        fullScreen: false,
        zoom: false,
        onComplete: function () {
            $(".fancybox-container").wrap(
                "<div class='fancybox--gallery-popup'></div>"
            );
            arrPopup = Array.from(new Set(arrPopup));
            let onComplete = $(this)[0].src.split("?targetid=");
            if ($("#" + onComplete[1]).data("href") !== "javascript:void(0);") {
                $(".fancybox-image").wrap($("<a></a>"));
                $(".fancybox-placeholder a").attr(
                    "href",
                    base +
                    base_url_lang +
                    "/pageredirect/popup/" +
                    $("#" + onComplete[1]).data("id")
                );
                $(".fancybox-placeholder a").attr(
                    "target",
                    $("#" + onComplete[1]).data("target")
                );
                $(".fancybox-placeholder a").css("pointer-events", "auto");
            } else {
                $(".fancybox-image").wrap($("<a></a>"));
                $(".fancybox-placeholder a").attr("href", "javascript:void(0);");
                $(".fancybox-placeholder a").css("pointer-events", "none");
            }
        },
        beforeLoad: function () {
            let explode = $(this)[0].src.split("?targetid=");
            arrPopup.push(explode[1]);
        },
    });

    $("[data-fancybox='gallery']").fancybox({
        thumbs: true,
        slideShow: true,
        protect: true,
        fullScreen: true,
        zoom: true,
    });

    $(".main-menu-list .link-submenu").click(function () {
        $(".main-menu-list .link-submenu").removeClass("active");
        $(this).addClass("active");

        $(".menu-full").addClass("show");

        var link = $(this).data("link");
        $("." + link + " .submenu").click();
        $(".site-header .menu-toggle").addClass("close");

        return false;
    });

    $(".site-header .search-toggle").click(function () {
        $(".search").addClass("show");
    });
    $(".site-header .search input").click(function () {
        $(".search").addClass("show");
    });
    $(".site-header .search .close").click(function () {
        $(".search").removeClass("show");
    });

    $(".site-header .menu-toggle").click(function () {
        $(".menu-full").toggleClass("show");
        // $('.site-header-topbar').toggleClass('show');
        // $('.site-header').toggleClass('position');
        $(this).toggleClass("close");
        $(".main-menu-list .link-submenu").removeClass("active");
        $(".menu-full .main-menu").removeClass("hide");
    });

    $(".menu-full .main-menu .link").click(function () {
        // $('.menu-full .main-menu').css('transform', 'translateX(-100%)');
        $(".menu-full .main-menu").addClass("hide");
    });
    $(".menu-full .dropdown-menu.level-II").click(function () {
        // $('.menu-full .main-menu').css('transform', 'translateX(0)');
        $(".menu-full .main-menu").removeClass("hide");
    });

    $(".intro-slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
    });

    $(".attachment-slider").slick({
        infinite: true,
        centerPadding: 50,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            },
        },],
    });

    $(".default-nav-slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        arrows: true,
        dots: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 376,
            settings: {
                slidesToShow: 1,
            },
        },
        ],
    });

    $(".default-tab-slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        responsive: [{
            breakpoint: 778,
            settings: {
                arrows: false,
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 376,
            settings: {
                slidesToShow: 1,
            },
        },
        ],
    });

    $(".default-nav .slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            },
        },
        ],
    });

    $(".knowledge-block .slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        prevArrow: '<button class="slick-prev prev-arrow"></button>',
        nextArrow: '<button class="slick-next next-arrow"></button>',
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
            },
        },
        ],
    });

    $(".theme-2 .top-graphic .slider").slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
    });

    $(".services-block .slider").slick({
        infinite: false,
        slidesToShow: 2,
        slidesToScroll: 2,
        rows: 2,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                rows: false,
            },
        },],
    });
    $('.git-news-block .slider').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
    });

    $(".training-block .slider").slick({
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: false,
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
    });

    $(".lab-update-block .slider").slick({
        // autoplay: true,
        autoplaySpeed: 3000,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        rows: 3,
        arrows: true,
        dots: false,
        prevArrow: '<button class="slick-prev prev-arrow"></button>',
        nextArrow: '<button class="slick-next next-arrow"></button>',
        responsive: [{
            breakpoint: 992,
            settings: {
                arrows: false,
                dots: true
            },
        },]
    });

    $(".git-book-block .slider").slick({
        // autoplay: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        variableWidth: true,
        responsive: [
            {
            breakpoint: 992,
            settings: {
                variableWidth: false,
            },
        },
            {
            breakpoint: 768,
            settings: {
                variableWidth: false,
                slidesToShow: 3,
                slidesToScroll: 3,
            },
        },
            {
            breakpoint: 576,
            settings: {
                variableWidth: false,
                slidesToShow: 2,
                slidesToScroll: 2,
            },
        },
    ]
    });

    $(".theme-3 .top-graphic .slider").slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
    });

    $(".banner-block .slider").slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
    });

    $(".update-block .slider").slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            },
        },
        ],
    });

    $(".theme-1 .weblink-block .slider").slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: true,
        responsive: [
            {
            breakpoint: 1200,
            settings: {
                slidesToShow: 2,
            },
        },
            {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
            },
        },
        ],
    });

    $(".theme-2 .weblink-block .slider").slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 6,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 5,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
            },
        },
        ],
    });

    $(".theme-3 .weblink-block .slider").slick({
        infinite: false,
        slidesToShow: 5,
        slidesToScroll: 5,
        arrows: false,
        dots: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
            },
        },
        ],
    });

    $(".gallery-slider-for").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: ".gallery-slider-nav",
    });

    $(".gallery-slider-nav").slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: ".gallery-slider-for",
        dots: true,
        // centerMode: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 5,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 426,
            settings: {
                slidesToShow: 2,
            },
        },
        ],
    });

    $(".video-gallery .yt-frame").click(function () {
        $(this).addClass("hide");
        // $(".yt-frame .icon").addClass("d-none");
        // $(".yt-frame .cover").addClass("d-none");
    });



    $(".default-nav-slider .item a").click(function () {
        $("a").removeClass("active");
        $(this).addClass("active");
    });

    $(".default-tab-slider .item .tab-block").click(function () {
        $(".tab-block").removeClass("active");
        $(this).addClass("active");
    });

    // add

    $(".add-form-1").click(function () {
        $("#add-form-1").addClass("d-block");
        $("#add-form-1").removeClass("d-none");
    });

    $(".add-form-2").click(function () {
        $("#add-form-2").addClass("d-block");
        $("#add-form-2").removeClass("d-none");
    });

    $(".add-form-3").click(function () {
        $("#add-form-3").addClass("d-block");
        $("#add-form-3").removeClass("d-none");
    });

    $(".add-form-4").click(function () {
        $("#add-form-4").addClass("d-block");
        $("#add-form-4").removeClass("d-none");
    });

    $(".add-form-5").click(function () {
        $("#add-form-5").addClass("d-block");
        $("#add-form-5").removeClass("d-none");
    });

    $(".add-form-6").click(function () {
        $("#add-form-6").addClass("d-block");
        $("#add-form-6").removeClass("d-none");
    });

    // delete

    $(".delete-form-1").click(function () {
        $("#add-form-1").addClass("d-none");
        $("#add-form-1").removeClass("d-block");
    });

    $(".delete-form-2").click(function () {
        $("#add-form-2").addClass("d-none");
        $("#add-form-2").removeClass("d-block");
    });

    $(".delete-form-3").click(function () {
        $("#add-form-3").addClass("d-none");
        $("#add-form-3").removeClass("d-block");
    });

    $(".delete-form-4").click(function () {
        $("#add-form-4").addClass("d-none");
        $("#add-form-4").removeClass("d-block");
    });

    $(".delete-form-5").click(function () {
        $("#add-form-5").addClass("d-none");
        $("#add-form-5").removeClass("d-block");
    });

    $(".delete-form-6").click(function () {
        $("#add-form-6").addClass("d-none");
        $("#add-form-6").removeClass("d-block");
    });

    $(".select-control").select2({
        minimumResultsForSearch: -1,
    });

    $(".select-control.filter").select2({
        minimumResultsForSearch: -1,
    });

    $(".select-control.select-year").select2({
        theme: "option-year",
        minimumResultsForSearch: -1,
    });

    $(".select-control.select-gray").select2({
        theme: "option-gray",
        minimumResultsForSearch: -1,
    });

    // Swal.fire({
    //     title: 'ยืนยันตัวตนผ่านอีเมล์',
    //     text: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
    //     icon: 'error',
    //     confirmButtonText: 'Cool'
    // })

    function readURL(input, imgControlName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(imgControlName).attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // $("#imag").change(function() {
    //     var imgControlName = "#ImgPreview";
    //     readURL(this, imgControlName);
    //     $('.preview1').addClass('it');
    //     $('.btn-rmv1').addClass('rmv');
    // });

    // $("#removeImage1").click(function(e) {
    //     e.preventDefault();
    //     $("#imag").val("");
    //     $("#ImgPreview").attr("src", "");
    //     $('.preview1').removeClass('it');
    //     $('.btn-rmv1').removeClass('rmv');
    // });

    // document.querySelector("html").classList.add('js');

    // var fileInput = document.querySelector(".input-file"),
    //     button = document.querySelector(".btn-file"),
    //     the_return = document.querySelector(".file-return");

    // button.addEventListener("keydown", function(event) {
    //     if (event.keyCode == 13 || event.keyCode == 32) {
    //         fileInput.focus();
    //     }
    // });
    // button.addEventListener("click", function(event) {
    //     fileInput.focus();
    //     return false;
    // });
    // fileInput.addEventListener("change", function(event) {
    //     the_return.innerHTML = this.value;
    //     $(".uploadTxt-close").addClass("active");
    // });

    // $(".uploadTxt-close").click(function() {
    //     $(".file-return").addClass("d-none");
    //     $('.uploadTxt-close').removeClass('active');
    // })

    // $(".title-search-filter").click(function() {
    //     $("#advancedSearchForm").removeClass("d-none")
    // })
});

// DEV
function numberWithCommas(number,str = null) {
    
    var yourNumber =  Math.round(number);
    var n = yourNumber.toString().split(".");
    var number_empty = 0;
    var number_return = 0;
    
    if(n[1]){
        yourNumber = parseFloat(yourNumber).toFixed(2);
        var n = yourNumber.toString().split(".");
        //Comma-fies the first part
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //Combines the two sections
        number_empty = n.join(".");
    }else{

    var n = yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    number_empty = n.join(".");
    // return n.join(".");
    }

    if (str != '' && str != null) {

        if (number_empty <= 0) {
            number_return = '-';
        }else{
    
            number_return = number_empty+" "+str;
        }
       
    }else{
        if (str == null && number_empty <= 0) {
            number_return = '-';
        } else {
            number_return = number_empty;
        }
    }


    return number_return;
}