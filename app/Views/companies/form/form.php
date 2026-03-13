<form class="company" data-slug="<?= $slug; ?>">
    <div class="form-group mb-2">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group mb-2">
        <label for="website" class="form-label">Website</label>
        <input type="text" class="form-control" id="website" name="website">
        <div  class="form-text">https://www.skriptx.com</div>
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
        <label for="addressLine1" class="form-label">Address Line 1</label>
        <input type="text" class="form-control" id="addressLine1" name="addressLine1">
    </div>

      <div class="form-group mb-2">
        <label for="addressLine2" class="form-label">Address Line 2</label>
        <input type="text" class="form-control" id="addressLine2" name="addressLine2">
    </div>


    <div class="form-group mb-2">
        <label for="city" class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city">
    </div>

    
    <div class="form-group mb-2">
        <label for="state" class="form-label">State</label>
        <input type="text" class="form-control" id="state" name="state">
    </div>

    <div class="form-group mb-2">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country">
    </div>
      <div class="form-group mb-2">
        <label for="pincode" class="form-label">Pincode</label>
        <input type="text" class="form-control" id="pincode" name="pincode">
    </div>
 
    <div class="form-group mb-2">
        <label for="category" class="form-label">Category</label>
        <select name="category" id="category" class="form-select">
        </select>
    </div>
   
    <div class="form-group mb-2">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" id="notes" class="form-control"></textarea>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>