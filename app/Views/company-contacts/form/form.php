<form class="company-contact" data-company-slug="<?php echo $companySlug; ?>" data-slug="<?php echo $slug; ?>">

    <div class="form-group mb-2">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group mb-2">
        <label for="designation" class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation">
    </div>
     <div class="form-group mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

     <div class="form-group mb-2">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>

    <div class="form-group mb-2">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" id="notes" class="form-control"></textarea>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>