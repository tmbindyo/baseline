function add_invoice_item(t) {
    if (1 == count && (spositems = {}),
    null != t) {
        var e = 1 == Settings.item_addition ? t.item_id : t.id;
        return spositems[e] ? spositems[e].row.qty = parseFloat(spositems[e].row.qty) + 1 : spositems[e] = t,
            store("spositems", JSON.stringify(spositems)),
            loadItems(),
            !0
    }
}
function loadItems() {
    if (1 == count && (spositems = {}),
        get("spositems")) {
        total = 0,
            count = 1,
            an = 1,
            product_tax = 0,
            invoice_tax = 0,
            product_discount = 0,
            order_discount = 0,
            total_discount = 0,
            $("#posTable tbody").empty();
        var t = (new Date).getTime() / 1e3;
        if (1 != Settings.remote_printing) {
            var e = (n = "C: " + $("#select2-spos_customer-container").text() + "\n") + (s = "R: " + $("#hold_ref").val() + "\n") + (r = "U: " + username + "\n") + (i = "T: " + date(Settings.dateformat + " " + Settings.timeformat, t) + "\n") + "\n";
            order_data.info = e,
                bill_data.info = e;
            var S = ""
                , D = ""
        } else {
            $("#order_span").empty(),
                $("#bill_span").empty();
            var a = "<style>.bb td, .bb th { border-bottom: 1px solid #DDD; }</style>"
                , o = '<span style="text-align:center;"><h3>' + Settings.site_name + "</h3>"
                , n = "<h5>C: " + $("#select2-spos_customer-container").text() + "</h5>"
                , s = "<h5>R: " + $("#hold_ref").val() + "</h5>"
                , r = "<h5>U: " + username + "</h5>"
                , i = "<h5>T: " + date(Settings.dateformat + " " + Settings.timeformat, t) + "</h5>";
            $("#order_span").prepend(a + o + "<h4>" + lang.order + "</h4></span>" + n + s + r + i),
                $("#bill_span").prepend(a + o + "<h4>" + lang.bill + "</h4></span>" + n + s + r + i),
                $("#order-table").empty(),
                $("#bill-table").empty()
        }
        spositems = JSON.parse(get("spositems")),
            $.each(spositems, function() {
                var t = this
                    , e = 1 == Settings.item_addition ? t.item_id : t.id
                    , a = (spositems[e] = t).row.id
                    , o = t.row.type
                    , n = parseFloat(t.row.tax_method)
                    , s = t.combo_items
                    , r = t.row.qty
                    , i = parseFloat(t.row.quantity)
                    , l = (o = t.row.type,
                    t.row.discount)
                    , c = t.row.code
                    , d = t.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;")
                    , p = parseFloat(t.row.real_unit_price)
                    , u = t.row.comment
                    , m = l || "0"
                    , _ = formatDecimal(m);
                if (-1 !== m.indexOf("%")) {
                    var g = m.split("%");
                    isNaN(g[0]) || (_ = formatDecimal(parseFloat(p * parseFloat(g[0]) / 100), 4))
                }
                product_discount += formatDecimal(_ * r, 4),
                    p = formatDecimal(p - _, 4);
                var f = parseFloat(t.row.tax)
                    , v = 0;
                null !== f && 0 != f && (0 == n ? (p -= v = formatDecimal(p * parseFloat(f) / (100 + parseFloat(f)), 4),
                    tax = lang.inclusive) : (v = formatDecimal(p * parseFloat(f) / 100, 4),
                    tax = lang.exclusive)),
                    product_tax += formatDecimal(v * r, 4);
                var h = (new Date).getTime()
                    , y = $('<tr id="' + h + '" class="' + e + '" data-item-id="' + e + '" data-id="' + t.row.id + '"></tr>');
                tr_html = '<td><input name="product_id[]" type="hidden" class="rid" value="' + a + '"><input name="item_comment[]" type="hidden" class="ritem_comment" value="' + u + '"><input name="product_code[]" type="hidden" value="' + t.row.code + '"><input name="product_name[]" type="hidden" value="' + t.row.name + '"><button type="button" class="btn bg-purple btn-block btn-xs edit" id="' + h + '" data-item="' + e + '"><span class="sname" id="name_' + h + '">' + d + " (" + c + ")</span></button></td>",
                    tr_html += '<td class="text-right"><input class="realuprice" name="real_unit_price[]" type="hidden" value="' + t.row.real_unit_price + '"><input class="rdiscount" name="product_discount[]" type="hidden" id="discount_' + h + '" value="' + m + '"><span class="text-right sprice" id="sprice_' + h + '">' + formatMoney(parseFloat(p) + parseFloat(v)) + "</span></td>",
                    tr_html += '<td><input name="item_was_ordered[]" type="hidden" class="riwo" value="0"><input class="form-control input-qty kb-pad text-center rquantity" name="quantity[]" type="text" value="' + formatDecimal(r) + '" data-id="' + h + '" data-item="' + e + '" id="quantity_' + h + '" onClick="this.select();"></td>',
                    tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + h + '">' + formatMoney((parseFloat(p) + parseFloat(v)) * parseFloat(r)) + "</span></td>",
                    tr_html += '<td class="text-center"><i class="fa fa-trash-o tip pointer posdel" id="' + h + '" title="Remove"></i></td>',
                    y.html(tr_html),
                    y.prependTo("#posTable"),
                    total += formatDecimal((parseFloat(p) + parseFloat(v)) * parseFloat(r), 4),
                    count += parseFloat(r),
                    an++;
                var b = $("#list-table-div")[0].scrollHeight;
                $("#list-table-div").slimScroll({
                    scrollTo: b
                }),
                    "standard" == o && i < r ? ($("#" + h).addClass("danger"),
                        $("#" + h).find(".edit").removeClass("bg-purple").addClass("btn-warning")) : "combo" == o && (!1 === s ? $("#" + h).addClass("danger") : $.each(s, function() {
                        parseFloat(this.quantity) < parseFloat(this.qty) * r && ($("#" + h).addClass("danger"),
                            $("#" + h).find(".edit").removeClass("bg-purple").addClass("btn-warning"))
                    }));
                var x = u ? u.split(/\r?\n/g) : [];
                if (1 != Settings.remote_printing) {
                    D += "#" + (an - 1) + " " + d + " (" + c + ")\n";
                    for (var k = 0, w = x.length; k < w; k++)
                        D += 0 < x[k].length ? "   * " + x[k] + "\n" : "";
                    D += printLine(r + " x " + formatMoney(parseFloat(p) + parseFloat(v)) + ": " + formatMoney((parseFloat(p) + parseFloat(v)) * parseFloat(r))) + "\n",
                        S += printLine("#" + (an - 1) + " " + d + " (" + c + "): [ " + parseFloat(r)) + " ]\n";
                    for (k = 0,
                             w = x.length; k < w; k++)
                        S += 0 < x[k].length ? "   * " + x[k] + "\n" : "";
                    S += "\n"
                } else {
                    var M = '<tr class="row_' + e + '" data-item-id="' + e + '"><td colspan="2">#' + (an - 1) + " " + (0 == e ? t.row.name : d + " (" + c + ")");
                    for (k = 0,
                             w = x.length; k < w; k++)
                        M += x[k] ? "<br> <b>*</b> <small>" + x[k] + "</small>" : "";
                    M += "</td></tr>",
                        M += '<tr class="bb row_' + e + '" data-item-id="' + e + '"><td>(' + r + " x " + formatMoney(parseFloat(p) + parseFloat(v)) + ')</td><td style="text-align:right;">' + formatMoney((parseFloat(p) + parseFloat(v)) * parseFloat(r)) + "</td></tr>";
                    var F = '<tr class="bb row_' + e + '" data-item-id="' + e + '"><td>#' + (an - 1) + " " + d + " (" + c + ")";
                    for (k = 0,
                             w = x.length; k < w; k++)
                        F += x[k] ? "<br> <b>*</b> <small>" + x[k] + "</small>" : "";
                    F += "</td><td>[ " + parseFloat(r) + " ]</td></tr>",
                        $("#order-table").append(F),
                        $("#bill-table").append(M)
                }
            });
        var l = get("spos_discount") ? get("spos_discount") : $("#discount_val").val() ? $("#discount_val").val() : "0";
        if (order_discount = parseFloat(l),
        -1 !== l.indexOf("%")) {
            var c = l.split("%");
            order_discount = parseFloat(total * parseFloat(c[0]) / 100)
        }
        var d = get("spos_tax") ? get("spos_tax") : $("#tax_val").val() ? $("#tax_val").val() : "0";
        if (order_tax = parseFloat(d),
        -1 !== d.indexOf("%")) {
            var p = d.split("%");
            order_tax = (total - order_discount) * parseFloat(p[0]) / 100
        }
        var u = total - parseFloat(order_discount) + parseFloat(order_tax);
        if (grand_total = formatMoney(u),
            $("#ds_con").text("(" + formatMoney(product_discount) + ") " + formatMoney(order_discount)),
            $("#ts_con").text(formatMoney(order_tax)),
            $("#total-payable").text(grand_total),
            $("#total").text(formatMoney(total)),
            $("#count").text(an - 1 + " (" + formatMoney(count - 1) + ")"),
        1 != Settings.remote_printing) {
            order_data.items = S,
                bill_data.items = D;
            var m = "";
            if (m += printLine(lang.total + ": " + formatMoney(total)) + "\n",
            (0 < order_discount || 0 < product_discount) && (m += printLine(lang.discount + ": " + formatMoney(order_discount + product_discount)) + "\n"),
            0 != order_tax && (m += printLine(lang.order_tax + ": " + formatMoney(order_tax)) + "\n"),
                m += printLine(lang.grand_total + ": " + formatMoney(u)) + "\n",
            0 != Settings.rounding) {
                round_total = roundNumber(u, parseInt(Settings.rounding));
                var _ = formatDecimal(round_total - u, 4);
                m += printLine(lang.rounding + ": " + formatMoney(_)) + "\n",
                    m += printLine(lang.total_payable + ": " + formatMoney(round_total)) + "\n"
            }
            m += "\n" + lang.total_items + ": " + (an - 1) + " (" + (parseFloat(count) - 1) + ")\n",
                bill_data.totals = m
        } else {
            var g = "";
            if (g += '<tr class="bb"><td>' + lang.total_items + '</td><td style="text-align:right;">' + (an - 1) + " (" + (parseFloat(count) - 1) + ")</td></tr>",
                g += '<tr class="bb"><td>' + lang.total + '</td><td style="text-align:right;">' + formatMoney(total) + "</td></tr>",
            (0 < order_discount || 0 < product_discount) && (g += '<tr class="bb"><td>' + lang.discount + '</td><td style="text-align:right;">' + formatMoney(order_discount + product_discount) + "</td></tr>"),
            0 != order_tax && (g += '<tr class="bb"><td>' + lang.order_tax + '</td><td style="text-align:right;">' + formatMoney(order_tax) + "</td></tr>"),
                g += '<tr class="bb"><td>' + lang.grand_total + '</td><td style="text-align:right;">' + formatMoney(u) + "</td></tr>",
            0 != Settings.rounding) {
                round_total = roundNumber(u, parseInt(Settings.rounding));
                _ = formatDecimal(round_total - u, 4);
                g += '<tr class="bb"><td>' + lang.rounding + '</td><td style="text-align:right;">' + formatMoney(_) + "</td></tr>",
                    g += '<tr class="bb"><td>' + lang.total_payable + '</td><td style="text-align:right;">' + formatMoney(round_total) + "</td></tr>"
            }
            g += '<tr class="bb"><td colspan="2" style="text-align:center;">' + lang.merchant_copy + "</td></tr>",
                $("#bill-total-table").empty(),
                $("#bill-total-table").append(g)
        }
        1 == Settings.display_kb && display_keyboards(),
            $("#add_item").focus()
    }
}
function chr(t) {
    return String.fromCharCode(t)
}
function display_keyboards() {
    jQuery.browser.mobile || ($(".kb-text").keyboard({
        autoAccept: !0,
        alwaysOpen: !1,
        openOn: "focus",
        usePreview: !1,
        layout: "custom",
        display: {
            bksp: "???",
            accept: "return",
            default: "ABC",
            meta1: "123",
            meta2: "#+="
        },
        customLayout: {
            default: ["q w e r t y u i o p {bksp}", "a s d f g h j k l {enter}", "{s} z x c v b n m , . {s}", "{meta1} {space} {cancel} {accept}"],
            shift: ["Q W E R T Y U I O P {bksp}", "A S D F G H J K L {enter}", "{s} Z X C V B N M / ? {s}", "{meta1} {space} {meta1} {accept}"],
            meta1: ["1 2 3 4 5 6 7 8 9 0 {bksp}", "- / : ; ( ) ??? & @ {enter}", "{meta2} . , ? ! ' \" {meta2}", "{default} {space} {default} {accept}"],
            meta2: ["[ ] { } # % ^ * + = {bksp}", "_ \\ | &lt; &gt; $ ?? ?? {enter}", "{meta1} ~ . , ? ! ' \" {meta1}", "{default} {space} {default} {accept}"]
        }
    }),
        $(".kb-pad").keyboard({
            restrictInput: !0,
            preventPaste: !0,
            autoAccept: !0,
            alwaysOpen: !1,
            openOn: "click",
            usePreview: !1,
            layout: "costom",
            display: {
                b: "???:Backspace"
            },
            customLayout: {
                default: ["1 2 3 {b}", "4 5 6 . {clear}", "7 8 9 0 %", "{accept} {cancel}"]
            }
        }))
}
function calTax() {
    var t = get("spos_tax") ? get("spos_tax") : $("#tax_val").val();
    if (-1 !== t.indexOf("%")) {
        var e = t.split("%");
        order_tax = (total - order_discount) * parseFloat(e[0]) / 100,
            $("#ts_con").text(formatMoney(order_tax))
    } else
        order_tax = parseFloat(t),
            $("#ts_con").text(formatMoney(order_tax));
    return order_tax
}
function nav_pointer() {
    var t = "n" == p_page ? 0 : p_page;
    0 == t ? $("#previous").attr("disabled", !0) : $("#previous").attr("disabled", !1),
        t + pro_limit > tcp ? $("#next").attr("disabled", !0) : $("#next").attr("disabled", !1)
}
function Popup(t) {
    createWin(t).then(function(t) {
        t.close()
    })
}
function createWin(o) {
    return new Promise(function(t) {
            var e = '<!DOCTYPE html><html><head><title>Print</title><link rel="stylesheet" href="' + assets + 'bootstrap/css/bootstrap.min.css" type="text/css" /></head><body>' + o + '<script type="text/javascript">window.print();<\/script></body></html>'
                , a = window.open(e, "spos_print", "height=500,width=300");
            a.document.write(e),
                setTimeout(function() {
                    t(a)
                }, 20)
        }
    )
}
function posScreen() {
    var t = $(window).height()
        , e = $("#totaldiv").height()
        , a = $(".botbuttons").height()
        , o = t - 120
        , n = t - 185 - $("#lefttop").outerHeight() - e - a;
    $("#right-col").height(t - 100),
        $(".items").height(400 < o ? o : 400),
        $("#list-table-div").height(n)
}
function printLine(t) {
    var e = parseInt(Settings.char_per_line) - 4
        , a = t.length
        , o = t.split(":")
        , n = o[0];
    for (i = 1; i < e - a; i++)
        n += " ";
    return n += o[1]
}
function read_card() {}
$(document).ready(function() {
    $(document).on("click", ".no-results, #filter-suspended-sales", function(t) {
        t.preventDefault(),
            t.stopPropagation()
    }),
        $("#susModal").on("shown.bs.modal", function(t) {
            $("#reference_note").focus()
        }),
        $("#filter-categories").hideseek({
            nodata: lang.no_match_found
        }),
        $(document).on("click", ".suspended_sales .dropdown-menu .header", function(t) {
            t.stopPropagation()
        }),
        $("#filter-suspended-sales").hideseek({
            nodata: lang.no_match_found
        }),
        $("#suspended_sales").on("shown.bs.dropdown", function() {
            $("#filter-suspended-sales").focus()
        }),
        $(document).on("click", "#update-note", function() {
            var t = $("#snote").val();
            store("spos_note", t),
                $("#note").val(t),
                $("#noteModal").modal("hide")
        }),
        $("#posTable").on("click", ".edit", function() {
            var t = $(this).closest("tr")
                , e = t.attr("id")
                , a = t.attr("data-item-id")
                , o = t.attr("data-id")
                , n = spositems[a]
                , s = formatDecimal(t.find(".realuprice").val())
                , r = s
                , i = n.row.discount ? n.row.discount : "0";
            if (item_discount = formatDecimal(parseFloat(i)),
            -1 !== i.indexOf("%")) {
                var l = i.split("%");
                isNaN(l[0]) || (item_discount = formatDecimal(r * parseFloat(l[0]) / 100))
            }
            r -= item_discount;
            var c = parseFloat(n.row.tax)
                , d = 0
                , p = "";
            null !== c && 0 != c && (p = 0 == parseFloat(n.row.tax_method) ? (r -= d = formatDecimal(r * parseFloat(c) / (100 + parseFloat(c))),
                lang.inclusive) : (d = formatDecimal(r * parseFloat(c) / 100),
                lang.exclusive)),
                console.log(o, a, e),
                $("#proModalLabel").html('<a href="' + base_url + "/products/view/" + o + '" data-toggle="ajax">' + n.label + "</a>"),
                $("#net_price").text(formatMoney(r)),
                $("#pro_tax").text(formatMoney(d)),
                $("#pro_tax_method").text("(" + p + ")"),
                $("#row_id").val(row_id),
                $("#item_id").val(a),
                $("#nPrice").val(s),
                $("#nQuantity").val(n.row.qty),
                $("#nDiscount").val(i),
                $("#nComment").val(n.row.comment),
                $("#proModal").modal({
                    backdrop: "static"
                })
        }),
        $(document).on("change", "#nPrice, #nDiscount", function() {
            var t = $("#item_id").val()
                , e = parseFloat($("#nPrice").val())
                , a = e
                , o = spositems[t]
                , n = $("#nDiscount").val() ? $("#nDiscount").val() : "0";
            if (item_discount = formatDecimal(parseFloat(n)),
            -1 !== n.indexOf("%")) {
                var s = n.split("%");
                isNaN(s[0]) || (item_discount = formatDecimal(e * parseFloat(s[0]) / 100))
            }
            a -= item_discount;
            var r = parseFloat(o.row.tax)
                , i = 0;
            null !== r && 0 != r && (0 == parseFloat(o.row.tax_method) ? (a -= i = formatDecimal(a * parseFloat(r) / (100 + parseFloat(r))),
                tax = lang.inclusive) : (i = formatDecimal(a * parseFloat(r) / 100),
                tax = lang.exclusive)),
                $("#net_price").text(formatMoney(a)),
                $("#pro_tax").text(formatMoney(i))
        }),
        $(document).on("click", "#editItem", function() {
            var t = $("#item_id").val()
                , e = parseFloat($("#nPrice").val());
            if (!is_valid_discount($("#nDiscount").val()))
                return bootbox.alert(lang.unexpected_value),
                    !1;
            spositems[t].row.qty = parseFloat($("#nQuantity").val()),
                spositems[t].row.real_unit_price = e,
                spositems[t].row.comment = $("#nComment").val(),
                spositems[t].row.discount = $("#nDiscount").val() ? $("#nDiscount").val() : "0",
                localStorage.setItem("spositems", JSON.stringify(spositems)),
                $("#proModal").modal("hide"),
                loadItems()
        }),
        $(document).on("change", ".rquantity", function() {
            var t = $(this).closest("tr");
            if (!is_numeric($(this).val()) || 0 == $(this).val())
                return loadItems(),
                    bootbox.alert(lang.unexpected_value),
                    !1;
            var e = parseFloat($(this).val())
                , a = t.attr("data-item-id");
            spositems[a].row.qty = e,
                localStorage.setItem("spositems", JSON.stringify(spositems)),
                loadItems()
        }),
        $("#reset").click(function(t) {
            if (count <= 1)
                return !1;
            1 == protect_delete ? bootbox.dialog({
                title: lang.enter_pin_code,
                closeButton: !0,
                message: '<input id="pos_pin" name="pos_pin" type="password" placeholder="Pin Code" class="form-control kb-pad"> ',
                buttons: {
                    danger: {
                        label: lang.close,
                        className: "btn-default pull-left",
                        callback: function() {}
                    },
                    success: {
                        label: "<i class='fa fa-tick'></i> " + lang.delete,
                        className: "btn-warning verify_pin",
                        callback: function() {
                            md5($("#pos_pin").val()) == Settings.pin_code ? (get("spositems") && remove("spositems"),
                            get("spos_tax") && remove("spos_tax"),
                            get("spos_discount") && remove("spos_discount"),
                            get("spos_customer") && remove("spos_customer"),
                                window.location.href = base_url + "pos") : bootbox.alert(lang.wrong_pin)
                        }
                    }
                }
            }).on("shown.bs.modal", function() {
                1 == Settings.display_kb && display_keyboards(),
                    $("#pos_pin").focus().keypress(function(t) {
                        if (13 == t.keyCode)
                            return t.preventDefault(),
                                $(".verify_pin").trigger("click"),
                                !1
                    })
            }) : bootbox.confirm(lang.r_u_sure, function(t) {
                t && (get("spositems") && remove("spositems"),
                get("spos_tax") && remove("spos_tax"),
                get("spos_discount") && remove("spos_discount"),
                get("spos_customer") && remove("spos_customer"),
                    window.location.href = base_url + "pos")
            })
        }),
        $("#print_order").click(function(t) {
            if (t.preventDefault(),
            count <= 1)
                bootbox.alert(lang.please_add_product);
            else if (0 == Settings.remote_printing)
                if ($("#order-data").show(),
                1 == Settings.print_img) {
                    $("#preo").html('<pre style="background:#FFF;font-size:20px;margin:0;border:0;color:#000 !important;">' + order_data.info + order_data.items + "</pre>");
                    var e = $("#order-data").get(0);
                    html2canvas(e, {
                        scrollY: 0,
                        scale: 1.7
                    }).then(function(t) {
                        var e = t.toDataURL().split(",")[1];
                        $.post(base_url + "pos/receipt_img", {
                            img: e,
                            spos_token: csrf_hash
                        })
                    })
                } else {
                    var a = $("#pos-sale-form").serialize();
                    $.post(base_url + "pos/p/order", a)
                }
            else
                printOrder(order_data);
            return setTimeout(function() {
                $("#order-data").hide()
            }, 500),
                !1
        }),
        $("#print_bill").click(function(t) {
            if (t.preventDefault(),
            count <= 1)
                bootbox.alert(lang.please_add_product);
            else if (0 == Settings.remote_printing)
                if ($("#bill-data").show(),
                1 == Settings.print_img) {
                    $("#preb").html('<pre style="background:#FFF;font-size:20px;margin:0;border:0;color:#000 !important;">' + bill_data.info + bill_data.items + "\n" + bill_data.totals + "</pre>");
                    var e = $("#bill-data").get(0);
                    html2canvas(e, {
                        scrollY: 0,
                        scale: 1.7
                    }).then(function(t) {
                        var e = t.toDataURL().split(",")[1];
                        $.post(base_url + "pos/receipt_img", {
                            img: e,
                            spos_token: csrf_hash
                        })
                    })
                } else {
                    var a = $("#pos-sale-form").serialize();
                    $.post(base_url + "pos/p/bill", a)
                }
            else
                printBill(bill_data);
            return setTimeout(function() {
                $("#bill-data").hide()
            }, 500),
                !1
        }),
        $("#updateDiscount").click(function() {
            var t = $("#get_ds").val() ? $("#get_ds").val() : "0"
                , e = $("input[name=apply_to]:checked").val();
            if (0 != t.length) {
                if ("order" == e)
                    if ($("#discount_val").val(t),
                        store("spos_discount", t),
                    -1 !== t.indexOf("%")) {
                        var a = t.split("%");
                        order_discount = total * parseFloat(a[0]) / 100,
                            order_tax = calTax();
                        var o = total + order_tax - order_discount;
                        grand_total = parseFloat(o),
                            $("#ds_con").text("(" + formatMoney(product_discount) + ") " + formatMoney(order_discount)),
                            $("#total-payable").text(formatMoney(grand_total))
                    } else {
                        order_discount = t,
                            order_tax = calTax();
                        o = total + order_tax - parseFloat(order_discount);
                        grand_total = parseFloat(o),
                            $("#ds_con").text("(" + formatMoney(product_discount) + ") " + formatMoney(order_discount)),
                            $("#total-payable").text(formatMoney(grand_total))
                    }
                else if ("products" == e) {
                    spositems = JSON.parse(get("spositems")),
                        $.each(spositems, function() {
                            this.row.discount = t
                        }),
                        store("spositems", JSON.stringify(spositems))
                }
                loadItems(),
                    $("#dsModal").modal("hide")
            }
        }),
        $("#add_discount").click(function() {
            var t = $("#discount_val").val();
            return $("#get_ds").val(t),
                $("#dsModal").modal({
                    backdrop: "static"
                }),
                !1
        }),
        $("#dsModal").on("shown.bs.modal", function() {
            $("#get_ds").focusToEnd()
        }),
        $("#updateTax").click(function() {
            var t = $("#get_ts").val();
            if (0 != t.length) {
                if ($("#tax_val").val(t),
                    store("spos_tax", t),
                -1 !== t.indexOf("%")) {
                    var e = t.split("%");
                    if (isNaN(e[0])) {
                        $("#get_ts").val("0"),
                            $("#tax_val").val("0");
                        a = total - order_discount;
                        grand_total = parseFloat(a),
                            $("#ts_con").text("0"),
                            $("#total-payable").text(formatMoney(grand_total))
                    } else {
                        order_tax = (total - order_discount) * parseFloat(e[0]) / 100;
                        var a = total + order_tax - order_discount;
                        grand_total = parseFloat(a),
                            $("#ts_con").text(formatMoney(order_tax)),
                            $("#total-payable").text(formatMoney(grand_total))
                    }
                } else if (isNaN(t) || 0 == t) {
                    $("#get_ts").val("0"),
                        $("#tax_val").val("0");
                    a = total - order_discount;
                    grand_total = parseFloat(a),
                        $("#ts_con").text("0"),
                        $("#total-payable").text(formatMoney(grand_total))
                } else {
                    order_tax = t;
                    var a = total + parseFloat(t) - order_discount;
                    grand_total = parseFloat(a),
                        $("#ts_con").text(formatMoney(order_tax)),
                        $("#total-payable").text(formatMoney(grand_total))
                }
                $("#tsModal").modal("hide")
            }
        }),
        $("#add_tax").click(function() {
            var t = $("#tax_val").val();
            return $("#get_ts").val(t),
                $("#tsModal").modal({
                    backdrop: "static"
                }),
                !1
        }),
        $("#tsModal").on("shown.bs.modal", function() {
            $("#get_ts").focusToEnd()
        }),
        $("#noteModal").on("shown.bs.modal", function() {
            $("#snote").focusToEnd()
        }),
        $(document).on("click", ".product", function(t) {
            code = $(this).val(),
                $.ajax({
                    type: "get",
                    url: base_url + "ajax/product/" + code,
                    dataType: "json",
                    success: function(t) {
                        null !== t ? add_invoice_item(t) : bootbox.alert(lang.no_match_found)
                    }
                })
        }),
        $(document).on("click", ".category", function() {
            var t = $(this).attr("id");
            console.log(t)
            console.log(cat_id)
            return cat_id != t && (cat_id = t,
                $.ajax({
                    type: "get",
                    url: base_url + "ajax/subcategory/products/"+t+"/tcp/"+1,
                    header: ('Content-Type', ''),
                    dataType: "json",
                    success: function(t) {
                        p_page = "n",
                            tcp = t.tcp,
                            $(".items").html(t.products),
                            $(".category").removeClass("active"),
                            $("#" + cat_id).addClass("active"),
                            nav_pointer()
                    }
                })),
                !1
        }),
        $("#category-" + cat_id).addClass("active"),
        $("#next").click(function() {
            "n" == p_page && (p_page = 0),
                p_page += pro_limit,
                tcp >= pro_limit && p_page < tcp ? $.ajax({
                    type: "get",
                    url: base_url + "ajax/subcategory/products",
                    header: ('Content-Type', ''),
                    data: {
                        category_id: cat_id,
                        per_page: p_page
                    },
                    dataType: "html",
                    success: function(t) {
                        $(".items").html(t),
                            nav_pointer()
                    }
                }) : p_page -= pro_limit
        }),
        $("#previous").click(function() {
            "n" == p_page && (p_page = 0),
            0 != p_page && (p_page -= pro_limit,
            0 == p_page && (p_page = "n"),
                $.ajax({
                    type: "get",
                    url: base_url + "ajax/subcategory/products",
                    data: {
                        category_id: cat_id,
                        per_page: p_page
                    },
                    dataType: "html",
                    success: function(t) {
                        $(".items").html(t),
                            nav_pointer()
                    }
                }))
        }),
        $("#add_item").autocomplete({
            source: base_url + "pos/suggestions",
            minLength: 1,
            autoFocus: !1,
            delay: 200,
            response: function(t, e) {
                16 <= $(this).val().length && 0 == e.content[0].id ? (bootbox.alert(lang.no_match_found, function() {
                    $("#add_item").focus()
                }),
                    $(this).val("")) : 1 == e.content.length && 0 != e.content[0].id ? (e.item = e.content[0],
                    $(this).data("ui-autocomplete")._trigger("select", "autocompleteselect", e),
                    $(this).autocomplete("close")) : 1 == e.content.length && 0 == e.content[0].id && (bootbox.alert(lang.no_match_found, function() {
                    $("#add_item").focus()
                }),
                    $(this).val(""))
            },
            select: function(t, e) {
                (t.preventDefault(),
                0 !== e.item.id) ? add_invoice_item(e.item) && $(this).val("") : bootbox.alert(lang.no_match_found)
            }
        }),
        $("#add_item").bind("keypress", function(t) {
            13 == t.keyCode && (t.preventDefault(),
                $(this).autocomplete("search"))
        }),
        $("#add_item").focus(),
        $("#gccard_no").inputmask("9999 9999 9999 9999"),
        $("#gift_card_no").inputmask("9999 9999 9999 9999"),
        $("#gcexpiry").inputmask("yyyy-mm-dd", {
            placeholder: "yyyy-mm-dd"
        }),
        $("#genNo").click(function() {
            var t = generateCardNo();
            return $(this).parent().parent(".input-group").children("input").val(t),
                !1
        }),
        $(document).on("click", "#sellGiftCard", function(t) {
            1 == count && (spositems = {}),
                $("#gcModal").modal({
                    backdrop: "static"
                })
        }),
        $(document).on("click", "#addGiftCard", function(t) {
            var e = $("#gccard_no").val()
                , a = $("#gcname").val()
                , o = $("#gcvalue").val()
                , n = parseFloat($("#gcprice").val());
            if (gcexpiry = $("#gcexpiry").val(),
            "" == e || "" == o || "" == n || 0 == o || 0 == n)
                return $("#gcerror").text(lang.file_required_fields),
                    $(".gcerror-con").show(),
                    !1;
            var s = new Array;
            s[0] = e,
                s[1] = o,
                s[2] = gcexpiry,
                $.ajax({
                    type: "get",
                    url: base_url + "gift_cards/sell_gift_card",
                    dataType: "json",
                    data: {
                        gcdata: s
                    },
                    success: function(t) {
                        "success" === t.result ? (spositems[0] = {
                            id: 0,
                            item_id: 0,
                            label: a + " (" + e + ")",
                            row: {
                                id: 0,
                                code: e,
                                name: a,
                                quantity: 1,
                                price: n,
                                real_unit_price: n,
                                tax: 0,
                                qty: 1,
                                type: "manual",
                                discount: "0",
                                comment: ""
                            }
                        },
                            store("spositems", JSON.stringify(spositems)),
                            loadItems(),
                            $("#gcModal").modal("hide"),
                            $("#gccard_no").val(""),
                            $("#gcvalue").val(""),
                            $("#gcprice").val("")) : ($("#gcerror").text(t.message),
                            $(".gcerror-con").show())
                    }
                })
        });
    $(document).on("click", ".posdel", function() {
        var t = $(this).closest("tr")
            , e = t.attr("data-item-id");
        1 == protect_delete ? bootbox.dialog({
            title: lang.enter_pin_code,
            closeButton: !0,
            message: '<input id="pos_pin" name="pos_pin" type="password" placeholder="Pin Code" class="form-control kb-pad"> ',
            buttons: {
                danger: {
                    label: lang.close,
                    className: "btn-default pull-left",
                    callback: function() {}
                },
                success: {
                    label: "<i class='fa fa-tick'></i> " + lang.delete,
                    className: "btn-warning verify_pin",
                    callback: function() {
                        md5($("#pos_pin").val()) == Settings.pin_code ? (delete spositems[e],
                            t.remove(),
                        spositems.hasOwnProperty(e) || (localStorage.setItem("spositems", JSON.stringify(spositems)),
                            loadItems())) : bootbox.alert(lang.wrong_pin)
                    }
                }
            }
        }).on("shown.bs.modal", function() {
            1 == Settings.display_kb && display_keyboards(),
                $("#pos_pin").focus().keypress(function(t) {
                    if (13 == t.keyCode)
                        return t.preventDefault(),
                            $(".verify_pin").trigger("click"),
                            !1
                })
        }) : (delete spositems[e],
            t.remove(),
        spositems.hasOwnProperty(e) || (localStorage.setItem("spositems", JSON.stringify(spositems)),
            loadItems()));
        return !1
    }),
        $("#suspend").click(function() {
            if (count <= 1)
                return bootbox.alert(lang.please_add_product),
                    !1;
            $("#susModal").modal({
                backdrop: "static"
            })
        }),
        $("#suspend_sale").click(function() {
            if (ref = $("#reference_note").val(),
            !ref || "" == ref)
                return bootbox.alert(lang.type_reference_note),
                    !1;
            suspend = $("<span></span>"),
                0 !== sid ? suspend.html('<input type="hidden" name="delete_id" value="' + sid + '" /><input type="hidden" name="suspend" value="yes" /><input type="hidden" name="suspend_note" value="' + ref + '" />') : suspend.html('<input type="hidden" name="suspend" value="yes" /><input type="hidden" name="suspend_note" value="' + ref + '" />'),
                suspend.appendTo("#hidesuspend"),
                $("#pos-sale-form").submit()
        }),
        $("#payment").click(function() {
            if (count <= 1)
                return bootbox.alert(lang.please_add_product),
                    !1;
            if (sid && (suspend = $("<span></span>"),
                suspend.html('<input type="hidden" name="delete_id" value="' + sid + '" />'),
                suspend.appendTo("#hidesuspend")),
                gtotal = formatDecimal(total - order_discount + order_tax),
            0 != Settings.rounding) {
                round_total = roundNumber(gtotal, parseInt(Settings.rounding));
                var t = formatDecimal(round_total - gtotal);
                $("#twt").text(formatMoney(round_total) + " (" + formatMoney(t) + ")"),
                    $("#quick-payable").text(round_total)
            } else
                $("#twt").text(formatMoney(gtotal)),
                    $("#quick-payable").text(gtotal);
            $("#item_count").text(an - 1 + " (" + (count - 1) + ")"),
                $("#order_quantity").val(count - 1),
                $("#order_items").val(an - 1),
                $("#balance").text("0.00"),
                $("#payModal").modal({
                    backdrop: "static"
                })
        }),
        $("#payModal").on("shown.bs.modal", function(t) {
            $("#amount").focus().val(0),
                $("#quick-payable").click()
        }),
        $("#payModal").on("hidden.bs.modal", function(t) {
            $("#amount").val("").change()
        }),
        $("#amount").change(function(t) {
            var e = $(".amount").val();
            $("#total_paying").text(formatMoney(e)),
                0 != Settings.rounding ? ($("#balance").text(formatMoney(e - round_total)),
                    $("#balance_val").val(formatDecimal(e - round_total)),
                    total_paid = e,
                    grand_total = round_total) : ($("#balance").text(formatMoney(e - gtotal)),
                    $("#balance_val").val(formatDecimal(e - gtotal)),
                    total_paid = e,
                    grand_total = gtotal)
        }),
        $("#add-customer").click(function() {
            $("#customerModal").modal({
                backdrop: "static"
            })
        }),
        $("#payModal").on("change", "#paid_by", function() {
            $("#clear-cash-notes").click(),
                $("#amount").val(grand_total);
            var t = $(this).val();
            $("#paid_by_val").val(t);
            var e = formatDecimal(total - order_discount + order_tax);
            if (0 != Settings.rounding)
                var a = formatDecimal(roundNumber(e, parseInt(Settings.rounding)));
            else
                a = formatDecimal(e);
            $("#rpaidby").val(t),
                "gift_card" == t ? ($(".gc").slideDown(),
                    $(".ngc").slideUp("fast"),
                    setTimeout(function() {
                        $("#gift_card_no").focus()
                    }, 10),
                    $("#amount").attr("readonly", !0)) : ($(".ngc").slideDown(),
                    $(".gc").slideUp("fast"),
                    $("#gc_details").html(""),
                    $("#amount").attr("readonly", !1)),
                "cash" == t || "other" == t ? ($(".pcash").slideDown(),
                    $(".pcheque").slideUp("fast"),
                    $(".pcc").slideUp("fast"),
                    setTimeout(function() {
                        $("#amount").focus()
                    }, 10)) : "CC" == t || "stripe" == t ? ($(".pcc").slideDown(),
                    $(".pcheque").slideUp("fast"),
                    $(".pcash").slideUp("fast"),
                    $("#amount").val(a),
                    setTimeout(function() {
                        $("#swipe").val("").focus()
                    }, 10)) : "cheque" == t ? ($(".pcheque").slideDown(),
                    $(".pcc").slideUp("fast"),
                    $(".pcash").slideUp("fast"),
                    $("#amount").val(a),
                    setTimeout(function() {
                        $("#cheque_no").focus()
                    }, 10)) : ($(".pcheque").hide(),
                    $(".pcc").hide(),
                    $(".pcash").hide())
        }),
        $(document).on("change", ".gift_card_no", function() {
            var t = $(this).val() ? $(this).val() : "";
            return "" != t && $.ajax({
                type: "get",
                async: !1,
                url: base_url + "pos/validate_gift_card/" + t,
                dataType: "json",
                success: function(t) {
                    if (!1 === t || t.balance < 0)
                        $("#gift_card_no").parent(".form-group").addClass("has-error"),
                            bootbox.alert(lang.incorrect_gift_card);
                    else {
                        $("#gc_details").html(lang.card_no + ": " + t.card_no + "<br>" + lang.value + ": " + t.value + " - " + lang.balance + ": " + t.balance),
                            $("#gift_card_no").parent(".form-group").removeClass("has-error");
                        var e = gtotal > t.balance ? t.balance : gtotal;
                        $("#amount_val").val(e),
                            $("#amount").val(e)
                    }
                }
            }),
                !1
        }),
        $(document).on("click", "#quick-payable", function() {
            $("#clear-cash-notes").click(),
                $(this).append('<span class="badge">1</span>'),
                $("#amount").val(grand_total)
        }),
        $(document).on("click", ".quick-cash", function() {
            $("#quick-payable").find("span.badge").length && $("#clear-cash-notes").click();
            var t = $(this)
                , e = t.contents().filter(function() {
                return 3 == this.nodeType
            }).text()
                , a = 0 == Settings.thousands_sep ? "" : Settings.thousands_sep
                , o = $("#amount");
            e = 1 * formatDecimal(e.split(a).join("")) + 1 * o.val(),
                o.val(formatDecimal(e)).change().focus();
            var n = t.find("span");
            0 == n.length ? t.append('<span class="badge">1</span>') : n.text(parseInt(n.text()) + 1)
        }),
        $(document).on("click", "#clear-cash-notes", function() {
            $(".quick-cash").find(".badge").remove(),
                $("#amount").val("").change().focus()
        }),
        $("#payModal").on("change", "#amount, #paid_by", function(t) {
            $("#amount_val").val($("#amount").val())
        }),
        $("#payModal").on("blur", "#amount", function(t) {
            $("#amount_val").val($("#amount").val())
        }),
        $("#payModal").on("select2-close", "#paid_by", function(t) {
            $("#paid_by_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_no", function(t) {
            $("#cc_no_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_holder", function(t) {
            $("#cc_holder_val").val($(this).val())
        }),
        $("#payModal").on("change", "#gift_card_no", function(t) {
            $("#paying_gift_card_no_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_month", function(t) {
            $("#cc_month_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_year", function(t) {
            $("#cc_year_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_type", function(t) {
            $("#cc_type_val").val($(this).val())
        }),
        $("#payModal").on("change", "#pcc_cvv2", function(t) {
            $("#cc_cvv2_val").val($(this).val())
        }),
        $("#payModal").on("change", "#cheque_no", function(t) {
            $("#cheque_no_val").val($(this).val())
        }),
        $("#payModal").on("change", "#payment_note", function(t) {
            $("#payment_note_val").val($(this).val())
        }),
        $("#payModal").on("change", "#note", function(t) {
            var e = $(this).val();
            store("spos_note", e),
                $("#spos_note").val(e)
        }),
    (spos_note = get("spos_note")) && ($("#note").val(spos_note),
        $("#snote").val(spos_note)),
        $("#spos_customer").change(function(t) {
            store("spos_customer", $(this).val())
        }),
    (spos_customer = get("spos_customer")) && $("#spos_customer").select2("val", spos_customer),
        $(".treeview").hover(function(t) {
            var e = $(document).height()
                , a = $(this).offset().top
                , o = $(this).find(".treeview-menu");
            e - a < o.height() + 44 ? ($(this).find("a").children("span").addClass("popup"),
                o.addClass("popup")) : ($(this).find("a").children("span").removeClass("popup"),
                o.removeClass("popup"))
        }),
        $("body").click(function(t) {
            $(t.target).hasClass("sidebar-icon") || $(t.target).hasClass("sb") || !$("#categories-list").hasClass("control-sidebar-open") || $("#categories-list").removeClass("control-sidebar-open")
        }),
        $("#submit-sale").click(function() {
            $("#total_items").val(an - 1),
                $("#total_quantity").val(count - 1),
                $("#submit").click()
        });
    var t = $("#hold_ref").val();
    $("#hold_ref").change(function() {
        t = $(this).val(),
            $("#reference_note").val(t)
    }),
        $("#reference_note").change(function() {
            t = $(this).val(),
                $("#hold_ref").val(t)
        }),
        $("#suspend_sale").click(function() {
            return $("#reference_note").val() && ($("#hold_ref").val($("#reference_note").val()),
                $("#total_items").val(an - 1),
                $("#total_quantity").val(count - 1),
                $("#submit").click()),
                !1
        }),
        $("#customer-form").on("submit", function(t) {
            return t.preventDefault(),
                $.ajax({
                    type: "post",
                    url: base_url + "customers/add",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(t) {
                        "success" == t.status ? ($("#spos_customer").append($("<option></option>").attr("value", t.id).text(t.val)),
                            $("#spos_customer").select2("val", t.id),
                            $("#customerModal").modal("hide")) : ($("#c-alert").html(t.msg),
                            $("#c-alert").show())
                    },
                    error: function() {
                        return bootbox.alert(lang.customer_request_failed),
                            !1
                    }
                }),
                !1
        }),
        $("#customerModal").on("hidden.bs.modal", function(t) {
            $("#c-alert").hide(),
                $("#cname").val(""),
                $("#cemail").val(""),
                $("#cphone").val(""),
                $("#cf1").val(""),
                $("#cf2").val("")
        })
}),
    $(document).ready(function(e) {
        window.setTimeout(function() {
            e(".alerts").slideUp()
        }, 15e3),
            e(".alerts").on("click", function(t) {
                e(this).slideUp()
            }),
            e("#list-table-div").slimScroll({
                start: "bottom"
            }),
            e("#category-sidebar-menu").slimScroll({
                width: "100%"
            }),
            e(".items").slimScroll({})
    }),
    $(window).bind("resize", posScreen),
    $.extend($.keyboard.keyaction, {
        enter: function(t) {
            t.$el.is("textarea") ? t.insertText("\r\n") : t.accept()
        }
    }),
    $(document).ready(function() {
        posScreen(),
        1 == Settings.display_kb && display_keyboards(),
            nav_pointer(),
            loadItems(),
            read_card(),
            $(".swipe").keypress(function(t) {
                var e = $(this).val() ? $(this).val() : "";
                if ("" != e && 13 == t.keyCode) {
                    t.preventDefault();
                    var a = new SwipeParserObj(e);
                    if (a.hasTrack1) {
                        var o = null
                            , n = a.account.charAt(0);
                        o = 4 == n ? "Visa" : 5 == n ? "MasterCard" : 3 == n ? "Amex" : 6 == n ? "Discover" : "Visa",
                            $("#pcc_no").val(a.account).change(),
                            $("#pcc_holder").val(a.account_name).change(),
                            $("#pcc_month").val(a.exp_month).change(),
                            $("#pcc_year").val(a.exp_year).change(),
                            $("#pcc_cvv2").val(""),
                            $("#pcc_type").select2("val", o)
                    } else
                        $("#pcc_no").val("").change(),
                            $("#pcc_holder").val("").change(),
                            $("#pcc_month").val("").change(),
                            $("#pcc_year").val("").change(),
                            $("#pcc_cvv2").val("").change(),
                            $("#pcc_type").val("").change();
                    $("#pcc_cvv2").focus()
                }
            }).blur(function(t) {
                $(this).val("")
            }).focus(function(t) {
                $(this).val("")
            }),
            $(document).on("blur", "#pcc_no", function() {
                var t = $(this).val().charAt(0);
                CardType = 4 == t ? "Visa" : 5 == t ? "MasterCard" : 3 == t ? "Amex" : 6 == t ? "Discover" : "Visa",
                    $("#pcc_type").select2("val", CardType)
            }),
            $(".modal").on("hidden.bs.modal", function() {
                $(this).removeData("bs.modal")
            }),
            $("#clearLS").click(function(t) {
                return bootbox.confirm(lang.r_u_sure, function(t) {
                    1 == t && (localStorage.clear(),
                        location.reload())
                }),
                    !1
            }),
        "" != Settings.focus_add_item && shortcut.add(Settings.focus_add_item, function() {
            $("#add_item").focus()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.add_customer && shortcut.add(Settings.add_customer, function() {
            $("#add-customer").trigger("click")
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.toggle_category_slider && shortcut.add(Settings.toggle_category_slider, function() {
            $('[data-toggle="control-sidebar"]').trigger("click")
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.cancel_sale && shortcut.add(Settings.cancel_sale, function() {
            $("#reset").click()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.suspend_sale && shortcut.add(Settings.suspend_sale, function() {
            $("#suspend").trigger("click")
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.print_order && shortcut.add(Settings.print_order, function() {
            $("#print_order").click()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.print_bill && shortcut.add(Settings.print_bill, function() {
            $("#print_bill").click()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.finalize_sale && shortcut.add(Settings.finalize_sale, function() {
            $("#payment").trigger("click")
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.today_sale && shortcut.add(Settings.today_sale, function() {
            $("#today_sale").click()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.open_hold_bills && shortcut.add(Settings.open_hold_bills, function() {
            $("#opened_bills").trigger("click")
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        }),
        "" != Settings.close_register && shortcut.add(Settings.close_register, function() {
            $("#close_register").click()
        }, {
            type: "keydown",
            propagate: !1,
            target: document
        })
    }),
    $.fn.focusToEnd = function() {
        return this.each(function() {
            var t = $(this).val();
            $(this).focus().val("").val(t)
        })
    }
    ,
    $.ajaxSetup({
        cache: !1,
        headers: {
            "cache-control": "no-cache"
        }
    });
//# sourceMappingURL=maps/pos.min.js.map
