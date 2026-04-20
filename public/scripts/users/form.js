jQuery(function () {
  const form$ = jQuery("form.user");
  if (!form$.length) {
    return;
  }
  const username = form$.attr("data-username");
  getRoles();

  function getRoles() {
    const options = {
      url: "/user-roles",
      success: function (res) {
        const roles = _.uniqBy(_.get(res, "roles", []), "slug");
        let options$ = `<option value="">Select Role</option>`;
        options$ += roles
          .map((option) => {
            return `<option value="${option.slug}">${option.name}</option>`;
          })
          .join("");
        form$.find("#role").html(options$);
        if (username) {
          getUser();
        }
      },
    };
    ajax(options);
  }

  function getUser() {
    const options = {
      url: `/users/${username}`,
      success: function (res) {
        const user = _.get(res, "user", {});
        if (_.isEmpty(user)) return;
        form$.find("#firstname").val(_.get(user, "firstname", ""));
        form$.find("#lastname").val(_.get(user, "lastname", ""));
        form$.find("#email").val(_.get(user, "email", ""));
        form$.find("#mobile").val(_.get(user, "mobile", ""));
        form$.find("#username").val(_.get(user, "username", ""));
        form$.find("#gender").val(_.get(user, "gender", ""));
        form$.find("#role").val(_.get(user, "role.slug", ""));
      },
    };
    ajax(options);
  }

  const rules = {
    firstname: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    lastname: {
      required: true,
      minlength: 2,
      maxlength: 50,
      pattern: /^[A-Za-z\s]+$/, // only letters and spaces
    },
    username: {
      required: true,
      minlength: 4,
      maxlength: 30,
      pattern: /^[a-zA-Z0-9_]+$/, // letters, numbers, underscore
    },
    email: {
      required: true,
      email: true,
    },
    mobile: {
      required: true,
      digits: true,
      minlength: 10,
      maxlength: 10,
    },
    role: {
      required: true,
    },
    gender: {
      required: true,
    },
    password: {
      required: false,
      minlength: 8,
      maxlength: 15,
    },
  };
  const messages = {
    firstname: {
      required: "Firstname is required",
      minlength: "Firstname must be at least 2 characters",
      maxlength: "Firstname cannot exceed 50 characters",
      pattern: "Firstname can only contain letters and spaces",
    },
    lastname: {
      required: "Lastname is required",
      minlength: "Lastname must be at least 2 characters",
      maxlength: "Lastname cannot exceed 50 characters",
      pattern: "Lastname can only contain letters and spaces",
    },
    username: {
      required: "Username is required",
      minlength: "Username must be at least 4 characters",
      maxlength: "Username cannot exceed 30 characters",
      pattern: "Username can only contain letters, numbers, and underscores",
    },
    email: {
      required: "Email is required",
      email: "Enter a valid email address",
    },
    mobile: {
      required: "Mobile number is required",
      digits: "Mobile number can only contain digits",
      minlength: "Mobile number must be at least 10 digits",
      maxlength: "Mobile number cannot exceed 10 digits",
    },
    password: {
      minlength: "Password must be at least 8 characters",
      maxlength: "Password cannot exceed 15 characters",
    },
    role: {
      required: "Please select a role",
    },
    gender: {
      required: "Please select a gender",
    },
  };
  form$.validate({
    rules: rules,
    messages: messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        firstname: form$.find("#firstname").val(),
        lastname: form$.find("#lastname").val(),
        email: form$.find("#email").val(),
        mobile: form$.find("#mobile").val(),
        username: form$.find("#username").val(),
        password: form$.find("#password").val(),
        role: form$.find("#role").val(),
        gender: form$.find("#gender").val(),
      };
      let options = {
        url: "/users",
        method: "POST",
        data: data,
      };
      if (username) {
        options = {
          url: `/users/${username}`,
          method: "PUT",
          data: data,
        };
      }

      ajax(options);
    },
  });
});
