jQuery(function () {
  const table$ = jQuery("#usersTable");
  table$.DataTable({
    processing: true,
    serverSide: true,

    ajax: function (data, callback, settings) {
      const options = {
        url: "/users",
        data: data,
        success: function (response) {
          callback(response);
        },
      };
      ajax(options);
    },

    columns: [
      { data: "username", title: "Username" },
      { data: "email", title: "Email" },
      { data: "mobile", title: "Mobile" },
      {
        data: null,
        title: "Blocked",
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
          return `<div class="d-flex justify-content-center align-items-center"><div class="form-check form-switch">
  <input class="form-check-input toggle-block" type="checkbox" role="switch" ${data.blocked_at ? "checked" : ""}>
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
      jQuery(row).attr("data-username", data.username);
    },
  });
  table$.on("click", ".btn-edit", function () {
    const username = jQuery(this).closest("tr").attr("data-username");
    const href = `${window.appLocals.base}users/${username}/edit`;
    window.location.href = href;
  });
  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this user?");
    if (!result) return;
    const username = jQuery(this).closest("tr").attr("data-username");
  });
  table$.on("change", ".toggle-block", async function () {
    const result = await ratify("Are you sure you want to toggle block this user?");
    if (!result) return;
    const username = jQuery(this).closest("tr").attr("data-username");
    const options = {
      url: `users/${username}/toggle/block`,
      method:"PUT",
      success: function () {},
    };
    ajax(options);
  });
   table$.on("change", ".toggle-visible", async function () {
    const result = await ratify("Are you sure you want to toggle visible this user?");
    if (!result) return;
    const username = jQuery(this).closest("tr").attr("data-username");
    const options = {
      url: `users/${username}/toggle/visible`,
      method:"PUT",
      success: function () {},
    };
    ajax(options);
  });
});
