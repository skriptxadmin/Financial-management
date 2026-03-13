jQuery(function () {
  const table$ = jQuery("#companiesTable");
  const modal$ = jQuery("#companyStatusSelectModal");
  const modalInstance$ = bootstrap.Modal.getOrCreateInstance(modal$[0]);

  getCompanyStatus();

  let companyStatus = [];

  function getCompanyStatus() {
    const options = {
      url: `company-status`,
      success: function (res) {
        companyStatus = _.get(res, "status", []);
      },
    };
    ajax(options);
  }

  table$.on("click", ".toggle-status", async function () {
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const statusSlug = jQuery(this).attr("data-slug");
    let options = `<option value="">Select Status</option>`;
    options = companyStatus.map(option=>{
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
            url:`companies/${slug}/toggle/status`,
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
