jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const companyContact$ = form$.find("#companyContact");
  const company$ = form$.find("#company");

  company$.on("change", function () {
    // Clear selected value
    companyContact$.val(null).trigger("change");
  });
  companyContact$.select2({
    placeholder: "Search company contact...",
    minimumInputLength: 2,
    allowClear: true,
    theme: "bootstrap-5",

    ajax: {
      delay: 250,

      transport: function (params, success, failure) {
        const options = {
          url: "/company-contacts",
          loader: false,
          data: {
            search: { value: params.data.q },
            companySlug: company$.val(),
          },
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
});
