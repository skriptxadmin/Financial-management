<form class="warehouse" data-slug="<?= $slug; ?>">
    <div class="form-group mb-2">
        <label for="name" class="form-label">Warehouse Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group mb-2">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
        </select>
    </div>
  
    <div class="form-group mb-2">
        <label for="location_primary" class="form-label">Primary Location</label>
        <select name="location_primary" id="location_primary" class="form-select">
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="location_secondary" class="form-label">Secondary Location</label>
        <select name="location_secondary" id="location_secondary" class="form-select">
        </select>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>