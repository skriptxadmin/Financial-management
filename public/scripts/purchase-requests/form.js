jQuery(function () {
  const form$ = jQuery("form.purchase-request");

  if (!form$.length) return;

  const company$ = form$.find("#company");
  const companyContact$ = form$.find("#companyContact");
  const category$ = form$.find("#category");
  const table$ = form$.find("table");

  const slug = form$.attr("data-slug");

  if(slug) {
    const options = {
        url: `/purchase-requests/${slug}`,    
        success: function (response) {
       
            form$.find("#title").val(_.get(response, "title", ""));
            const company = _.get(response, "company", null);
            if(company) {
              const option = new Option(company.name, company.slug, true, true);
              company$.append(option).trigger("change");
            }
            const companyContact = _.get(response, "company_contact", null);  
            if(companyContact) {
              const option = new Option(companyContact.name, companyContact.slug, true, true);
              companyContact$.append(option).trigger("change");
            }

            const category = _.get(response, "category", null);
            if(category) {
              const option = new Option(category.name, category.slug, true, true);
              category$.append(option).trigger("change");
            }

            form$.find("#notes").val(_.get(response, "notes", ""));
            form$.find(".overall-discount").val(_.get(response, "discount", 0)).trigger("change");

            const items = _.get(response, "items", []);
            const tbody$ = table$.find("tbody");
            const tbodyTpl = jQuery("#tbodyTpl").html();

            tbody$.empty(); 

            // 1. Pre-fill existing items
            _.each(items, function(itemData) {
              const row$ = jQuery(_.template(tbodyTpl)());
              tbody$.append(row$);
              
              row$.data("has-item", true);

              const itemSelect$ = row$.find(".item");
              const item = _.get(itemData, "item", null);
              if(item) {
                itemSelect$.append(new Option(item.name, item.slug, true, true));
              }

              const price = toFloat(_.get(itemData, "price", 0));
              const subtotal = toFloat(_.get(itemData, "subtotal", 0));
              const quantity = price > 0 ? (subtotal / price) : 0;

              row$.find(".quantity").val(quantity);
              row$.find(".price").val(price);
              row$.find(".tax").val(_.get(itemData, "tax", 0));
            });

            // 2. Add the mandatory extra empty row
            tbody$.append(_.template(tbodyTpl));

            // 3. Initialize Select2 for all at once
            if (typeof window.setSelect2 === "function") window.setSelect2();
            
            // 4. Trigger calculation once
            table$.find(".track-change").first().trigger("change");
            
            // 5. Cleanup first row delete button
            tbody$.find("tr:eq(0) .btn-delete-row").remove();
        }
    };

    ajax(options);    
  }

  form$.validate({
        rules: {
          title: { required: true, minlength: 2 },
          company: { required: true },
          companyContact: { required: true },
          category: { required: true },
          notes: { required: true, minlength: 5 }
        },
        messages: {
          title: { required: "Title is required" },
          company: { required: "Please select a company" },
          companyContact: { required: "Please select a contact" },
          category: { required: "Please select a category" },
          notes: { required: "Notes are required" }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
          $(element).removeClass('is-invalid');
        },

    submitHandler: function (form, event) {

      event.preventDefault();
      let isValid = true;
        let hasAtLeastOneItem = false;

        table$.find("tbody tr").each(function (index) {
          const tr$ = jQuery(this);
          const item = tr$.find(".item").val();
          const qty = toFloat(tr$.find(".quantity").val());
          const price = toFloat(tr$.find(".price").val());

          // Check if any part of the row is filled
          if (qty > 0 || price > 0) {
            if (!item || qty <= 0 || price <= 0) {
              toastError(`Row ${index + 1}: Please provide Item Name, Quantity (not 0), and Price, or delete the row.`, "Validation Error");
              isValid = false;
              return false; // Exit loop
            }
            hasAtLeastOneItem = true;
          }
        });

        if (!isValid) return; // Stop submission if a row is incomplete

        if (!hasAtLeastOneItem) {
          toastError("Please add at least one valid item.", "Validation Error");
          return;
        }
      const hasItems = table$.find("tbody tr .item").filter(function() {
            return $(this).val();
          }).length > 0;

      if (!hasItems) {
            toastError("At least one item is required", "Validation Error");
            return false;
      }
        
      const data = {
        title: form$.find("#title").val(),
        company: company$.val(),
        companyContact: companyContact$.val(),
        category: category$.val(),
        items: [],
        total: toFloat(table$.find(".overall-total").val()),
        tax: toFloat(table$.find(".overall-taxes").val()),
        discount: toFloat(table$.find(".overall-discount").val()),
        payable: toFloat(table$.find(".overall-payable").val()),
        notes:form$.find("#notes").val()
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
        url: slug ? `/purchase-requests/${slug}` : "/purchase-requests",
        method: slug ? "PUT" : "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        success: function (response) {
          if (response.success && response.redirect) {
            window.location.href = response.redirect;
          }
        },
        error: function (xhr) {
          const errors = xhr.responseJSON?.errors;
          if (errors) {
            _.each(errors, (message, field) => toastError(message, field));
          }
        }
      };
      ajax(options);
    },
  });
});
