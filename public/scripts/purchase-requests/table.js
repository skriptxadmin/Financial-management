let setSelect2;
let initSelect2;

jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const table$ = form$.find("table");
  const tbodyTpl = jQuery("#tbodyTpl").html();
  const tbody$ = table$.find("tbody");

  // Only add initial row if NOT in edit mode (edit mode handled by form.js)
  if (!form$.attr("data-slug")) {
    tbody$.append(_.template(tbodyTpl));
    setTimeout(() => {
      tbody$.find("tr:eq(0) .btn-delete-row").remove();
    });
  }
  
  setSelect2 = window.setSelect2 = function() {
    tbody$.find("tr").each(function () {
      const item$ = jQuery(this).find("select.item");
      if (!item$.hasClass("select2-hidden-accessible")) {
        initSelect2(item$);
      }
    });
  }

  initSelect2 = function(element) {
    element.select2({
      placeholder: "Search item...",
      minimumInputLength: 2,
      allowClear: true,
      theme: "bootstrap-5",
      ajax: {
        delay: 250,
        transport: function (params, success, failure) {
          const options = {
            url: "/items",
            loader: false,
            data: { search: { value: params.data.q } },
            success: function (response) {
              success(response);
            },
          };
          ajax(options);
        },
        processResults: function (data) {
          return {
            results: data.data.map(function (item) {
              return {
                id: item.slug,
                text: item.name,
              };
            }),
          };
        },
      },
    }).on("select2:select", function (e) {
      const row$ = jQuery(this).closest("tr");

      // 🔥 FIX: if row already has item, create new row and move selection
      if (row$.data("has-item")) {
        const newRow$ = jQuery(_.template(tbodyTpl)());
        tbody$.append(newRow$);
        setSelect2();

        const newSelect$ = newRow$.find(".item");
        newSelect$
          .append(new Option(e.params.data.text, e.params.data.id, true, true))
          .trigger("change");

        // Clear current row (avoid overwrite)
        jQuery(this).val(null).trigger("change");
        return;
      }

      // Mark row as filled
      row$.data("has-item", true);

      // Always keep one empty row at end
      if (row$.is(":last-child")) {
        tbody$.append(_.template(tbodyTpl));
        setSelect2();
      }

      if (parseFloat(row$.find(".quantity").val()) <= 0) {
        row$.find(".quantity").val(1);
      }

      row$.find(".track-change").trigger("change");

    }).on("select2:unselect", function () {
      const row$ = jQuery(this).closest("tr");

      row$.removeData("has-item");

      row$.find(".quantity").val(0);
      row$.find(".price").val(0);
      row$.find(".tax").val(0);

      row$.find(".track-change").trigger("change");
    });
  }

  setSelect2();

  tbody$.on("blur", ".total", function () {
    const lastRow$ = tbody$.find("tr:last");
    const lastItem$ = lastRow$.find(".item");
    if (!lastItem$.val()) {
      return;
    }
    tbody$.append(_.template(tbodyTpl));
    setSelect2();
  });

  tbody$.on("click", ".btn-delete-row", async function () {
    const response = await ratify("Are you sure you want to delete this row?");
    if (!response) return;
    jQuery(this).closest("tr").remove();
    table$.find(".track-change").trigger("change");
  });

  table$.on("change", ".track-change", function () {
    let overallSubtotal = 0;
    let overallTax = 0;
    let overallTotal = 0;

    tbody$.find("tr").each(function () {
      let row$ = jQuery(this);

      let quantity = parseFloat(row$.find(".quantity").val());
      let price = parseFloat(row$.find(".price").val());
      let tax = parseFloat(row$.find(".tax").val());

      if (isNaN(quantity) || quantity <= 0) {
        quantity = 0;
        row$.find(".quantity").val(0);
      }

      if (isNaN(price) || price < 0) {
        price = 0;
        row$.find(".price").val(0);
      }

      if (isNaN(tax) || tax < 0) {
        tax = 0;
        row$.find(".tax").val(0);
      }

      let subtotal = quantity * price;
      let taxAmount = (subtotal * tax) / 100;
      let total = subtotal + taxAmount;

      overallSubtotal += subtotal;
      overallTax += taxAmount;
      overallTotal += total;

      row$.find(".subtotal").val(subtotal.toFixed(2));
      row$.find(".tax_amount").val(taxAmount.toFixed(2));
      row$.find(".total").val(total.toFixed(2));
    });

    let discount = parseFloat(table$.find(".overall-discount").val());

    if (isNaN(discount)) {
      discount = 0;
      table$.find("#discount").val(0);
    }

    let finalPayable = overallTotal - discount;
    if (finalPayable < 0) finalPayable = 0;

    jQuery(".overall-subtotal").val(overallSubtotal.toFixed(2));
    jQuery(".overall-taxes").val(overallTax.toFixed(2));
    jQuery(".overall-total").val(overallTotal.toFixed(2));
    jQuery(".overall-payable").val(finalPayable.toFixed(2));
  });
});
