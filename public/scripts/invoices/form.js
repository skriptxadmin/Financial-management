jQuery(function () {
  const form$ = jQuery("form.invoice");
  if (!form$.length) {
    return;
  }
  const slug = form$.attr("data-slug");
  getContacts();
  
  function getContacts() {
    const options = {
      url: "/company-contacts",
      success: function (res) {
        const contacts = _.get(res, "contacts", []);
        let options$ = `<option value="">Select Contact</option>`;
        options$ += contacts
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#contact_id").html(options$);
        getCompanies();
      },
    };
    ajax(options);
  }

  function getCompanies() {
    const options = {
      url: "/companies",
      success: function (res) {
        const companies = _.get(res, "companies", []);
        let options$ = `<option value="">Select Company</option>`;
        options$ += companies
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#company_id").html(options$);
      },
    };
    ajax(options);
  }

 

  function getInvoice() {
    const options = {
      url: `/invoices/${slug}`,
      success: function (res) {
        const invoice = _.get(res, "invoice", {});
        if (_.isEmpty(invoice)) return;
        form$.find("#name").val(_.get(invoice, "name", ""));
        form$.find("#company_id").val(_.get(invoice, "company_id", ""));
        form$.find("#contact_id").val(_.get(invoice, "contact_id", ""));
        form$.find("#invoice_number").val(_.get(invoice, "invoice_number", ""));
        form$.find("#invoice_date").val(_.get(invoice, "invoice_date", ""));
        form$.find("#total_price").val(_.get(invoice, "total_price", ""));
        form$.find("#invoice_unique_id").val(_.get(invoice, "invoice_unique_id", ""));
        form$.find("#reference_number").val(_.get(invoice, "reference_number", ""));
        form$.find("#purchase_request_made").val(_.get(invoice, "purchase_request_made", ""));
        form$.find("#purchase_request_id").val(_.get(invoice, "purchase_request_id", ""));
       
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
    company_id: {
      required: true,
    },
    contact_id: {
      required: true,
    },
    invoice_number: {
      required: true,
      minlength: 2,
      maxlength: 50,
    },
    invoice_date: {
      required: true,
      date: true,
    },
    total_price: {
      required: true,
      number: true,
    },
    invoice_unique_id: {
      required: true,
      minlength: 2,
      maxlength: 50,
    },
    reference_number: {
      required: true,
      minlength: 2,
      maxlength: 50,
    },
    purchase_request_made: {
      required: true,
    },
    purchase_request_id: {
      required: true, 
    }
  };
  const messages = {
    name: {
      required: "Item name is required",
      minlength: "Item name must be at least 2 characters",
      maxlength: "Item name cannot exceed 50 characters",
      pattern: "Item name can only contain letters and spaces",
    },
    company_id: {
      required: "Company is required",
    },
    contact_id: {
      required: "Contact is required",
    },
    invoice_number: {
      required: "Invoice number is required",
      minlength: "Invoice number must be at least 2 characters",
      maxlength: "Invoice number cannot exceed 50 characters",
    },
    invoice_date: {
      required: "Invoice date is required",
      date: "Please enter a valid date",
    },
    total_price: {
      required: "Total price is required",
      number: "Please enter a valid number",
    },
    invoice_unique_id: {
      required: "Invoice unique ID is required",
      minlength: "Invoice unique ID must be at least 2 characters",
      maxlength: "Invoice unique ID cannot exceed 50 characters",
    },
    reference_number: {
      required: "Reference number is required",
      minlength: "Reference number must be at least 2 characters",
      maxlength: "Reference number cannot exceed 50 characters",
    },
    purchase_request_made: {
      required: "Purchase request made is required",
    },
    purchase_request_id: {
      required: "Purchase request ID is required",
    }

  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
        company_id: form$.find("#company_id").val(),
        contact_id: form$.find("#contact_id").val(),
        invoice_number: form$.find("#invoice_number").val(),
        invoice_date: form$.find("#invoice_date").val(),
        total_price: form$.find("#total_price").val(),
        invoice_unique_id: form$.find("#invoice_unique_id").val(),
        reference_number: form$.find("#reference_number").val(),
        purchase_request_made: form$.find("#purchase_request_made").val(),
        purchase_request_id: form$.find("#purchase_request_id").val()
      };
    
     
      let options = {
        url: "/invoices",
        method: "POST",
        data: data,
      };
      if (slug) {
        options = {
          url: `/invoices/${slug}`,
          method: "PUT",
          data: data,
        };
      }
      ajax(options);
    },
  });
});
