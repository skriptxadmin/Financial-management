jQuery(function () {
  const table$ = jQuery("#companyContactsTable");
  const modal$ = jQuery("#companyContactStatusSelectModal");
  const modalInstance$ = bootstrap.Modal.getOrCreateInstance(modal$[0]);

  getCompanyStatus();

  let companyContactStatus = [];

  function getCompanyStatus() {
    const options = {
      url: `company-contact-status`,
      success: function (res) {
        companyContactStatus = _.get(res, "status", []);
      },
    };
    ajax(options);
  }

  table$.on("click", ".toggle-status", async function () {
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const statusSlug = jQuery(this).attr("data-slug");
    let options = `<option value="">Select Status</option>`;
    options = companyContactStatus.map(option=>{
        return `<option value="${option.slug}">${option.name}</option>`;
    })
    modal$.find("#status").html(options);
    modal$.attr('data-slug', slug);
    setTimeout(()=>{
        modal$.find("#status").val(statusSlug);
    })
    modalInstance$.show();
  });
  modal$.validate({
    rules: {
        status: {
            required: true
        }
    },
    submitHandler:function(form, event){
        event.preventDefault()
        const data = {
            status: modal$.find("#status").val()
        }
        const slug = modal$.attr('data-slug');
        const options = {
            url:`company-contacts/${slug}/toggle/status`,
            method:"PUT",
            data:data,
            success:function(){
                modalInstance$.hide();
                setTimeout(()=>{
                    table$.trigger('redraw');
                })
            }
        }
        ajax(options);
    }
  })
});
