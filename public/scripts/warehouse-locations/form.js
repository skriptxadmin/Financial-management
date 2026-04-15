jQuery(function () {
  const form$ = jQuery("form.warehouse-locations");
  if (!form$.length) {
    return;
  }

  const slug = form$.attr('data-slug');
  if(slug){ // edit mode
    getWarehouseLocation();
  }
  function getWarehouseLocation() {
    const options = {
      url: `/warehouse-locations/${slug}`,
      success: function (res) {
        const location = _.get(res, "location", {});
        if (_.isEmpty(location)) return;
        form$.find("#institute").val(_.get(location, "institute", ""));
        form$.find("#department").val(_.get(location, "department", ""));
        form$.find("#building_name").val(_.get(location, "building_name", ""));
        form$.find("#phone_number").val(_.get(location, "phone_number", ""));
        form$.find("#slug").val(_.get(location, "slug", ""));
        form$.find("#floor_number").val(_.get(location, "floor_number", ""));
        form$.find("#lab_number").val(_.get(location, "lab_number", ""));
        form$.find("#note").val(_.get(location, "note", ""));
      },
    };
    ajax(options);
  }

  const rules = {
    institute: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    department: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    building_name: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s0-9_]+$/, // letters, numbers, underscore
    },
   
    phone_number: {
      required: true,
      digits: true,
      minlength: 10,
      maxlength: 10,
    },
    floor_number: {
      required: true,
      digits: true,
      minlength: 1,
      maxlength: 10,
    },
    lab_number: {
      required: true,
      digits: true,
      minlength: 1,
      maxlength: 10,
    },
    note: {
      required: false,
      maxlength: 255,
    },
    
  };
  const messages = {
    institute: {
      required: "Institute is required",
      minlength: "Institute must be at least 2 characters",
      maxlength: "Institute cannot exceed 50 characters",
      pattern: "Institute can only contain letters and spaces",
    },
    department: {
      required: "Department is required",
      minlength: "Department must be at least 2 characters",
      maxlength: "Department cannot exceed 50 characters",
      pattern: "Department can only contain letters and spaces",
    },
    building_name: {
      required: "Building_name is required",
      minlength: "Building_name must be at least 2 characters",
      maxlength: "Building_name cannot exceed 50 characters",
      pattern: "Building_name can only contain letters and spaces",
    },
    slug: {
      required: "slug is required",
      minlength: "slug must be at least 2 characters",
      maxlength: "slug cannot exceed 30 characters",
      pattern: "slug can only contain letters, numbers, and underscores",
    },
    phone_number: {
      required: "Phone_number  is required",
      digits: "Phone_number can only contain digits",
      minlength: "Phone_number must be at least 10 digits",
      maxlength: "Phone_number cannot exceed 10 digits",
    },
    floor_number: {
      required: "Floor_number is required",
      minlength: "Floor_number must be at least 1 digits",
      maxlength: "Floor_number cannot exceed 10 digits",
      pattern: "Floor_number can only contain letters and spaces",
    },
    lab_number:{
      requried:"Lab_number is required",
      minlength:"Lab_number must be at least 1 digits",
      maxlength:"Lab_number cannot exceed 10 digits",
      pattern: "Lab_number can only contain letters and spaces",
    },
    note:{
      requried:"Note is required",
      maxlength:"Note cannot exceed 255 characters",
    }
  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        institute: form$.find("#institute").val(),
        department: form$.find("#department").val(),
        building_name: form$.find("#building_name").val(),
        phone_number: form$.find("#phone_number").val(),
        slug: form$.find("#slug").val(),
        floor_number: form$.find("#floor_number").val(),
        lab_number: form$.find("#lab_number").val(),
        note: form$.find("#note").val(),
      };
      let options = {
        url: "/warehouse-locations",
        method: "POST",
        data: data,
      };
      if (slug) {
        
        options = {
          url: `/warehouse-locations/${slug}`,
          method: "PUT",
          data: data,
        };
      }

      ajax(options);
    },
  });
});
