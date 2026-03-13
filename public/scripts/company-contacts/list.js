jQuery(function () {
  let tableInstance$ = null;
  const table$ = jQuery("#companyContactsTable");

  const companySlug = table$
    .closest(".table-responsive")
    .attr("data-company-slug");
  drawCompanyContactsTable();

  table$.on("redraw", function () {
    drawCompanyContactsTable();
  });

  function drawCompanyContactsTable() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
    tableInstance$ = table$.DataTable({
      processing: true,
      serverSide: true,

      ajax: function (data, callback, settings) {
        data.companySlug = companySlug;
        
        const options = {
          url: "/company-contacts",
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
          title: "Working",
          orderable: false,
          searchable: false,
          render: function (data, type, row, meta) {
            return `<div class="d-flex justify-content-center align-items-center"><div class="form-check form-switch">
  <input class="form-check-input toggle-working" type="checkbox" role="switch" ${data.working == 1 ? "checked" : ""}>
 </div></div>`;
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
    const href = `${window.appLocals.base}company-contacts/${companySlug}/${slug}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify(
      "Are you sure you want to delete this contact?",
    );
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `company-contacts/${slug}`,
      method: "DELETE",
      success: function () {
        drawCompanyContactsTable();
      },
    };
    ajax(options);
  });

  table$.on("change", ".toggle-visible", async function () {
    const result = await ratify(
      "Are you sure you want to toggle visible this contact?",
    );
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `company-contacts/${slug}/toggle/visible`,
      method: "PUT",
      success: function () {},
    };
    ajax(options);
  });

  table$.on("change", ".toggle-working", async function () {
    const result = await ratify(
      "Are you sure you want to toggle working this contact?",
    );
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `company-contacts/${slug}/toggle/working`,
      method: "PUT",
      success: function () {},
    };
    ajax(options);
  });
});
