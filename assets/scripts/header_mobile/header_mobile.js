/*
$(document).ready(function() {
$(".MobileHeader-search").click(function(a) {
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
});


REVISAR TODO ESTE CODIGO:
*/

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




