<form class="warehouse-locations" data-slug="<?= $slug; ?>">
    <div class="form-group mb-2">
        <label for="institute" class="form-label">Institute</label>
        <input type="text" class="form-control" id="institute" name="institute">
    </div>
    <div class="form-group mb-2">
        <label for="department" class="form-label">Department</label>
        <input type="text" class="form-control" id="department" name="department">
    </div>

     <div class="form-group mb-2">
        <label for="building_name" class="form-label">Building Name</label>
        <input type="text" class="form-control" id="building_name" name="building_name">
    </div>

     <div class="form-group mb-2">
        <label for="phone_number" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number">
    </div>

     <div class="form-group mb-2">
        <label for="floor_number" class="form-label">Floor number</label>
        <input type="text" class="form-control" id="floor_number" name="floor_number">
    </div>

     <div class="form-group mb-2">
        <label for="lab_number" class="form-label">Lab Number</label>
        <input type="text" class="form-control" id="lab_number" name="lab_number">
    </div>

    
     <div class="form-group mb-2">
        <label for="note" class="form-label">Note </label>
        <textarea class="form-control" id="note" name="notes" rows="3"></textarea>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>