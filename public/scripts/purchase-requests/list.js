jQuery(function () {
  let tableInstance$ = null;
  const table$ = jQuery("#purchaseRequestsTable");

  drawPurchaseRequestsTable();

  table$.on("redraw", function () {
    drawPurchaseRequestsTable();
  });

  function drawPurchaseRequestsTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
    tableInstance$ = table$.DataTable({
      processing: true,
      serverSide: true,

      ajax: function (data, callback, settings) {
        const options = {
          url: "/purchase-requests",
          data: data,
          success: function (response) {
            callback(response);
          },
        };
        ajax(options);
      },

      columns: [
        { data: "request_id", title: "ID" },
        { data: "title", title: "Title" },
        {
          data: null,
          title: "Company",
          render: function (data, type, row, meta) {
            return data?.company?.name;
          },
        },
        {
          data: null,
          title: "Contact",
          render: function (data, type, row, meta) {
            return data?.company_contact?.name;
          },
        },
        { data: "discount", title: "Discount" },
        { data: "tax", title: "Tax" },
        { data: "total", title: "Total" },
        { data: "payable", title: "Payable" },
        {
          data: null,
          title: "Status",
          orderable: false,
          searchable: false,
          render: function (data, type, row, meta) {
            const isHead = parseInt(data?.category?.head_user_id) === parseInt(appLocals.user_id);
            const disabled = isHead ? "" : "disabled";
            const cursor = isHead ? "" : "style='cursor: default; text-decoration: none;'";
            return `<button class="btn btn-link toggle-status" ${disabled} ${cursor} data-slug="${data?.status?.slug}">${data.status?.name}</button>`;
          },
        },
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
    const href = `${window.appLocals.base}purchase-requests/${slug}/edit`;
    window.location.href = href;
  });



   table$.on("click", ".btn-delete", async function () {
        const result = await ratify(
          "Are you sure you want to delete this purchase request?"
        );
        if (!result) return;

        const slug = jQuery(this).closest("tr").attr("data-slug");

        const options = {
          url: `purchase-requests/${slug}`,
          method: "DELETE",
          success: function () {
            drawPurchaseRequestsTable();
          },
        };

        ajax(options);
      });


});
