duraFunc = function() {
    "use strict";
    $(".scrollup").on("click", function() {
        return $("html, body").animate({
            scrollTop: 0
        }, 600), !1
    }), $(".dura-search").on("click", function() {
        $(".overlay").addClass("overlay-visible")
    }), $(document).mouseup(function(a) {
        var n = $(".dura-search");
        n.is(a.target) || 0 !== n.has(a.target).length || $(".overlay").removeClass("overlay-visible")
    }), $("#loginTab").on("click", function(a) {
        a.preventDefault(), $(this).tab("show")
    }), $('.dropdown-menu a[data-toggle="tab"]').on("click", function(a) {
        a.stopPropagation(), $(this).tab("show")
    }), $("div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li").mouseover(function() {
        $(this).is(":first-child") || $("div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li:first-child a").removeClass("active-tab")
    }), $("div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li").mouseleave(function() {
        $("div.nav-container .navbar ul.nav > li > div.tabbed-menu > ul > li:first-child a").addClass("active-tab")
    }), $(".carousel").carousel({
        interval: 3e3
    })
}, duraFunc();