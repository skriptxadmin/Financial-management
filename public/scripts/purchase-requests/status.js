jQuery(function () {
  const table$ = jQuery("#purchaseRequestsTable");
  const modal$ = jQuery("#purchaseRequestStatusSelectModal");
  const modalInstance$ = bootstrap.Modal.getOrCreateInstance(modal$[0]);

  getPurchaseRequestStatus();

  let purchaseRequestStatus = [];

  function getPurchaseRequestStatus() {
    const options = {
      url: `purchase-request-status`,
      success: function (res) {
        purchaseRequestStatus = _.get(res, "status", []);
      },
    };
    ajax(options);
  }

  table$.on("click", ".toggle-status", async function () {
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const statusSlug = jQuery(this).attr("data-slug");
    
    // Strictly allow only pending, approved, and rejected
    const allowedSlugs = ['pending', 'approved', 'rejected'];
    const filteredStatus = purchaseRequestStatus.filter(option => allowedSlugs.includes(option.slug));
    
    let options = `<option value="">Select Status</option>`;
    options += filteredStatus.map(option => {
      return `<option value="${option.slug}">${option.name}</option>`;
    }).join('');
    
    modal$.find("#status").html(options);
    modal$.attr('data-slug', slug);
    setTimeout(() => {
      modal$.find("#status").val(statusSlug);
    });
    modalInstance$.show();
  });

  modal$.validate({
    rules: {
      status: {
        required: true
      }
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      const data = {
        status: modal$.find("#status").val()
      };
      const slug = modal$.attr('data-slug');
      const options = {
        url: `purchase-requests/${slug}/toggle/status`,
        method: "PUT",
        data: data,
        success: function () {
          modalInstance$.hide();
          setTimeout(() => {
            table$.trigger('redraw');
          });
        }
      };
      ajax(options);
    }
  });
});