jQuery(function () {
  const table$ = jQuery("#purchaseCategoriesTable");
  const form$ = jQuery("form#purchaseCategoryModal");
  const modal$ = bootstrap.Modal.getOrCreateInstance(form$[0], {});
  const headUser$ = form$.find("#head_user_id");

  if (!form$.length) {
    return;
  }

  // Initialize Select2 for head_user_id
  headUser$.select2({
    theme: "bootstrap-5",
    dropdownParent: form$,
    ajax: {
      url: `${appLocals.ajax}/users`,
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          search: { value: params.term },
          length: 10,
          start: 0,
        };
      },
      processResults: function (response) {
        return {
          results: response.data.map((user) => ({
            id: user.id,
            text: `${user.firstname} ${user.lastname}`,
          })),
        };
      },
      cache: true,
    },
    placeholder: "Select Head User",
    minimumInputLength: 0,
    allowClear: true,
  });

  form$.validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
        maxlength: 50,
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
        head_user_id: headUser$.val(),
      };
      const slug = form$.find("#slug").val();

      let options = {
        url: `purchase-categories`,
        method: "POST",
        data: data,
        success: function () {
          modal$.hide();
          table$.trigger("redraw");
        },
      };
      if (slug) {
        options = {
          url: `purchase-categories/${slug}`,
          method: "PUT",
          data: data,
          success: function () {
            modal$.hide();
            table$.trigger("redraw");
          },
        };
      }
      ajax(options);
    },
  });
});
