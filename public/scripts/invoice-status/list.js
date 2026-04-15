
jQuery(function () {
  const form$ = jQuery("form#invoiceStatusModal");
  const create$ = jQuery("button.btn-invoice-status-create");
  const modal$ = bootstrap.Modal.getOrCreateInstance(form$[0], {});
  const table$ = jQuery("#invoiceStatusTable");
  let tableInstance$;

  create$.on("click", function () {
    form$.find("#slug").val("");
    form$.find("#name").val("");
    modal$.show();
  });
  getInvoiceStatus();
  function getInvoiceStatus() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
    const options = {
      url: "/invoice-status",
      success: function (response) {
        drawDatatable(response.status);
      },
    };
    ajax(options);
  }
  table$.on("redraw", function () {
    getInvoiceStatus();
  });
  function drawDatatable(status) {
    tableInstance$ = table$.DataTable({
      data: status,
      columns: [
        { data: "slug", title: "Slug" },
        { data: "name", title: "Name",className: "name-column" },
        {
          data: null, // use null because this column is not bound to data
          title: "Action",
          orderable: false, // disables sorting for this column
          searchable: false, // optional: disable searching for actions
          render: function (data, type, row, meta) {
            return `
            <button class="btn btn-edit btn-sm">${appLocals.svgs.edit}</button>
            <button class="btn btn-delete btn-sm">${appLocals.svgs.delete}</button>
        `;
          },
        },
      ],
      createdRow: function (row, data, dataIndex) {
        jQuery(row).attr("data-slug", data.slug);
      },
    });
  }

  table$.on("click", ".btn-edit", function () {
    const tr$ = jQuery(this).closest("tr");
    const slug = tr$.attr("data-slug");
    form$.find("#slug").val(slug);
    form$.find("#name").val(tr$.find(".name-column").text());
    modal$.show();
  });

  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this status?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url:`invoice-status/${slug}`,
      method:"DELETE",
      success:function(){
        getInvoiceStatus();
      }
    }
      ajax(options);

  });
});
