jQuery(function () {
  let tableInstance$ = null;
  const table$ = jQuery("#companiesTable");

  drawCompaniesTable();

  table$.on("redraw", function () {
    drawCompaniesTable();
  });

  function drawCompaniesTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
    tableInstance$ = table$.DataTable({
      processing: true,
      serverSide: true,

      ajax: function (data, callback, settings) {
        const options = {
          url: "/companies",
          data: data,
          success: function (response) {
            callback(response);
          },
        };
        ajax(options);
      },

      columns: [
        { data: "name", title: "Name" },
        { data: "email", title: "Email" },
        { data: "phone", title: "Phone" },
        {
          data: null,
          title: "Status",
          orderable: false,
          searchable: false,
          render: function (data, type, row, meta) {
            return `<button class="btn btn-link toggle-status" data-slug="${data?.status?.slug}">${data.status?.name}</button>`;
          },
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
            <a class="btn btn-sm" href="${appLocals.base}company-contacts/${data.slug}">${appLocals.svgs.contacts}</a>
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
    const href = `${window.appLocals.base}companies/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify(
      "Are you sure you want to delete this company?",
    );
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `companies/${slug}`,
      method: "DELETE",
      success: function () {
        drawCompaniesTable();
      },
    };
    ajax(options);
  });

  table$.on("change", ".toggle-visible", async function () {
    const result = await ratify(
      "Are you sure you want to toggle visible this company?",
    );
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `companies/${slug}/toggle/visible`,
      method: "PUT",
      success: function () {},
    };
    ajax(options);
  });
});
