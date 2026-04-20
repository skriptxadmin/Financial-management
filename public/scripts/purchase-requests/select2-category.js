jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const category$ = form$.find("#category");

  category$.select2({
    placeholder: "Search category...",
    minimumInputLength: 0,
    allowClear: true,
    
    theme:"bootstrap-5",
    ajax: {
      delay: 250,

      transport: function (params, success, failure) {
        const options = {
          url: "/purchase-categories",
          loader: false,
          data: { search: { value: params.data.q } },
          success: function (response) {
            // PurchaseCategories/GetController::all returns { categories: [...] }
            // We need to wrap it in a format Select2 expects if needed, 
            // but select2 ajax processResults does that.
            success(response);
          },
        };
        ajax(options);
      },

      processResults: function (data) {
        // Convert API response to Select2 format
        // PurchaseCategories returns data in 'categories' key
        const items = data.categories || data.data || [];
        return {
          results: items.map(function (item) {
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
