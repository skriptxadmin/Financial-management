<form class="modal fade" id="purchaseCategoryModal" tabindex="-1" aria-labelledby="purchaseCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="purchaseCategoryModalLabel">Purchase Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="slug" id="slug" value="">
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group mb-3">
            <label for="head_user_id" class="form-label">Head</label>
            <select name="head_user_id" id="head_user_id" class="form-select select2" data-parent="#purchaseCategoryModal"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</form>