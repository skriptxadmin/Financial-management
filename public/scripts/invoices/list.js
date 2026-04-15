jQuery(function () {
  const table$ = jQuery("#invoiceTable");
  let tableInstance$ = null;

  drawInvoicesTable();

  table$.on("redraw", function () {
    drawInvoicesTable();
  });
  function drawInvoicesTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
  tableInstance$ = table$.DataTable({
    processing: true,
    serverSide: true,
    ajax: function (data, callback, settings) {
      const options = {
        url: "/invoices",
        data: data,
        success: function (response) {
          callback(response);
        },
      };
      ajax(options);
    },

    columns: [
      { data: "name", title: " Name" },
      { data: "company_id", title: "Company_id" },
      { data: "contact_id", title: "Contact_id" },
      { data: "invoice_number", title: "Invoice Number" },
      { data: "total_price", title: "total_price" },
     
      {
        data: null,
        title: "Action",
        orderable: false,
        searchable: false,
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
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const href = `${window.appLocals.base}invoices/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this item?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url:`invoices/${slug}`,
      method:"DELETE",
      success:function(){
        drawInvoicesTable();
      }
    }
      ajax(options); 
  });
});