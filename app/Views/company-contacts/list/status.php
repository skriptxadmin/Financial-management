<form class="modal fade" id="companyContactStatusSelectModal" tabindex="-1" aria-labelledby="companyContactStatusSelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="companyContactStatusSelectModalLabel">Contact Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="slug" id="slug" value="">
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <select name="status" id="status" class="form-select">
                <option value="">Select Status</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</form>