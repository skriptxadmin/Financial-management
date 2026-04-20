jQuery(function () {
  const form$ = jQuery("form#purchaseCategoryModal");
  const create$ = jQuery("button.btn-purchase-category-create");
  const modal$ = bootstrap.Modal.getOrCreateInstance(form$[0], {});
  const table$ = jQuery("#purchaseCategoriesTable");
  const headUserSelect$ = form$.find("#head_user_id");
  let tableInstance$;

  create$.on("click", function () {
    form$.find("#slug").val("");
    form$.find("#name").val("");
    headUserSelect$.val(null).trigger("change");
    modal$.show();
  });

  getPurchaseCategories();

  function getPurchaseCategories() {
    if (tableInstance$) {
      tableInstance$.destroy();
    }
    const options = {
      url: "/purchase-categories",
      success: function (response) {
        drawDatatable(response.categories);
      },
    };
    ajax(options);
  }

  table$.on("redraw", function () {
    getPurchaseCategories();
  });

  function drawDatatable(categories) {
    tableInstance$ = table$.DataTable({
      data: categories,
      columns: [
        { data: "slug", title: "Slug" },
        { data: "name", title: "Name", className: "name-column" },
        { data: "head_name", title: "Head", defaultContent: "N/A" },
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
    const tr$ = jQuery(this).closest("tr");
    const slug = tr$.attr("data-slug");
    
    const options = {
        url: `/purchase-categories/${slug}`,
        method: "GET",
        success: function(response) {
            const category = response.category;
            form$.find("#slug").val(category.slug);
            form$.find("#name").val(category.name);
            
            // Set Select2 value
            if (category.head_user_id) {
                const newOption = new Option(category.head_name || "Head", category.head_user_id, true, true);
                headUserSelect$.append(newOption).trigger('change');
            } else {
                headUserSelect$.val(null).trigger('change');
            }
            
            modal$.show();
        }
    };
    ajax(options);
  });

  table$.on("click", ".btn-delete", async function () {
    const result = await ratify("Are you sure you want to delete this category?");
    if (!result) return;
    const slug = jQuery(this).closest("tr").attr("data-slug");
    const options = {
      url: `purchase-categories/${slug}`,
      method: "DELETE",
      success: function () {
        getPurchaseCategories();
      },
    };
    ajax(options);
  });
});
