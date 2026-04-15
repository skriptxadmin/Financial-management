jQuery(function () {
  const table$ = jQuery("#warehouseLocationsTable");
  let tableInstance = null;
  console.log(table$);
  drawWarehouseLocationTable();
  function drawWarehouseLocationTable (){
    if(tableInstance){
      tableInstance.destroy();
    }
    tableInstance = table$.DataTable({
    processing: true,
    serverSide: true,

    ajax: function (data, callback, settings) {
      const options = {
        url: "/warehouse-locations",
        data: data,
        success: function (response) {
          callback(response);
        },
      };
      ajax(options);
    },
    columns: [{
      data:"slug",
      title:"slug"
    },
    {
      data:"institute",
      title:"institute"
    },
    {
      data:"department",
      title:"department"
    },
      {
      data: null,
      title: "Visible",
      orderable: false,
      searchable: false,
      render: function (data, type, row, meta) {
        return `<div class="d-flex justify-content-center align-items-center"><div class="form-check form-switch">
  <input class="form-check-input toggle-visible" type="checkbox" role="switch" ${data.visible == 1 ? "checked" : ""}>
 </div></div>`;
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
    const href = `${window.appLocals.base}warehouse-locations/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this warehouse locations?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `warehouse-locations/${slug}`,
      method: "DELETE",
      success: function () {
        drawWarehouseLocationTable();
      },
    };
    ajax(options);
  });

  table$.on("change", ".toggle-visible", async function () {
    const result = await ratify("Are you sure you want to toggle visible this warehouse location?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `slug/${slug}/toggle/visible`,
      method: "PUT",
      success: function () { },
    };
    ajax(options);
  });
});
