jQuery(function () {
  const form$ = jQuery("form.item ");
  if (!form$.length) {
    return;
  }
  const slug = form$.attr("data-slug");
  getCategories();
  
  function getCategories() {
    const options = {
      url: "/item-categories",
      success: function (res) {
        const categories = _.get(res, "categories", []);
        let options$ = `<option value="">Select Category</option>`;
        options$ += categories
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#category").html(options$);
        getUnits();
      },
    };
    ajax(options);
  }

  function getUnits() {
    const options = {
      url: "/item-units",
      success: function (res) {
        const units = _.get(res, "itemUnits", []);
        let options$ = `<option value="">Select Unit</option>`;
        options$ += units
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#unit").html(options$);
        if (slug) {
          getItem();
        }
      },
    };
    ajax(options);
  }

  function getItem() {
    const options = {
      url: `/items/${slug}`,
      success: function (res) {
        const item = _.get(res, "item", {});
        if (_.isEmpty(item)) return;
        form$.find("#name").val(_.get(item, "name", ""));
        form$.find("#nickname").val(_.get(item, "nickname", ""));
        form$.find("#partno").val(_.get(item, "partno", ""));
        form$.find("#link").val(_.get(item, "link", ""));
        form$.find("#datasheet").val(_.get(item, "datasheet", ""));
        form$.find("#specification").val(_.get(item, "specification", ""));
        form$.find("#handlinginstruction").val(_.get(item, "handlinginstruction", ""));
        form$.find("#unit").val(_.get(item, "unit.slug", ""));
        form$.find("#category").val(_.get(item, "category.slug", ""));
        form$.find("#description").val(_.get(item, "description", ""));
        form$.find("#tags").val(_.get(item, "tags",""));
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
    nickname: {
      required: true,
      minlength: 2,
      maxlength: 20,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    partno: {
      required: true,
      minlength: 2,
      maxlength: 50,

    },
    link: {
      required: true,
      minlength: 2,
      maxlength: 200,
    },
    datasheet: {
      required: true,
      minlength: 2,
      maxlength: 200,
    },

    specification: {
      required: true,
      minlength: 10,
      maxlength: 300,
    },
    handlinginstruction: {
      required: true,
      minlength: 10,
      maxlength: 300,
    },
    unit: {
      required: true,
    },
    category: {
      required: true,
    },
    tags: {
      required: true,
      minlength: 2,
      maxlength: 255,
    },
      description: {
        required: true,
        minlength: 20,
        maxlength: 500,
      }
  };
  const messages = {
    name: {
      required: "Item name is required",
      minlength: "Item name must be at least 2 characters",
      maxlength: "Item name cannot exceed 50 characters",
      pattern: "Item name can only contain letters and spaces",
    },
    nickname: {
      required: "Nickname is required",
      minlength: "Nickname must be at least 2 characters",
      maxlength: "Nickname cannot exceed 20 characters",
      pattern: "Nickname can only contain letters and spaces",
    },
    partno: {
      required: "Part number is required",
      minlength: "Part number must be at least 2 characters",
      maxlength: "Part number cannot exceed 50 characters",
    },
    link: {
      required: "Link is required",
      minlength: "Link must be at least 2 characters",
      maxlength: "Link cannot exceed 200 characters",
    },
    datasheet: {
      required: "Datasheet link is required",
      minlength: "Datasheet link must be at least 2 characters",
      maxlength: "Datasheet link cannot exceed 200 characters",
    },
    specification: {
      required: "Specification is required",
      minlength: "Specification must be at least 10 characters",
      maxlength: "Specification cannot exceed 300 characters",
    },
    handlinginstruction: {
      required: "Handling instruction is required",
      minlength: "Handling instruction must be at least 10 characters",
      maxlength: "Handling instruction cannot exceed 300 characters",
    },
    unit: {
      required: "Please select a unit",
    },
    category: {
      required: "Please select a category",
    },
    tags: {
      required: "Tags are required",
      minlength: "Tags must be at least 2 characters",
      maxlength: "Tags cannot exceed 255 characters",
    },
    description: {
      required: "Description is required",
      minlength: "Description must be at least 10 characters",
      maxlength: "Description cannot exceed 300 characters",
    }
  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        name: form$.find("#name").val(),
        nickname: form$.find("#nickname").val(),
        partno: form$.find("#partno").val(),
        link: form$.find("#link").val(),
        datasheet: form$.find("#datasheet").val(),
        specification: form$.find("#specification").val(),
        handlinginstruction: form$.find("#handlinginstruction").val(),
        unit: form$.find("#unit").val(),
        category: form$.find("#category").val(),
        tags: form$.find("#tags").val(),
        description: form$.find("#description").val()
      };
      let options = {
        url: "/items",
        method: "POST",
        data: data,
      };
      if (slug) {
        options = {
          url: `/items/${slug}`,
          method: "PUT",
          data: data,
        };
      }
      ajax(options);
    },
  });
});
