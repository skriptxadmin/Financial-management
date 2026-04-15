jQuery(function () {
  const offcanvasElementList = document.querySelectorAll(".offcanvas-lg");
   const offcanvasList = [...offcanvasElementList].map((offcanvasEl) => {
    new bootstrap.Offcanvas(offcanvasEl);
  });
});

      function toFloat (val)  {
        const num = parseFloat(val);
        return isNaN(num) ? 0.0 : parseFloat(num.toFixed(2));
      };
