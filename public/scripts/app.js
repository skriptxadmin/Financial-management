jQuery(function () {
  const offcanvasElementList = document.querySelectorAll(".offcanvas-lg");
   const offcanvasList = [...offcanvasElementList].map((offcanvasEl) => {
    new bootstrap.Offcanvas(offcanvasEl);
  });
});
