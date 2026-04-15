function ajax(options) {
  const ajaxOptions = { ...options };
  ajaxOptions.url = joinUrl(options.url);
  const csrfToken = $('meta[name="csrf-token"]').attr("content");
  ajaxOptions.headers = options.headers || {};
  if (csrfToken) {
    ajaxOptions.headers["X-CSRF-TOKEN"] = csrfToken;
  }
  const loader = _.get(options, 'loader', true);
  toggleLoader(loader);
  ajaxOptions.success = function (res) {
    if (res.message) {
      toastSuccess(res.message);
    }
    if (res.redirect) {
      window.location.href = res.redirect;
    }
    if (options.success) {
      options.success(res);
    }
  };
  ajaxOptions.error = handleError;
  ajaxOptions.complete = function () {
    toggleLoader(false);
  };
  jQuery.ajax(ajaxOptions);
}

function handleError(err) {
  // Extract errors object or message
  const response = _.get(err, "responseJSON", {});
  let message = "";

  if (response.errors) {
    // response.errors is an object, extract all values
    message = _.values(response.errors).join("<br>");
  } else if (response.message) {
    // single message
    message = response.message;
  } else {
    message = "Something went wrong!";
  }

  // Show toast
  toastError(message);
}

function joinUrl(path) {
  let base = window.appLocals?.ajax || "";
  // Remove trailing slash from base
  base = base.replace(/\/+$/, "");
  // Remove leading slash from path
  path = path.replace(/^\/+/, "");
  // Combine with single slash
  return base + "/" + path;
}
