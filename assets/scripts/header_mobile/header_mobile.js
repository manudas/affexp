
$(document).ready(function () {



    !function () {
        var g = $(".MobileHeader-search-bar-input");
        var h = g.data("result-count");
        var f;
        if (g.length) {
            /*
            g.autocomplete({
                source: function (a, b) {
                    $.getJSON("/system/ajax-storelist", {term: a.term, count: h}, function (c) {
                        if (c.num_records == h) {
                            var d = g.data("search-page");
                            d = d.replace("xx_replace_search_term_xx", encodeURIComponent(a.term));
                            c.records[c.records.length - 1] = {show_more: true, url: d, text: g.data("view-results")}
                        }
                        b(c.records)
                    })
                }, minLength: 2, select: function (b, a) {
                    window.location.href = a.item.link
                }, position: {my: "left top", at: "left bottom"}, open: function () {
                    $(this).data("uiAutocomplete").menu.element.addClass("MobileHeaderSearchResults");
                    if (f) {
                        f.show()
                    } else {
                        g.after('<a id="MobileHeader-search-bar-input__clear" class="MobileHeader-search-bar-input__clear"><span class="x-close">X</span></a>');
                        f = $("#MobileHeader-search-bar-input__clear")
                    }
                    var a = document.querySelector("#Page");
                    a.addEventListener("touchmove", MVCPreventDefaultFunc, false);
                    lockBody(document.getElementById("Page-main"));
                    iOSScrollFix(document.querySelector(".MobileHeaderSearchResults"))
                }
            }).data("ui-autocomplete")._renderItem = function (b, a) {
                var c;
                if (a.show_more) {
                    c = '<div id="Search-footer"><a href="' + a.url + '"><span>' + a.text + "</span></a></div>"
                } else {
                    c = '<div class="Search-row clearfix"><div class="Search-row-left"><img src="' + a.logo + '" alt="' + a.alt_text + '" width="89" height="89"></div><div class="Search-row-right"><div class="Search-row-right-title">' + a.title + '</div><div class="Search-row-right-url">' + a.url + '</div><div class="Search-row-right-details-link clearfix"><div class="Search-row-right-off-link"><a href="' + a.link + '"><span>' + a.offer_link + "</span></a></div></div></div></div>"
                }
                return $('<li style="list-style-image: none" class="Search-row-li"></li>').data("item.autocomplete", a).append(c).appendTo(b)
            };

            */


            $("body").on("click", "#MobileHeader-search-bar-input__clear", function (a) {
                a.preventDefault();
                g.val("").focus();
                $(".MobileHeaderSearchResults, #MobileHeader-search-bar-input__clear").hide();
                //unlockBody(document.querySelector("body"));
                unlockBody(document.getElementById("Page-main"));
                e()
            });

            function e() {
                var a = document.querySelector("#Page");
                // var a = document.querySelector("body");
                a.removeEventListener("touchmove", MVCPreventDefaultFunc, false)
            }

            g.on("input", function () {
                if (f) {
                    if (!$(this).val().length) {
                        f.hide();
                        e();
                        unlockBody(document.getElementById("Page-main"))
                    } else {
                        f.show()
                    }
                }
            })
        }
        $(".MobileHeader-search").click(function (a) {
            a.preventDefault();
            $(".MobileHeader").toggleClass("active");
            $("body").toggleClass("MobileHeader-search-bar--open");
            if ($(".MobileHeader").hasClass("active") === true) {
                $(".MobileHeader-search-bar-input").focus()
            } else {
                if ($("html").hasClass("scroll-lock")) {
                    e();
                    unlockBody(document.getElementById("Page-main"))
                }
            }
            $(".MobileHeaderSearchResults").hide();
            return false
        });
        $(".MobileHeader-toggle").click(function () {
            e()
        })
    }();


    var MOBILE_MENU = window.MOBILE_MENU || {};
    MOBILE_MENU = (function (jquery, dom_window, dom_doc, k) {
        var saved_inner_properties, saved_dom_window = dom_window, saved_dom_document = dom_doc;
        saved_inner_properties = {
            PageMainHeight: null,
            HeaderHeight: null,
            MobileHeaderBar: null,
            MobileHeaderSearchBar: null,
            HeaderWrap: null,
            Page: null,
            PageMain: null,
            set: function (object_arr_properties) {
                this.MobileHeaderBar = object_arr_properties.MobileHeaderBar;
                this.MobileHeaderSearchBar = object_arr_properties.MobileHeaderSearchBar;
                this.HeaderWrap = object_arr_properties.HeaderWrap;
                this.Page = object_arr_properties.Page;
                this.PageMain = object_arr_properties.PageMain
            },
            isEventSupported: function (e, b) {
                var a, d = {
                    select: "input",
                    change: "input",
                    submit: "form",
                    reset: "form",
                    error: "img",
                    load: "img",
                    abort: "img"
                };
                b = b || dom_doc.createElement(d[e] || "div");
                e = "on" + e;
                var c = (e in b);
                if (!c) {
                    if (!b.setAttribute) {
                        b = dom_doc.createElement("div")
                    }
                    if (b.setAttribute && b.removeAttribute) {
                        b.setAttribute(e, "");
                        c = typeof b[e] == "function";
                        if (typeof b[e] != "undefined") {
                            b[e] = a
                        }
                        b.removeAttribute(e)
                    }
                }
                b = null;
                return c
            },


            createMobileNavToggle: function () {
                jquery(".MobileHeader-toggle").on("click", function (a) {
                    a.preventDefault();
                    jquery(".MobileHeaderSearchResults").hide();
                    jquery(saved_inner_properties.Page).toggleClass("Page-mobileheaderopen");
                    if (jquery(saved_inner_properties.Page).hasClass("Page-mobileheaderopen")) {
                        lockBody(saved_inner_properties.PageMain)
                    } else {
                        unlockBody(saved_inner_properties.PageMain)
                    }
                    saved_inner_properties.HeaderWrap.style.display = "block"
                })
            },
            createCloseMenuZone: function () {
                jquery(".MobileHeader-toggle").on("click", function (a) {
                    a.preventDefault();
                    if (jquery(saved_inner_properties.Page).hasClass("Page-mobileheaderopen")) {


                        jquery('<div id="remove-menu" class="remove-menu"></div>').appendTo("#Page-main");


                        var b = dom_doc.querySelector("#remove-menu");
                        b.addEventListener("touchmove", function (d) {
                            d.preventDefault()
                        }, false)
                    } else {
                        var c = saved_dom_document.getElementById("remove-menu");
                        c.parentNode.removeChild(c);
                        saved_inner_properties.HeaderWrap.removeAttribute("style")
                    }
                })
            },

            removeCloseMenuZone: function () {
                jquery(saved_dom_document).on("click", "#remove-menu", function () {
                    jquery(saved_inner_properties.Page).removeClass("Page-mobileheaderopen");
                    unlockBody(saved_inner_properties.PageMain);
                    var a = saved_dom_document.getElementById("remove-menu");
                    a.parentNode.removeChild(a);
                    saved_inner_properties.HeaderWrap.removeAttribute("style")
                })
            },

            resizeRemoveCloseMenuZone: function () {
                saved_dom_window.addEventListener("orientationchange", function () {
                    if (saved_dom_window.orientation === 0 || saved_dom_window.orientation === 90 || saved_dom_window.orientation === -90 || saved_dom_window.orientation === 180) {
                        if (jquery(saved_inner_properties.Page).hasClass("Page-mobileheaderopen")) {
                            jquery(saved_inner_properties.Page).removeClass("Page-mobileheaderopen");
                            var a = saved_dom_document.getElementById("remove-menu");
                            a.parentNode.removeChild(a);
                            saved_inner_properties.HeaderWrap.removeAttribute("style")
                        }
                    }
                }, false)
            }
        };
        return {
            init: function (obj_header_elements) {
                saved_inner_properties.set(obj_header_elements);
                saved_inner_properties.createMobileNavToggle();
                saved_inner_properties.createCloseMenuZone();
                saved_inner_properties.removeCloseMenuZone();
                if (saved_inner_properties.isEventSupported("orientationchange", dom_window)) {
                    saved_inner_properties.resizeRemoveCloseMenuZone()
                }
            }
        }
    }(jQuery, window, document));



    MOBILE_MENU.init({
        MobileHeaderBar: document.querySelector(".MobileHeader-bar"),
        MobileHeaderSearchBar: document.querySelector(".MobileHeader-search-bar"),
        HeaderWrap: document.querySelector(".Header-wrap"),
        Page: document.getElementById("Page"),
        PageMain: document.getElementById("Page-main")
    });


    function lockBody(b) {
        if (window.pageYOffset) {
            if (b !== null) {
                b.style.top = -(window.pageYOffset) + "px"
            }
        }
        $("html").addClass("scroll-lock")
    }


    function unlockBody(d) {
        if (d !== null) {
            var c = d.style.top;
            d.style.top = ""
        }
        $("html").removeClass("scroll-lock");

        c = Math.abs(parseInt(c, 10));
        if (c > 0) {
            window.scrollTo(0, c);
            window.setTimeout(function () {
                c = null
            }, 0)
        }

    }

    function MVCPreventDefaultFunc(b) {
        b = b || window.event;
        if (b.preventDefault) {
            b.preventDefault()
        }
        b.returnValue = false
    }

});





























// REVISAR DE AQUI PARA ABAJO




jQuery(window).ready(function () {
    (function (m) {
        var l;
        var h = 0;
        var j = 3;
        var k = m(".MobileHeader");
        var n = 220;
        m(window).scroll(function () {
            l = true
        });
        setInterval(function () {
            if (l) {
                i();
                l = false
            }
        }, 250);

        function i() {
            if (!m("html").hasClass("scroll-lock")) {
                var a = m(this).scrollTop();
                if (Math.abs(h - a) <= j) {
                    return
                }
                if (a > h && a > n) {
                    if (!m("#Page").hasClass("Page-mobileheaderopen")) {
                        k.removeClass("nav-down").addClass("nav-up ")
                    }
                    m("body").addClass("MobileHeader--fixed")
                } else {
                    if (a < 3) {
                        m("body").removeClass("MobileHeader--fixed")
                    }
                    if (a + m(window).height() < m(document).height()) {
                        k.removeClass("nav-up").addClass("nav-down")
                    }
                }
                h = a
            }
        }
    })(jQuery);

});

/*
jQuery(window).ready(function () {
    // ie8FontIconBugFix();
    var snow_canvas_mobile;
    var site_header = document.querySelector(".site-header");
    var MobileHeader = document.querySelector(".MobileHeader");
    var MobileHeader_bar = document.querySelector(".MobileHeader-bar");
    var promo_bar__mobile_only = document.querySelector(".promo-bar--mobile-only");
    var snow_canvas_mobile_bg = document.getElementById("snow-canvas-mobile-bg");
    var body = document.body;
    if ($(document).width() <= 750) {
        snow_canvas_mobile = document.getElementById("snow-canvas-mobile");
        $(snow_canvas_mobile).height($(MobileHeader).height() + $(promo_bar__mobile_only).outerHeight());
        $(snow_canvas_mobile_bg).height($(MobileHeader_bar).outerHeight())
    } else {
        snow_canvas_mobile = document.getElementById("snow-canvas-main");
        $(snow_canvas_mobile).height($(site_header).height())
    }
    if ($(snow_canvas_mobile).length > 0 && snow_canvas_mobile.getContext != undefined) {
        $(".MobileHeader-bar").css("background-color", "transparent");
        var snow_canvas_mobile_2d_context = snow_canvas_mobile.getContext("2d");
        var MobileHeader_width;
        var MobileHeader_height;
        var snow_canvas_mobile_width = parseInt($(snow_canvas_mobile).width());
        var snow_canvas_mobile_height = parseInt($(snow_canvas_mobile).height());
        snow_canvas_mobile.width = snow_canvas_mobile_width;
        snow_canvas_mobile.height = snow_canvas_mobile_height;

        function K() {
            if ($(snow_canvas_mobile).attr("id") == "snow-canvas-mobile") {
                MobileHeader_width = $(MobileHeader).width();
                MobileHeader_height = $(MobileHeader).height();
                if (!$(body).hasClass("MobileHeader--fixed")) {
                    MobileHeader_height += $(promo_bar__mobile_only).outerHeight()
                }
                if ($(document).width() > 750) {
                    MobileHeader_width = $(site_header).width();
                    MobileHeader_height = $(site_header).height();
                    $(snow_canvas_mobile).hide();
                    snow_canvas_mobile = document.getElementById("snow-canvas-main");
                    $(snow_canvas_mobile).show()
                }
            } else {
                if ($(snow_canvas_mobile).attr("id") == "snow-canvas-main") {
                    MobileHeader_width = $(site_header).width();
                    MobileHeader_height = $(site_header).height();
                    if ($(document).width() <= 750) {
                        MobileHeader_width = $(MobileHeader).width();
                        MobileHeader_height = $(MobileHeader).height() + $(promo_bar__mobile_only).outerHeight();
                        $(snow_canvas_mobile).hide();
                        snow_canvas_mobile = document.getElementById("snow-canvas-mobile");
                        $(snow_canvas_mobile).show()
                    }
                }
            }
            $(snow_canvas_mobile).attr("width", MobileHeader_width);
            $(snow_canvas_mobile).attr("height", MobileHeader_height);
            $(snow_canvas_mobile).height(MobileHeader_height);
            snow_canvas_mobile_2d_context = snow_canvas_mobile.getContext("2d")
        }

        $(window).resize(K);
        K();
        $(".MobileHeader-search").click(function () {
            setTimeout(function () {
                K()
            }, 300)
        });
        if ($(document).width() <= 750) {
            var F, A;
            $(window).scroll(function () {
                F = true
            });
            setInterval(function () {
                if (F) {
                    var a = $(body).hasClass("MobileHeader--fixed");
                    if (a !== A) {
                        K()
                    }
                    F = false;
                    A = $(body).hasClass("MobileHeader--fixed")
                }
            }, 250)
        }
        var C = 25;
        var i = [];
        for (var B = 0; B < C; B++) {
            i.push({x: Math.random() * MobileHeader_width, y: Math.random() * MobileHeader_height, r: Math.random() * 2 + 1, d: Math.random() * C})
        }

        function P() {
            snow_canvas_mobile_2d_context.clearRect(0, 0, MobileHeader_width, MobileHeader_height - 1);
            if (Math.random() > 0.99) {
                var a = Math.floor((Math.random() * MobileHeader_width));
                snow_canvas_mobile_2d_context.clearRect(a, MobileHeader_height - 1, a + 2, MobileHeader_height)
            }
            snow_canvas_mobile_2d_context.fillStyle = "rgba(255, 255, 255, 0.8)";
            snow_canvas_mobile_2d_context.beginPath();
            for (var c = 0; c < C; c++) {
                var b = i[c];
                snow_canvas_mobile_2d_context.moveTo(b.x, b.y);
                snow_canvas_mobile_2d_context.arc(b.x, b.y, b.r, 0, Math.PI * 2, true)
            }
            snow_canvas_mobile_2d_context.fill();
            N()
        }

        var y = 0;

        function N() {
            y += 0.01;
            for (var b = 0; b < C; b++) {
                var a = i[b];
                a.y += Math.cos(y + a.d) + 1 + a.r / 2;
                a.x += Math.sin(y) * 2;
                if (a.x > MobileHeader_width + 5 || a.x < -5 || a.y > snow_canvas_mobile.height) {
                    if (b % 13 > 0) {
                        i[b] = {x: Math.random() * MobileHeader_width, y: -10, r: a.r, d: a.d}
                    } else {
                        if (Math.sin(y) > 0) {
                            i[b] = {x: -5, y: Math.random() * MobileHeader_height, r: a.r, d: a.d}
                        } else {
                            i[b] = {x: MobileHeader_width + 5, y: Math.random() * MobileHeader_height, r: a.r, d: a.d}
                        }
                    }
                }
            }
        }

        setInterval(P, 33)
    }
});



(function (m) {
    var l;
    var h = 0;
    var j = 3;
    var k = m(".MobileHeader");
    var n = 220;
    m(window).scroll(function () {
        l = true
    });
    setInterval(function () {
        if (l) {
            i();
            l = false
        }
    }, 250);

    function i() {
        if (!m("html").hasClass("scroll-lock")) {
            var a = m(this).scrollTop();
            if (Math.abs(h - a) <= j) {
                return
            }
            if (a > h && a > n) {
                if (!m("#Page").hasClass("Page-mobileheaderopen")) {
                    k.removeClass("nav-down").addClass("nav-up ")
                }
                m("body").addClass("MobileHeader--fixed")
            } else {
                if (a < 3) {
                    m("body").removeClass("MobileHeader--fixed")
                }
                if (a + m(window).height() < m(document).height()) {
                    k.removeClass("nav-up").addClass("nav-down")
                }
            }
            h = a
        }
    }
})(jQuery);

*/