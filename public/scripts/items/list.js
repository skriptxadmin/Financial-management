jQuery(function () {
  const table$ = jQuery("#itemsTable");
  let tableInstance$ = null;

  drawItemsTable();

  table$.on("redraw", function () {
    drawItemsTable();
  });
  function drawItemsTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
  tableInstance$ = table$.DataTable({
    processing: true,
    serverSide: true,
    ajax: function (data, callback, settings) {
      const options = {
        url: "/items",
        data: data,
        success: function (response) {
          callback(response);
        },
      };
      ajax(options);
    },

    columns: [
      { data: "name", title: "Item Name" },
      { data: "nickname", title: "Nickname" },
      { data: "partno", title: "Part No" },
      { data: "category.name", title: "Category" },
      { data: "unit.name", title: "Unit" },
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
    const href = `${window.appLocals.base}items/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this item?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url:`items/${slug}`,
      method:"DELETE",
      success:function(){
        drawItemsTable();
      }
    }
      ajax(options); 
  });
});