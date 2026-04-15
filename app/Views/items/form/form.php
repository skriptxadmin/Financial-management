<form class="item" data-slug="<?= $slug; ?>">
    <div class="form-group mb-2">
        <label for="name" class="form-label">Item Name</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    
    <div class="form-group mb-2">
        <label for="nickname" class="form-label">Nick Name</label>
        <input type="text" class="form-control" id="nickname" name="nickname">
    </div>


    <div class="form-group mb-2">
        <label for="partno" class="form-label">Part No</label>
        <input type="text" class="form-control" id="partno" name="partno">
    </div>

    <div class="form-group mb-2">
        <label for="link" class="form-label">Link</label>
        <input type="text" class="form-control" id="link" name="link">
    </div>
    
    <div class="form-group mb-2">
        <label for="datasheet" class="form-label">Data Sheet</label>
        <input type="text" class="form-control" id="datasheet" name="datasheet">
    </div>

    <div class="form-group mb-2">
        <label for="specification" class="form-label">Specification</label>
        <textarea class="form-control" id="specification" name="specification" rows="3"></textarea>
    </div>

    <div class="form-group mb-2">
        <label for="handlinginstruction" class="form-label">Handling Instructions</label>
        <textarea class="form-control" id="handlinginstruction" name="handlinginstruction" rows="3"></textarea>
    </div>


    <div class="form-group mb-2">
        <label for="unit" class="form-label">Unit</label>
        <select name="unit" id="unit" class="form-select">
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="category" class="form-label">Category</label>
        <select name="category" id="category" class="form-select">
        </select>
    </div>

    <div class="form-group mb-2">
        <label for="tags" class="form-label">Tags</label>
        <input type="text" class="form-control" id="tags" name="tags" placeholder="Comma separated tags">
    </div>

    <div class="form-group mb-2">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>