jQuery(function () {
  const form$ = jQuery("form.company");
  if (!form$.length) {
    return;
  }
  const slug = form$.attr("data-slug");
  getCompanyCategories();

  function getCompanyCategories() {
    const options = {
      url: "/company-categories",
      success: function (res) {
        const categories = _.get(res, "categories", []);
        let options$ = `<option value="">Select category</option>`;
        options$ += categories
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#category").html(options$);
        if (slug) {
          getCompany();
        }
      },
    };
    ajax(options);
  }

  function getCompany() {
    const options = {
      url: `/companies/${slug}`,
      success: function (res) {
        const company = _.get(res, "company", {});
        if (_.isEmpty(company)) return;
        form$.find("#name").val(_.get(company, "name", ""));
        form$.find("#website").val(_.get(company, "website", ""));
        form$.find("#email").val(_.get(company, "email", ""));
        form$.find("#phone").val(_.get(company, "phone", ""));
        form$.find("#addressLine1").val(_.get(company, "address_line_1", ""));
        form$.find("#addressLine2").val(_.get(company, "address_line_2", ""));
        form$.find("#pincode").val(_.get(company, "pincode", ""));
        form$.find("#state").val(_.get(company, "location.state", ""));
        form$.find("#city").val(_.get(company, "location.city", ""));
        form$.find("#country").val(_.get(company, "location.country", ""));
        form$.find("#category").val(_.get(company, "category.slug", ""));
        form$.find("#notes").val(_.get(company, "notes", ""));
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
    website: {
      required: true,
      url: true,
    },
    addressLine1: {
      required: true,
      minlength: 5,
      maxlength: 150,
    },
    addressLine2: {
      maxlength: 150,
    },
    state: {
      required: true,
      pattern: /^[A-Za-z\s]+$/,
    },
    city: {
      required: true,
      pattern: /^[A-Za-z\s]+$/,
    },
    country: {
      required: true,
      pattern: /^[A-Za-z\s]+$/,
    },
    pincode: {
      required: true,
      digits: true,
      minlength: 6,
      maxlength: 6,
    },
    status: {
      required: true,
    },
    category: {
      required: true,
    },
    notes:{
      required: false,
      maxlength:250
    }
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
    website: {
      required: "Website is required",
      url: "Enter a valid website URL",
    },
    addressLine1: {
      required: "Address Line 1 is required",
      minlength: "Address must be at least 5 characters",
      maxlength: "Address cannot exceed 150 characters",
    },
    addressLine2: {
      maxlength: "Address cannot exceed 150 characters",
    },
    state: {
      required: "State is required",
      pattern: "State can only contain letters and spaces",
    },
    city: {
      required: "City is required",
      pattern: "City can only contain letters and spaces",
    },
    country: {
      required: "Country is required",
      pattern: "Country can only contain letters and spaces",
    },
    pincode: {
      required: "Pincode is required",
      digits: "Pincode must contain only digits",
      minlength: "Pincode must be 6 digits",
      maxlength: "Pincode must be 6 digits",
    },
    category: {
      required: "Please select a category",
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
        website: form$.find("#website").val(),
        category: form$.find("#category").val(),
        address_line_1: form$.find("#addressLine1").val(),
        address_line_2: form$.find("#addressLine2").val(),
        city: form$.find("#city").val(),
        state: form$.find("#state").val(),
        country: form$.find("#country").val(),
        pincode: form$.find("#pincode").val(),
        notes: form$.find("#notes").val(),
      };
      let options = {
        url: "/companies",
        method: "POST",
        data: data,
      };
      if (slug) {
        options = {
          url: `/companies/${slug}`,
          method: "PUT",
          data: data,
        };
      }

      ajax(options);
    },
  });
});
