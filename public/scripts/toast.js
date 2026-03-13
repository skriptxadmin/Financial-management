function toastError(message, title){
    const ajaxToastEl = document.getElementById("ajaxToast");
    const ajaxToast = bootstrap.Toast.getOrCreateInstance(ajaxToastEl);
    jQuery("#ajaxToast").find(".toast-body").html(message);
    jQuery("#ajaxToast")
    .removeClass(function(index, className) {
        return (className.match(/(^|\s)text-bg-\S+/g) || []).join(' ');
    })
    .addClass("text-bg-danger");
    ajaxToast.show();
}

function toastSuccess(message, title){
    const ajaxToastEl = document.getElementById("ajaxToast");
    const ajaxToast = bootstrap.Toast.getOrCreateInstance(ajaxToastEl);
    jQuery("#ajaxToast").find(".toast-body").html(message);
    jQuery("#ajaxToast")
    .removeClass(function(index, className) {
        return (className.match(/(^|\s)text-bg-\S+/g) || []).join(' ');
    })
    .addClass("text-bg-success");
    ajaxToast.show();
}