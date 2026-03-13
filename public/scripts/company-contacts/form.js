jQuery(function () {
  const form$ = jQuery("form.company-contact");
  if (!form$.length) {
    return;
  }
  const slug = form$.attr("data-slug");
  const companySlug = form$.attr("data-company-slug");

  if (slug) {
    getContact();
  }

  function getContact() {
    const options = {
      url: `/company-contacts/${slug}`,
      success: function (res) {
        const contact = _.get(res, "contact", {});
        if (_.isEmpty(contact)) return;
        form$.find("#name").val(_.get(contact, "name", ""));
        form$.find("#email").val(_.get(contact, "email", ""));
        form$.find("#phone").val(_.get(contact, "phone", ""));
        form$.find("#designation").val(_.get(contact, "designation", ""));
        form$.find("#notes").val(_.get(contact, "notes", ""));
      },
    };
    ajax(options);
  }

  const rules = {
    name: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    email: {
      required: true,
      email: true,
      maxlength: 100,
    },
    phone: {
      required: true,
      minlength: 7,
      maxlength: 15,
      pattern: /^[0-9+\-\s]+$/, // numbers, +, -, spaces
    },
    notes: {
      required: false,
      maxlength: 250,
    },
  };

  const messages = {
    name: {
      required: "Name is required",
      minlength: "Name must be at least 2 characters",
      maxlength: "Name cannot exceed 50 characters",
      pattern: "Name can only contain letters and spaces",
    },
    email: {
      required: "Email is required",
      email: "Enter a valid email address",
      maxlength: "Email cannot exceed 100 characters",
    },
    phone: {
      required: "Phone number is required",
      minlength: "Phone number must be at least 7 characters",
      maxlength: "Phone number cannot exceed 15 characters",
      pattern: "Phone number can contain digits, +, - and spaces",
    },
   
  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
        email: form$.find("#email").val(),
        phone: form$.find("#phone").val(),
        designation: form$.find("#designation").val(),
        company:companySlug,
        notes: form$.find("#notes").val(),
      };
      let options = {
        url: "/company-contacts",
        method: "POST",
        data: data,
      };
      if (slug) {
        options = {
          url: `/company-contacts/${slug}`,
          method: "PUT",
          data: data,
        };
      }

      ajax(options);
    },
  });
});
