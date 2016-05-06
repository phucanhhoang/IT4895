﻿/*!
 Colorbox 1.6.3
 license: MIT
 http://www.jacklmoore.com/colorbox
 */
!function (t, e, i) {
    function n(t) {
        var e = {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#039;"};
        return t.replace(/[&<>"']/g, function (t) {
            return e[t]
        })
    }

    function o(i, n, o) {
        var r = e.createElement(i);
        return n && (r.id = tt + n), o && (r.style.cssText = o), t(r)
    }

    function r() {
        return i.innerHeight ? i.innerHeight : t(i).height()
    }

    function h(e, i) {
        i !== Object(i) && (i = {}), this.cache = {}, this.el = e, this.value = function (e) {
            var n;
            return void 0 === this.cache[e] && (n = t(this.el).attr("data-cbox-" + e), void 0 !== n ? this.cache[e] = n : void 0 !== i[e] ? this.cache[e] = i[e] : void 0 !== Y[e] && (this.cache[e] = Y[e])), this.cache[e]
        }, this.get = function (e) {
            var i = this.value(e);
            return t.isFunction(i) ? i.call(this.el, this) : i
        }
    }

    function a(t) {
        var e = E.length, i = (q + t) % e;
        return 0 > i ? e + i : i
    }

    function s(t, e) {
        return Math.round((/%/.test(t) ? ("x" === e ? I.width() : r()) / 100 : 1) * parseInt(t, 10))
    }

    function l(t, e) {
        return t.get("photo") || t.get("photoRegex").test(e)
    }

    function d(t, e) {
        return t.get("retinaUrl") && i.devicePixelRatio > 1 ? e.replace(t.get("photoRegex"), t.get("retinaSuffix")) : e
    }

    function c(t) {
        "contains" in y[0] && !y[0].contains(t.target) && t.target !== x[0] && (t.stopPropagation(), y.focus())
    }

    function g(t) {
        g.str !== t && (y.add(x).removeClass(g.str).addClass(t), g.str = t)
    }

    function u(e) {
        q = 0, e && e !== !1 && "nofollow" !== e ? (E = t("." + et).filter(function () {
            var i = t.data(this, Z), n = new h(this, i);
            return n.get("rel") === e
        }), q = E.index(j.el), -1 === q && (E = E.add(j.el), q = E.length - 1)) : E = t(j.el)
    }

    function f(i) {
        t(e).trigger(i), st.triggerHandler(i)
    }

    function p(i) {
        var n;
        if (!Q) {
            if (n = t(i).data(Z), j = new h(i, n), u(j.get("rel")), !$) {
                $ = G = !0, g(j.get("className")), y.css({
                    visibility: "hidden",
                    display: "block",
                    opacity: ""
                }), M = o(lt, "LoadedContent", "width:0; height:0; overflow:hidden; visibility:hidden"), T.css({
                    width: "",
                    height: ""
                }).append(M), D = C.height() + W.height() + T.outerHeight(!0) - T.height(), N = H.width() + k.width() + T.outerWidth(!0) - T.width(), z = M.outerHeight(!0), A = M.outerWidth(!0);
                var r = s(j.get("initialWidth"), "x"), a = s(j.get("initialHeight"), "y"), l = j.get("maxWidth"), d = j.get("maxHeight");
                j.w = Math.max((l !== !1 ? Math.min(r, s(l, "x")) : r) - A - N, 0), j.h = Math.max((d !== !1 ? Math.min(a, s(d, "y")) : a) - z - D, 0), M.css({
                    width: "",
                    height: j.h
                }), V.position(), f(it), j.get("onOpen"), _.add(R).hide(), y.focus(), j.get("trapFocus") && e.addEventListener && (e.addEventListener("focus", c, !0), st.one(ht, function () {
                    e.removeEventListener("focus", c, !0)
                })), j.get("returnFocus") && st.one(ht, function () {
                    t(j.el).focus()
                })
            }
            var p = parseFloat(j.get("opacity"));
            x.css({
                opacity: p === p ? p : "",
                cursor: j.get("overlayClose") ? "pointer" : "",
                visibility: "visible"
            }).show(), j.get("closeButton") ? O.html(j.get("close")).appendTo(T) : O.appendTo("<div/>"), v()
        }
    }

    function m() {
        y || (X = !1, I = t(i), y = o(lt).attr({
            id: Z,
            "class": t.support.opacity === !1 ? tt + "IE" : "",
            role: "dialog",
            tabindex: "-1"
        }).hide(), x = o(lt, "Overlay").hide(), F = t([o(lt, "LoadingOverlay")[0], o(lt, "LoadingGraphic")[0]]), b = o(lt, "Wrapper"), T = o(lt, "Content").append(R = o(lt, "Title"), S = o(lt, "Current"), B = t('<button type="button"/>').attr({id: tt + "Previous"}), P = t('<button type="button"/>').attr({id: tt + "Next"}), K = o("button", "Slideshow"), F), O = t('<button type="button"/>').attr({id: tt + "Close"}), b.append(o(lt).append(o(lt, "TopLeft"), C = o(lt, "TopCenter"), o(lt, "TopRight")), o(lt, !1, "clear:left").append(H = o(lt, "MiddleLeft"), T, k = o(lt, "MiddleRight")), o(lt, !1, "clear:left").append(o(lt, "BottomLeft"), W = o(lt, "BottomCenter"), o(lt, "BottomRight"))).find("div div").css({"float": "left"}), L = o(lt, !1, "position:absolute; width:9999px; visibility:hidden; display:none; max-width:none;"), _ = P.add(B).add(S).add(K)), e.body && !y.parent().length && t(e.body).append(x, y.append(b, L))
    }

    function w() {
        function i(t) {
            t.which > 1 || t.shiftKey || t.altKey || t.metaKey || t.ctrlKey || (t.preventDefault(), p(this))
        }

        return y ? (X || (X = !0, P.click(function () {
            V.next()
        }), B.click(function () {
            V.prev()
        }), O.click(function () {
            V.close()
        }), x.click(function () {
            j.get("overlayClose") && V.close()
        }), t(e).bind("keydown." + tt, function (t) {
            var e = t.keyCode;
            $ && j.get("escKey") && 27 === e && (t.preventDefault(), V.close()), $ && j.get("arrowKey") && E[1] && !t.altKey && (37 === e ? (t.preventDefault(), B.click()) : 39 === e && (t.preventDefault(), P.click()))
        }), t.isFunction(t.fn.on) ? t(e).on("click." + tt, "." + et, i) : t("." + et).live("click." + tt, i)), !0) : !1
    }

    function v() {
        var e, n, r, h = V.prep, a = ++dt;
        if (G = !0, U = !1, f(at), f(nt), j.get("onLoad"), j.h = j.get("height") ? s(j.get("height"), "y") - z - D : j.get("innerHeight") && s(j.get("innerHeight"), "y"), j.w = j.get("width") ? s(j.get("width"), "x") - A - N : j.get("innerWidth") && s(j.get("innerWidth"), "x"), j.mw = j.w, j.mh = j.h, j.get("maxWidth") && (j.mw = s(j.get("maxWidth"), "x") - A - N, j.mw = j.w && j.w < j.mw ? j.w : j.mw), j.get("maxHeight") && (j.mh = s(j.get("maxHeight"), "y") - z - D, j.mh = j.h && j.h < j.mh ? j.h : j.mh), e = j.get("href"), J = setTimeout(function () {
                F.show()
            }, 100), j.get("inline")) {
            var c = t(e);
            r = t("<div>").hide().insertBefore(c), st.one(at, function () {
                r.replaceWith(c)
            }), h(c)
        } else j.get("iframe") ? h(" ") : j.get("html") ? h(j.get("html")) : l(j, e) ? (e = d(j, e), U = j.get("createImg"), t(U).addClass(tt + "Photo").bind("error." + tt, function () {
            h(o(lt, "Error").html(j.get("imgError")))
        }).one("load", function () {
            a === dt && setTimeout(function () {
                var e;
                j.get("retinaImage") && i.devicePixelRatio > 1 && (U.height = U.height / i.devicePixelRatio, U.width = U.width / i.devicePixelRatio), j.get("scalePhotos") && (n = function () {
                    U.height -= U.height * e, U.width -= U.width * e
                }, j.mw && U.width > j.mw && (e = (U.width - j.mw) / U.width, n()), j.mh && U.height > j.mh && (e = (U.height - j.mh) / U.height, n())), j.h && (U.style.marginTop = Math.max(j.mh - U.height, 0) / 2 + "px"), E[1] && (j.get("loop") || E[q + 1]) && (U.style.cursor = "pointer", t(U).bind("click." + tt, function () {
                    V.next()
                })), U.style.width = U.width + "px", U.style.height = U.height + "px", h(U)
            }, 1)
        }), U.src = e) : e && L.load(e, j.get("data"), function (e, i) {
            a === dt && h("error" === i ? o(lt, "Error").html(j.get("xhrError")) : t(this).contents())
        })
    }

    var x, y, b, T, C, H, k, W, E, I, M, L, F, R, S, K, P, B, O, _, j, D, N, z, A, q, U, $, G, Q, J, V, X, Y = {
        html: !1,
        photo: !1,
        iframe: !1,
        inline: !1,
        transition: "elastic",
        speed: 300,
        fadeOut: 300,
        width: !1,
        initialWidth: "600",
        innerWidth: !1,
        maxWidth: !1,
        height: !1,
        initialHeight: "450",
        innerHeight: !1,
        maxHeight: !1,
        scalePhotos: !0,
        scrolling: !0,
        opacity: .9,
        preloading: !0,
        className: !1,
        overlayClose: !0,
        escKey: !0,
        arrowKey: !0,
        top: !1,
        bottom: !1,
        left: !1,
        right: !1,
        fixed: !1,
        data: void 0,
        closeButton: !0,
        fastIframe: !0,
        open: !1,
        reposition: !0,
        loop: !0,
        slideshow: !1,
        slideshowAuto: !0,
        slideshowSpeed: 2500,
        slideshowStart: "start slideshow",
        slideshowStop: "stop slideshow",
        photoRegex: /\.(gif|png|jp(e|g|eg)|bmp|ico|webp|jxr|svg)((#|\?).*)?$/i,
        retinaImage: !1,
        retinaUrl: !1,
        retinaSuffix: "@2x.$1",
        current: "image {current} of {total}",
        previous: "previous",
        next: "next",
        close: "close",
        xhrError: "This content failed to load.",
        imgError: "This image failed to load.",
        returnFocus: !0,
        trapFocus: !0,
        onOpen: !1,
        onLoad: !1,
        onComplete: !1,
        onCleanup: !1,
        onClosed: !1,
        rel: function () {
            return this.rel
        },
        href: function () {
            return t(this).attr("href")
        },
        title: function () {
            return this.title
        },
        createImg: function () {
            var e = new Image, i = t(this).data("cbox-img-attrs");
            return "object" == typeof i && t.each(i, function (t, i) {
                e[t] = i
            }), e
        },
        createIframe: function () {
            var i = e.createElement("iframe"), n = t(this).data("cbox-iframe-attrs");
            return "object" == typeof n && t.each(n, function (t, e) {
                i[t] = e
            }), "frameBorder" in i && (i.frameBorder = 0), "allowTransparency" in i && (i.allowTransparency = "true"), i.name = (new Date).getTime(), i.allowFullscreen = !0, i
        }
    }, Z = "colorbox", tt = "cbox", et = tt + "Element", it = tt + "_open", nt = tt + "_load", ot = tt + "_complete", rt = tt + "_cleanup", ht = tt + "_closed", at = tt + "_purge", st = t("<a/>"), lt = "div", dt = 0, ct = {}, gt = function () {
        function t() {
            clearTimeout(h)
        }

        function e() {
            (j.get("loop") || E[q + 1]) && (t(), h = setTimeout(V.next, j.get("slideshowSpeed")))
        }

        function i() {
            K.html(j.get("slideshowStop")).unbind(s).one(s, n), st.bind(ot, e).bind(nt, t), y.removeClass(a + "off").addClass(a + "on")
        }

        function n() {
            t(), st.unbind(ot, e).unbind(nt, t), K.html(j.get("slideshowStart")).unbind(s).one(s, function () {
                V.next(), i()
            }), y.removeClass(a + "on").addClass(a + "off")
        }

        function o() {
            r = !1, K.hide(), t(), st.unbind(ot, e).unbind(nt, t), y.removeClass(a + "off " + a + "on")
        }

        var r, h, a = tt + "Slideshow_", s = "click." + tt;
        return function () {
            r ? j.get("slideshow") || (st.unbind(rt, o), o()) : j.get("slideshow") && E[1] && (r = !0, st.one(rt, o), j.get("slideshowAuto") ? i() : n(), K.show())
        }
    }();
    t[Z] || (t(m), V = t.fn[Z] = t[Z] = function (e, i) {
        var n, o = this;
        return e = e || {}, t.isFunction(o) && (o = t("<a/>"), e.open = !0), o[0] ? (m(), w() && (i && (e.onComplete = i), o.each(function () {
            var i = t.data(this, Z) || {};
            t.data(this, Z, t.extend(i, e))
        }).addClass(et), n = new h(o[0], e), n.get("open") && p(o[0])), o) : o
    }, V.position = function (e, i) {
        function n() {
            C[0].style.width = W[0].style.width = T[0].style.width = parseInt(y[0].style.width, 10) - N + "px", T[0].style.height = H[0].style.height = k[0].style.height = parseInt(y[0].style.height, 10) - D + "px"
        }

        var o, h, a, l = 0, d = 0, c = y.offset();
        if (I.unbind("resize." + tt), y.css({
                top: -9e4,
                left: -9e4
            }), h = I.scrollTop(), a = I.scrollLeft(), j.get("fixed") ? (c.top -= h, c.left -= a, y.css({position: "fixed"})) : (l = h, d = a, y.css({position: "absolute"})), d += j.get("right") !== !1 ? Math.max(I.width() - j.w - A - N - s(j.get("right"), "x"), 0) : j.get("left") !== !1 ? s(j.get("left"), "x") : Math.round(Math.max(I.width() - j.w - A - N, 0) / 2), l += j.get("bottom") !== !1 ? Math.max(r() - j.h - z - D - s(j.get("bottom"), "y"), 0) : j.get("top") !== !1 ? s(j.get("top"), "y") : Math.round(Math.max(r() - j.h - z - D, 0) / 2), y.css({
                top: c.top,
                left: c.left,
                visibility: "visible"
            }), b[0].style.width = b[0].style.height = "9999px", o = {
                width: j.w + A + N,
                height: j.h + z + D,
                top: l,
                left: d
            }, e) {
            var g = 0;
            t.each(o, function (t) {
                return o[t] !== ct[t] ? void(g = e) : void 0
            }), e = g
        }
        ct = o, e || y.css(o), y.dequeue().animate(o, {
            duration: e || 0, complete: function () {
                n(), G = !1, b[0].style.width = j.w + A + N + "px", b[0].style.height = j.h + z + D + "px", j.get("reposition") && setTimeout(function () {
                    I.bind("resize." + tt, V.position)
                }, 1), t.isFunction(i) && i()
            }, step: n
        })
    }, V.resize = function (t) {
        var e;
        $ && (t = t || {}, t.width && (j.w = s(t.width, "x") - A - N), t.innerWidth && (j.w = s(t.innerWidth, "x")), M.css({width: j.w}), t.height && (j.h = s(t.height, "y") - z - D), t.innerHeight && (j.h = s(t.innerHeight, "y")), t.innerHeight || t.height || (e = M.scrollTop(), M.css({height: "auto"}), j.h = M.height()), M.css({height: j.h}), e && M.scrollTop(e), V.position("none" === j.get("transition") ? 0 : j.get("speed")))
    }, V.prep = function (i) {
        function r() {
            return j.w = j.w || M.width(), j.w = j.mw && j.mw < j.w ? j.mw : j.w, j.w
        }

        function s() {
            return j.h = j.h || M.height(), j.h = j.mh && j.mh < j.h ? j.mh : j.h, j.h
        }

        if ($) {
            var c, u = "none" === j.get("transition") ? 0 : j.get("speed");
            M.remove(), M = o(lt, "LoadedContent").append(i), M.hide().appendTo(L.show()).css({
                width: r(),
                overflow: j.get("scrolling") ? "auto" : "hidden"
            }).css({height: s()}).prependTo(T), L.hide(), t(U).css({"float": "none"}), g(j.get("className")), c = function () {
                function i() {
                    t.support.opacity === !1 && y[0].style.removeAttribute("filter")
                }

                var o, r, s = E.length;
                $ && (r = function () {
                    clearTimeout(J), F.hide(), f(ot), j.get("onComplete")
                }, R.html(n(j.get("title"))).show(), M.show(), s > 1 ? ("string" == typeof j.get("current") && S.html(j.get("current").replace("{current}", q + 1).replace("{total}", s)).show(), P[j.get("loop") || s - 1 > q ? "show" : "hide"]().html(j.get("next")), B[j.get("loop") || q ? "show" : "hide"]().html(j.get("previous")), gt(), j.get("preloading") && t.each([a(-1), a(1)], function () {
                    var i, n = E[this], o = new h(n, t.data(n, Z)), r = o.get("href");
                    r && l(o, r) && (r = d(o, r), i = e.createElement("img"), i.src = r)
                })) : _.hide(), j.get("iframe") ? (o = j.get("createIframe"), j.get("scrolling") || (o.scrolling = "no"), t(o).attr({
                    src: j.get("href"),
                    "class": tt + "Iframe"
                }).one("load", r).appendTo(M), st.one(at, function () {
                    o.src = "//about:blank"
                }), j.get("fastIframe") && t(o).trigger("load")) : r(), "fade" === j.get("transition") ? y.fadeTo(u, 1, i) : i())
            }, "fade" === j.get("transition") ? y.fadeTo(u, 0, function () {
                V.position(0, c)
            }) : V.position(u, c)
        }
    }, V.next = function () {
        !G && E[1] && (j.get("loop") || E[q + 1]) && (q = a(1), p(E[q]))
    }, V.prev = function () {
        !G && E[1] && (j.get("loop") || q) && (q = a(-1), p(E[q]))
    }, V.close = function () {
        $ && !Q && (Q = !0, $ = !1, f(rt), j.get("onCleanup"), I.unbind("." + tt), x.fadeTo(j.get("fadeOut") || 0, 0), y.stop().fadeTo(j.get("fadeOut") || 0, 0, function () {
            y.hide(), x.hide(), f(at), M.remove(), setTimeout(function () {
                Q = !1, f(ht), j.get("onClosed")
            }, 1)
        }))
    }, V.remove = function () {
        y && (y.stop(), t[Z].close(), y.stop(!1, !0).remove(), x.remove(), Q = !1, y = null, t("." + et).removeData(Z).removeClass(et), t(e).unbind("click." + tt).unbind("keydown." + tt))
    }, V.element = function () {
        return t(j.el)
    }, V.settings = Y)
}(jQuery, document, window);