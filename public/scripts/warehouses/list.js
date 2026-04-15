jQuery(function () {
  const table$ = jQuery("#warehousesTable");
  let tableInstance$ = null;

  drawWarehousesTable();
  
  table$.on("redraw", function () {
    drawWarehousesTable();
  });
  function drawWarehousesTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
  tableInstance$ = table$.DataTable({
    processing: true,
    serverSide: true,
    ajax: function (data, callback, settings) {
      const options = {
        url: "/warehouses",
        data: data,
        success: function (response) {
          callback(response);
        },
      };
      ajax(options);
    },

    columns: [
      { data: "name", title: "Name" },
      { data: "location_primary", title: "Primary location" },
      { data: "location_secondary", title: "Secondary location"},
      { data: "status", title: "Status"},
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
    const href = `${window.appLocals.base}warehouses/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this Warehouse?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url:`warehouses/${slug}`,
      method:"DELETE",
      success:function(){
        drawWarehousesTable();
      }
    }
      ajax(options); 
  });
});