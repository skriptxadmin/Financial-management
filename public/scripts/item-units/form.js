jQuery(function () {
  const table$ = jQuery("#itemUnitsTable");
  const form$ = jQuery("form#itemUnitModal");
  const modal$ = bootstrap.Modal.getOrCreateInstance(form$[0], {});

  if (!form$.length) {
    return;
  }

  form$.validate({
    rules: {
      name: {
        required: true,
        minlength: 3,
        maxlength: 20,
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
      };
      const slug = form$.find("#slug").val();
      console.log(slug);
      let options = {
        url: `item-units`,
        method: "POST",
        data: data,
        success: function () {
          modal$.hide();
          table$.trigger("redraw");
        },
      };
      if (slug) {
        options = {
          url: `item-units/${slug}`,
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
