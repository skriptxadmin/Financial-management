function toggleLoader(show) {
  const ajaxLoaderModalEl = document.getElementById("ajaxLoaderModal");
  const ajaxLoaderModal =
    bootstrap.Modal.getOrCreateInstance(ajaxLoaderModalEl);
  if (show) {
    ajaxLoaderModal.show();
  } else {
    setTimeout(() => {
      ajaxLoaderModal.hide();
    },1000);
  }
}
