jQuery(function () {
  const form$ = jQuery("form.warehouse");
  if (!form$.length) {
    return;
  }
  const slug = form$.attr("data-slug");
  getStatus();
  
  function getStatus() {
    const options = {
      url: "/warehouse-status",
      success: function (res) {
        const status = _.get(res, "status", []);
        let options$ = `<option value="">Select Status</option>`;
        options$ += status
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#status").html(options$);
        getPrimary();
      },
    };
    ajax(options);
  }

  function getPrimary() {
    const options = {
      url: "/warehouse-locations",
      success: function (res) {
        const primary = _.get(res, "data", []);
        let options$ = `<option value="">Select Primary Location</option>`;
        options$ += primary
          .map((option) => {
            return `<option value="${option.slug}">${option.institute}</option>`;
          })
          .join("");
        form$.find("#location_primary").html(options$);
        if (slug) {
          getSecondary();
        }
      },
    };
    ajax(options);
  }
  function getSecondary() {
    const options = {
      url: "/warehouse-locations",
      success: function (res) {
        const secondary = _.get(res, "data", []);
        let options$ = `<option value="">Select Secondary Location</option>`;
        options$ += secondary
          .map((option) => {
            return `<option value="${option.slug}">${option.institute}</option>`;
          })
          .join("");
        form$.find("#location_secondary").html(options$);
        if (slug) {
          getWarehouse();
        }
      },
    };
    ajax(options);
  }
  function getWarehouse() {
    const options = {
      url: `/warehouses/${slug}`,
      success: function (res) {
        const warehouse = _.get(res, "warehouse", {});
        console.log(warehouse);
        if (_.isEmpty(warehouse)) return;
        form$.find("#name").val(_.get(warehouse, "name", ""));
        form$.find("#status").val(_.get(warehouse, "status.slug", ""));
        form$.find("#location_primary").val(_.get(warehouse, "location_primary.slug", ""));
        form$.find("#location_secondary").val(_.get(warehouse, "location_secondary.slug", ""));
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
    status: {
      required: true,
    },
    location_primary: {
      required: true,
    },
    location_secondary: {
      required: true,
    },
  };
  const messages = {
    name: {
      required: "Item name is required",
      minlength: "Item name must be at least 2 characters",
      maxlength: "Item name cannot exceed 50 characters",
      pattern: "Item name can only contain letters and spaces",
    },
    status: {
      required: "Please select a status",
    },
    location_primary: {
      required: "Please select a primary location",
    },
    location_secondary: {
      required: "Please select a secondary location",
    }
  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
        status: form$.find("#status").val(),
        location_primary: form$.find("#location_primary").val(),
        location_secondary: form$.find("#location_secondary").val(),
      };
      let options = {
        url: "/warehouses",
        method: "POST",
        data: data,
      };
      if (slug) {
        options = {
          url: `/warehouses/${slug}`,
          method: "PUT",
          data: data,
        };
      }
      ajax(options);
    },
  });
});
