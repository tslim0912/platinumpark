$(document).ready(function () {
    if ($("input[name='date'").val() == "")
        $("input[name='date'").val(moment().format("MM/DD/Y"));

    //Add item
    $(".quotation-section-wrapper").on("click", ".btn-add-item", function () {
        $(this).addItem();
    });

    //Delete item
    $(".quotation-section-wrapper").on("click", ".btn-delete-item", function () {
        $(this).deleteItem();
    });

    //Move item
    $(".quotation-section table tbody").initialiseSorting();

    //Item selection prefill
    $(".quotation-section-wrapper").on("change", ".item-id-dropdown", function () {
        var parent = $(this).closest("tr");

        var title = $(this).find(':selected').attr('title');
        $(this).parent("td").find("p").html(title);

        $.post({
            url: itemDetailURL,
            data: {
                contact_id: $("select[name='customer']").val(),
                item_id: $(this).val(),
            },
            success: function (response) {
                if (response != "failed") {
                    if (parent.find(".item-discount").attr("data-old-value") === null || parent.find(".item-discount").attr("data-old-value") === "") {
                        parent.find(".item-discount").val(response.discount).change();
                    }
                    if (parent.find(".item-rate").attr("data-old-value") === null || parent.find(".item-rate").attr("data-old-value") === "") {
                        parent.find(".item-rate").val(response.rate).change();
                    }
                }
            },
        });
    });

    //Update all item discount when change customer contact
    //Also update address
    $("select[name='customer']").change(function () {
        var _this = this;

        $.post({
            url: contactDetailURL,
            data: {
                customer_id: $("select[name='customer']").val(),
            },
            success: function (response) {
                if (response != "failed") {
                    $(_this).closest("form").find("[name='address']").val(response.billing_address);
                    $(_this).closest("form").find("[name='delivery_address']").val(response.delivery_address);
                }
            },
        });

        $("#item-table .item-id").each(function () {
            var parent = $(this).closest("tr");

            $.post({
                url: itemDetailURL+'/'+$(this).val(),
                data: {
                    customer_id: $("select[name='customer']").val(),
                    quantity: parent.find(".item-quantity").val()
                },
                success: function (response) {
                    if (response.status) {
                        parent.find(".item-discount").val(response.discount);
                        parent.find(".item-rate").val(response.amount).change();
                    }
                },
            });
        });
    });

    //Update delivery charges when change delivery state
    $("select[name='delivery_state_id']").change(function () {
        var _this = this;

        $("#item-table .item-id").each(function () {
            var parent = $(this).closest("tr");

            $.post({
                url: deliveryDetailURL+'/'+$(this).val(),
                data: {
                    state_id: $("select[name='delivery_state_id']").val(),
                    quantity: parent.find(".item-quantity").val()
                },
                success: function (response) {
                    if (response.status) {
                        parent.find(".item-weight").val(response.weight);
                        parent.find(".item-charges").val(response.amount).change();
                    }
                },
            });
        });
    });

    //Item discount, rate changed
    $(".quotation-section-wrapper").on("change", ".item-discount, .item-rate", function () {
        var parent = $(this).closest("tr");
        var discount = parseFloat(parent.find(".item-discount").val());
        var quantity = parseFloat(parent.find(".item-quantity").val());
        var rate = parseFloat(parent.find(".item-rate").val());

        var amount = (quantity * rate) * (1 - (discount / 100));

        if (!isNaN(amount)) {
            parent.find(".item-amount").val(amount.toFixed(2)).change();
        }
    });

    //Item quantity, discount, rate changed
    $(".quotation-section-wrapper").on("change", ".item-quantity", function () {
        var parent = $(this).closest("tr");

        $.post({
            url: itemDetailURL+'/'+parent.find('.item-id').val(),
            data: {
                customer_id: $("select[name='customer']").val(),
                quantity: parent.find(".item-quantity").val()
            },
            success: function (response) {
                if (response.status) {
                    parent.find(".item-discount").val(response.discount).change();
                    parent.find(".item-rate").val(response.amount).change();

                    var discount = parseFloat(parent.find(".item-discount").val());
                    var quantity = parseFloat(parent.find(".item-quantity").val());
                    var rate = parseFloat(parent.find(".item-rate").val());

                    var amount = (quantity * rate) * (1 - (discount / 100));

                    if (!isNaN(amount)) {
                        parent.find(".item-amount").val(amount.toFixed(2)).change();
                    }
                }
            },
        });

        
    });

    //Item amount changed
    $(".quotation-section-wrapper").on("change", ".item-amount, .item-discount, .item-weight, .item-charges", function () {
        var total = 0;
        var total_discount = 0;
        var total_charges = 0;

        $(".quotation-section-wrapper .item-amount").each(function () {
            var amount = parseFloat($(this).val());
            if (!isNaN(amount))
                total += amount;
        });

        $(".quotation-section-wrapper .item-discount").each(function () {
            var discount = parseFloat($(this).val());
            var quantity = parseFloat($(this).closest("tr").find(".item-quantity").val());
            var rate = parseFloat($(this).closest("tr").find(".item-rate").val());

            if (!isNaN(discount) && !isNaN(rate))
                total_discount += parseFloat((discount / 100) * (rate * quantity));
        });

        $(".quotation-section-wrapper .item-charges").each(function () {
            var charges = parseFloat($(this).val());
            var quantity = parseFloat($(this).closest('tr').find('.item-quantity').val());

            if (!isNaN(charges))
                total_charges += (charges*quantity);
        });

        total += total_charges;

        $(".quotation-item-total").val(total.toFixed(2));
        $(".quotation-item-total-text").text(total.toFixed(2));

        $(".quotation-item-total-discount").val(total_discount.toFixed(2));
        $(".quotation-item-total-discount-text").text(total_discount.toFixed(2));

        $(".quotation-item-total-charges").val(total_charges.toFixed(2));
        $(".quotation-item-total-charges-text").text(total_charges.toFixed(2));
    });
});

(function ($) {
    $.fn.getSectionID = function () {
        if ($(this).attr("data-section-id")) {
            return $(this).attr("data-section-id");
        } else {
            return $(this).closest("[data-section-id]").attr("data-section-id");
        }
    };

    $.fn.getSection = function () {
        return $("[data-section-id='" + $(this).getSectionID() + "']");
    };

    $.fn.hasTable = function () {
        //return ($(this).find(".body table").length > 0 ? true : false);
        return $(this).hasClass("expand");
    }

    $.fn.initialiseSorting = function () {
        $(this).sortable({
            containment: ".quotation-section-wrapper",
            connectWith: ".connected-sortable:not(.disabled)",
            items: "[data-parent-index]:not(.sortable-disabled)",
            //dropOnEmpty: true,
            tolerance: "intersect",
            start: function (event, ui) {
                var item = $(ui.item);

                var sortable = $(event.target);
                var parent_index = item.attr("data-parent-index");

                /*var sib_before = item.prevAll("[data-parent-index='" + parent_index + "']").first();
                 var sib_before_offset =
                 {
                 x: event.pageX - sib_before.offset().left,
                 y: event.pageY - sib_before.offset().top,
                 };*/
                //console.log(sib_before.offset().top);

                if (parent_index != 0) {
                    $("[data-parent-index]:not([data-parent-index='" + parent_index + "'])").addClass("sortable-disabled");
                    $(".connected-sortable").addClass("disabled");
                } else {
                    $("[data-parent-index]:not([data-parent-index='" + parent_index + "'])").hide();
                }

                //console.log(sib_before.offset().top + sib_before_offset.y);

                //$(window).scrollTop(sib_before.offset().top + sib_before_offset.y);
                //$(window).scrollLeft(sib_before.offset().left + sib_before_offset.X);

                sortable.sortable("refresh");
            },
            stop: function (event, ui) {
                var item = $(ui.item);
                var sortable = $(event.target);
                var parent_index = item.attr("data-parent-index");

                if (parent_index != 0) {
                    $("[data-parent-index]").removeClass("sortable-disabled");
                    $(".connected-sortable").removeClass("disabled");
                } else {
                    $("[data-parent-index]").show();
                }

                sortable.sortable("refresh");
            },
            update: function (event, ui) {
                if (ui.sender == null)
                //if(true)
                {
                    //console.log(event);
                    //console.log(ui);

                    var sortable = $(event.target);
                    var item = $(ui.item);
                    var item_parent = item.parent();
                    var section = item.getSection();
                    var section_id = item.getSectionID();
                    var index = item.attr("data-index");
                    var parent_index = item.attr("data-parent-index");
                    var prev_sib = [];

                    var item_insertAfter = item.prevAll("[data-parent-index='" + parent_index + "'], [data-parent-index^='" + parent_index + "-']").first();
                    if ($("[data-parent-index='" + item_insertAfter.attr("data-index") + "'], [data-parent-index^='" + item_insertAfter.attr("data-index") + "-']").length > 0)
                        item_insertAfter = $("[data-parent-index='" + item_insertAfter.attr("data-index") + "'], [data-parent-index^='" + item_insertAfter.attr("data-index") + "-']").last();
                    /*if(parent_index == 0 && item_insertAfter.length == 0)
                     {
                     item_insertAfter = section.prev().find("[data-parent-index='" + parent_index + "']").last();
                     }*/

                    //Get item previous sibling
                    $("[data-parent-index='" + parent_index + "']").each(function () {
                        if (this === item[0])
                            return false;

                        prev_sib = $(this);
                    });

                    //Return item to position before sorting to get pre-sorting data
                    sortable.sortable("cancel");

                    var x_section = item.getSection();
                    var x_section_id = item.getSectionID();
                    var x_removeAfter = item.prevAll("[data-parent-index='" + parent_index + "'], [data-parent-index^='" + parent_index + "-']").first();
                    var x_post_sib = item.nextAll("[data-parent-index='" + parent_index + "']");
                    var x_seq = item.index();
                    var x_table = item.closest("table");

                    //Detach item
                    var item_detach = item.detach();

                    //Detach item childs
                    var item_child_detach = $("[data-parent-index='" + index + "']").detach();

                    //Close section if have no item
                    if (x_table.find("[data-index]").length == 0)
                        x_table.closest(".quotation-section").removeClass("expand");

                    (x_section.add(x_section.nextAll())).each(function () {
                        var sec_id = $(this).attr("data-section-id");

                        $(this).find("[data-parent-index='" + parent_index + "']").each(function () {
                            if (sec_id != x_section_id || $(this).index() >= x_seq) {
                                $(this).indexDec(parent_index, sec_id);
                            }
                        });
                    });

                    //Update item index
                    var new_index = parent_index + "-1";
                    if (prev_sib.length > 0) {
                        var prev_index = prev_sib.attr("data-index");
                        new_index = prev_index.slice(0, prev_index.lastIndexOf("-") + 1) + (parseInt(prev_index.slice(prev_index.lastIndexOf("-") + 1)) + 1);
                    }
                    item_detach.attr("data-index", new_index);

                    //Update item number
                    if (parent_index == 0) {
                        item_detach.find(".number").text(new_index.substr(new_index.indexOf("-") + 1, new_index.length).replace(/-/g, "."));
                    } else {
                        item_detach.find(".sub_number").text(new_index.substr(new_index.indexOf("-") + 1, new_index.length).replace(/-/g, "."));
                    }

                    //Update item input names
                    item_detach.find("[name^='items[" + x_section_id + "][" + index + "]']").each(function () {
                        var name = $(this).attr("name");
                        var new_name = "items[" + section_id + "][" + new_index + "]" + name.slice(name.lastIndexOf("["));

                        $(this).attr("name", new_name);
                    });

                    //Update item childs index
                    $(item_child_detach.get().reverse()).each(function () {
                        //Update item childs parent-index and index
                        $(this).attr("data-parent-index", new_index);
                        var sub_index = $(this).attr("data-index");
                        var new_sub_index = new_index + sub_index.slice(sub_index.indexOf(index) + index.length);
                        $(this).attr("data-index", new_sub_index);

                        //Update item childs sub_number
                        $(this).find(".sub_number").text(new_sub_index.substr(new_sub_index.indexOf("-") + 1, new_sub_index.length).replace(/-/g, "."));

                        //Update item childs input names
                        $(this).find("[name^='items[" + x_section_id + "][" + sub_index + "]']").each(function () {
                            var name = $(this).attr("name");
                            var new_name = "items[" + section_id + "][" + new_sub_index + "]" + name.slice(name.lastIndexOf("["));

                            $(this).attr("name", new_name);
                        });
                    });

                    $((section.nextAll().add(section)).get().reverse()).each(function () {
                        var sec_id = $(this).attr("data-section-id");

                        $($(this).find("[data-parent-index='" + parent_index + "']").get().reverse()).each(function () {
                            var i = -1;
                            if (item_insertAfter.length > 0)
                                i = item_insertAfter.index();

                            if (sec_id != section_id || $(this).index() > i) {
                                $(this).indexInc(parent_index, sec_id);
                            }
                        });
                    });

                    //Move item
                    if (item_insertAfter.length == 0) {
                        //No siblings before item
                        if ($("[data-index='" + parent_index + "']").length != 0) {
                            //Insert after parent item
                            item_detach.insertAfter($("[data-index='" + parent_index + "']"));
                        } else {
                            //Item is in layer 0, prepend to table
                            item_detach.prependTo(item_parent);
                        }
                    } else {
                        //Insert after sibling
                        item_detach.insertAfter(item_insertAfter);
                    }

                    //Move item childs
                    $(item_child_detach.get().reverse()).each(function () {
                        $(this).insertAfter(item_detach);
                    });
                }
            },
        });
    }

    var blockAdding = false;
    $.fn.addItem = function () {
        if (!blockAdding) {
            var section_id = $(this).getSectionID();
            var section = $(this).getSection();
            var index = $(this).attr("data-target-index") ? $(this).attr("data-target-index") : $(this).closest("[data-index]").attr("data-index");
            var item = section.find("[data-index='" + index + "']");
            var childs = section.find("[data-parent-index='" + index + "']");
            var new_index = index + "-" + (childs.length + 1);

            if (index == 0) {
                var new_index_len = 0;
                section.prevAll().each(function () {
                    new_index_len += $(this).find("[data-parent-index='" + index + "']").length;
                });

                new_index = index + "-" + (new_index_len + childs.length + 1);
            }

            blockAdding = true;
            $.post({
                url: quotationAddItemURL,
                data: {
                    withTable: !section.hasTable(),
                    section_id: section_id,
                    parent_index: index,
                    index: new_index,
                    number: (index == 0 ? new_index.substr(new_index.indexOf("-") + 1, new_index.length).replace(/-/g, ".") : ''),
                    sub_number: (index != 0 ? new_index.substr(new_index.indexOf("-") + 1, new_index.length).replace(/-/g, ".") : ''),
                },
                success: function (response) {
                    //Destroy sortable on current elements
                    $(".quotation-section table tbody").sortable("destroy");

                    if (section.hasTable()) {
                        if (childs.length > 0) {
                            section.find("[data-parent-index='" + index + "'], [data-parent-index^='" + index + "-']").last().after(response);
                        } else {
                            item.after(response);
                        }
                    } else {
                        section.find(".body").html(response);
                        section.addClass("expand");
                    }

                    $(section.nextAll().get().reverse()).each(function () {
                        var sec_id = $(this).attr("data-section-id");

                        $($(this).find("[data-parent-index='" + index + "']").get().reverse()).each(function () {
                            //Update next siblings index
                            var nindex = $(this).attr("data-index");
                            var new_nindex = nindex.slice(0, nindex.lastIndexOf("-") + 1) + (parseInt(nindex.slice(nindex.lastIndexOf("-") + 1)) + 1);
                            $(this).attr("data-index", new_nindex);

                            //Update next siblings number
                            $(this).find(".number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));

                            //Update next siblings input names
                            $(this).find("[name^='items[" + sec_id + "][" + nindex + "]']").each(function () {
                                var name = $(this).attr("name");
                                var new_name = "items[" + sec_id + "][" + new_nindex + "]" + name.slice(name.lastIndexOf("["));

                                $(this).attr("name", new_name);
                            });

                            $($("[data-parent-index='" + nindex + "']").get().reverse()).each(function () {
                                //Update next sibling childs parent-index and index
                                $(this).attr("data-parent-index", new_nindex);
                                var sub_nindex = $(this).attr("data-index");
                                var new_sub_nindex = new_nindex + sub_nindex.slice(sub_nindex.indexOf(nindex) + nindex.length);
                                $(this).attr("data-index", new_sub_nindex);

                                //Update next sibling childs sub_number
                                $(this).find(".sub_number").text(new_sub_nindex.substr(new_sub_nindex.indexOf("-") + 1, new_sub_nindex.length).replace(/-/g, "."));

                                //Update next siblings input names
                                $(this).find("[name^='items[" + sec_id + "][" + sub_nindex + "]']").each(function () {
                                    var name = $(this).attr("name");
                                    var new_name = "items[" + sec_id + "][" + new_sub_nindex + "]" + name.slice(name.lastIndexOf("["));

                                    $(this).attr("name", new_name);
                                });
                            });
                        });
                    });

                    //Re-init sortable
                    $(".quotation-section table tbody").initialiseSorting();

                    //Re-init select2.js
                    $(".select2").select2()

                    blockAdding = false;
                }
            });
        }
    };

    $.fn.deleteItem = function () {
        var section_id = $(this).getSectionID();
        var section = $(this).getSection();
        var index = $(this).attr("data-target-index") ? $(this).attr("data-target-index") : $(this).closest("[data-index]").attr("data-index");
        var item = section.find("[data-index='" + index + "']");
        var childs = section.find("[data-parent-index='" + index + "'], [data-parent-index^='" + index + "-']");
        var parent_index = item.attr("data-parent-index");
        var siblingsWithSub = section.find("[data-parent-index='" + parent_index + "'], [data-parent-index^='" + parent_index + "-']");
        var table = item.closest("table");

        item.remove();
        childs.remove();

        //Rearrange_numbers for current section
        var index_int = parseInt(index.slice(index.lastIndexOf("-") + 1));

        siblingsWithSub.each(function () {
            var sib_index = $(this).attr("data-index");
            var sib_index_npi = sib_index.slice((parent_index + "-").length);
            var sib_index_int = parseInt(sib_index_npi.slice(0, (sib_index_npi.indexOf("-") != -1 ? sib_index_npi.indexOf("-") : undefined)));
            var new_sib_index = parent_index + "-" + (sib_index_int - 1) + sib_index_npi.slice(sib_index_int.toString().length);

            var sib_pindex = $(this).attr("data-parent-index");
            var sib_pindex_npi = sib_pindex.slice((parent_index + "-").length);
            var sib_pindex_int = parseInt(sib_pindex_npi.slice(0, (sib_pindex_npi.indexOf("-") != -1 ? sib_pindex_npi.indexOf("-") : undefined)));
            var new_sib_pindex = parent_index + "-" + (sib_pindex_int - 1) + sib_pindex_npi.slice(sib_pindex_int.toString().length);

            if (sib_index_int > index_int) {
                //Index and parent index
                $(this).attr("data-index", new_sib_index);
                if (parent_index != $(this).attr("data-parent-index"))
                    $(this).attr("data-parent-index", new_sib_pindex);

                //Number and sub_number
                $(this).find(".number:not(:empty), .sub_number:not(:empty)").text(new_sib_index.substr(new_sib_index.indexOf("-") + 1, new_sib_index.length).replace(/-/g, "."));

                //Update next siblings input names
                $(this).find("[name^='items[" + section_id + "][" + sib_index + "]']").each(function () {
                    var name = $(this).attr("name");
                    var new_name = "items[" + section_id + "][" + new_sib_index + "]" + name.slice(name.lastIndexOf("["));

                    $(this).attr("name", new_name);
                });
            }
        });

        //Rearrange number for next sibling sections
        section.nextAll().each(function () {
            var sec_id = $(this).attr("data-section-id");

            $(this).find("[data-parent-index='" + parent_index + "']").each(function () {
                //Update next siblings index
                var nindex = $(this).attr("data-index");
                var new_nindex = nindex.slice(0, nindex.lastIndexOf("-") + 1) + (parseInt(nindex.slice(nindex.lastIndexOf("-") + 1)) - 1);
                $(this).attr("data-index", new_nindex);

                //Update next siblings number
                $(this).find(".number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));

                //Update next siblings input names
                $(this).find("[name^='items[" + sec_id + "][" + nindex + "]']").each(function () {
                    var name = $(this).attr("name");
                    var new_name = "items[" + sec_id + "][" + new_nindex + "]" + name.slice(name.lastIndexOf("["));

                    $(this).attr("name", new_name);
                });

                $("[data-parent-index='" + nindex + "']").each(function () {
                    //Update next sibling childs parent-index and index
                    $(this).attr("data-parent-index", new_nindex);
                    var sub_nindex = $(this).attr("data-index");
                    var new_sub_nindex = new_nindex + sub_nindex.slice(sub_nindex.indexOf(nindex) + nindex.length);
                    $(this).attr("data-index", new_sub_nindex);

                    //Update next sibling childs sub_number
                    $(this).find(".sub_number").text(new_sub_nindex.substr(new_sub_nindex.indexOf("-") + 1, new_sub_nindex.length).replace(/-/g, "."));

                    //Update next siblings input names
                    $(this).find("[name^='items[" + sec_id + "][" + sub_nindex + "]']").each(function () {
                        var name = $(this).attr("name");
                        var new_name = "items[" + sec_id + "][" + new_sub_nindex + "]" + name.slice(name.lastIndexOf("["));

                        $(this).attr("name", new_name);
                    });
                });
            });
        });

        //Close section if have no item
        if (table.find("[data-index]").length == 0)
            table.closest(".quotation-section").removeClass("expand");
    };

    $.fn.indexInc = function (parent_index, sec_id) {
        //Update next siblings index
        var nindex = $(this).attr("data-index");
        var new_nindex = nindex.slice(0, nindex.lastIndexOf("-") + 1) + (parseInt(nindex.slice(nindex.lastIndexOf("-") + 1)) + 1);
        $(this).attr("data-index", new_nindex);

        //Update next siblings number
        if (parent_index == 0) {
            $(this).find(".number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));
        } else {
            $(this).find(".sub_number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));
        }

        //Update next siblings input names
        $(this).find("[name^='items[" + sec_id + "][" + nindex + "]']").each(function () {
            var name = $(this).attr("name");
            var new_name = "items[" + sec_id + "][" + new_nindex + "]" + name.slice(name.lastIndexOf("["));

            $(this).attr("name", new_name);
        });

        $($("[data-parent-index='" + nindex + "']").get().reverse()).each(function () {
            //Update next sibling childs parent-index and index
            $(this).attr("data-parent-index", new_nindex);
            var sub_nindex = $(this).attr("data-index");
            var new_sub_nindex = new_nindex + sub_nindex.slice(sub_nindex.indexOf(nindex) + nindex.length);
            $(this).attr("data-index", new_sub_nindex);

            //Update next sibling childs sub_number
            $(this).find(".sub_number").text(new_sub_nindex.substr(new_sub_nindex.indexOf("-") + 1, new_sub_nindex.length).replace(/-/g, "."));

            //Update next siblings input names
            $(this).find("[name^='items[" + sec_id + "][" + sub_nindex + "]']").each(function () {
                var name = $(this).attr("name");
                var new_name = "items[" + sec_id + "][" + new_sub_nindex + "]" + name.slice(name.lastIndexOf("["));

                $(this).attr("name", new_name);
            });
        });
    };

    $.fn.indexDec = function (parent_index, sec_id) {
        //Update next siblings index
        var nindex = $(this).attr("data-index");
        var new_nindex = nindex.slice(0, nindex.lastIndexOf("-") + 1) + (parseInt(nindex.slice(nindex.lastIndexOf("-") + 1)) - 1);
        $(this).attr("data-index", new_nindex);

        //Update next siblings number
        if (parent_index == 0) {
            $(this).find(".number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));
        } else {
            $(this).find(".sub_number").text(new_nindex.substr(new_nindex.indexOf("-") + 1, new_nindex.length).replace(/-/g, "."));
        }

        //Update next siblings input names
        $(this).find("[name^='items[" + sec_id + "][" + nindex + "]']").each(function () {
            var name = $(this).attr("name");
            var new_name = "items[" + sec_id + "][" + new_nindex + "]" + name.slice(name.lastIndexOf("["));

            $(this).attr("name", new_name);
        });

        $("[data-parent-index='" + nindex + "']").each(function () {
            //Update next sibling childs parent-index and index
            $(this).attr("data-parent-index", new_nindex);
            var sub_nindex = $(this).attr("data-index");
            var new_sub_nindex = new_nindex + sub_nindex.slice(sub_nindex.indexOf(nindex) + nindex.length);
            $(this).attr("data-index", new_sub_nindex);

            //Update next sibling childs sub_number
            $(this).find(".sub_number").text(new_sub_nindex.substr(new_sub_nindex.indexOf("-") + 1, new_sub_nindex.length).replace(/-/g, "."));

            //Update next siblings input names
            $(this).find("[name^='items[" + sec_id + "][" + sub_nindex + "]']").each(function () {
                var name = $(this).attr("name");
                var new_name = "items[" + sec_id + "][" + new_sub_nindex + "]" + name.slice(name.lastIndexOf("["));

                $(this).attr("name", new_name);
            });
        });
    };
})(jQuery);
