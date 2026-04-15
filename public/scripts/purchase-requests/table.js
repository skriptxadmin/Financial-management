tbodyTpl;
jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const table$ = form$.find("table");
  const tbodyTpl = jQuery("#tbodyTpl").html();
  const tbody$ = table$.find("tbody");

  tbody$.append(_.template(tbodyTpl));
  setTimeout(() => {
    tbody$.find("tr:eq(0) .btn-delete-row").remove();
  });
  setSelect2();

  tbody$.on("blur", ".total", function (event) {
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
  });

  table$.on("change", ".track-change", function () {
    let overallSubtotal = 0;
    let overallTax = 0;
    let overallTotal = 0;

    tbody$.find("tr").each(function () {
      let row$ = jQuery(this);

      let quantity = parseFloat(row$.find(".quantity").val());
      let price = parseFloat(row$.find(".price").val());
      let tax = parseFloat(row$.find(".tax").val()); // %

      // Default handling
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

      // Row calculations
      let subtotal = quantity * price;
      let taxAmount = (subtotal * tax) / 100;
      let total = subtotal + taxAmount;

      // Accumulate
      overallSubtotal += subtotal;
      overallTax += taxAmount;
      overallTotal += total;

      // Set row values
      row$.find(".subtotal").val(subtotal.toFixed(2));
      row$.find(".tax_amount").val(taxAmount.toFixed(2));
      row$.find(".total").val(total.toFixed(2));
    });

    // ✅ Discount
    let discount = parseFloat(table$.find(".overall-discount").val());
  
    if (isNaN(discount)) {
      discount = 0;
      table$.find("#discount").val(0);
    }

    // ✅ Final Payable
    let finalPayable = overallTotal - discount;

    // Prevent negative payable
    if (finalPayable < 0) finalPayable = 0;

    // ✅ Set overall fields
    jQuery(".overall-subtotal").val(overallSubtotal.toFixed(2));
    jQuery(".overall-taxes").val(overallTax.toFixed(2));
    jQuery(".overall-total").val(overallTotal.toFixed(2));
    jQuery(".overall-payable").val(finalPayable.toFixed(2));
  });

  function setSelect2() {
    tbody$.find("tr").each(function () {
      const item$ = jQuery(this).find("select.item");
      if (!item$.hasClass("select2-hidden-accessible")) {
        initSelect2(item$);
      }
    });
  }
  function initSelect2(element) {
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
          // Convert API response to Select2 format
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
    });
  }
});
