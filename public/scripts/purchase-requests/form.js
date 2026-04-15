jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const company$ = form$.find("#company");
  const companyContact$ = form$.find("#companyContact");
  const table$ = form$.find("table");

  form$.validate({
    rules: {
      title: {
        required: true,
      },
      company: {
        required: true,
      },
      companyContact: {
        required: true,
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        title: form$.find("#title").val(),
        company: company$.val(),
        companyContact: companyContact$.val(),
        items: [],
        total: toFloat(table$.find(".overall-total").val()),
        tax: toFloat(table$.find(".overall-taxes").val()),
        discount: toFloat(table$.find(".overall-discount").val()),
        payable: toFloat(table$.find(".overall-payable").val()),
        notes:table$.find(".notes").val()
      };

      table$.find("tbody tr").each(function () {
        const tr$ = jQuery(this);

        const temp = {
          item: tr$.find(".item").val(),
          quantity: toFloat(tr$.find(".quantity").val()),
          price: toFloat(tr$.find(".price").val()),
          tax: toFloat(tr$.find(".tax").val()),
          tax_amount: toFloat(tr$.find(".tax_amount").val()),
          subtotal: toFloat(tr$.find(".subtotal").val()),
          total: toFloat(tr$.find(".total").val()),
        };

        if (temp.item) {
          data.items.push(_.cloneDeep(temp));
        }
      });
      const options = {
        url: "/purchase-requests",
        method: "POST",
        data: data,
        success: function (response) {
          console.log(response);
        },
      };
      ajax(options);
    },
  });
});
