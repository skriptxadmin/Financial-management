<form class="invoice" data-slug="<?= $slug; ?>">
   
    <div class="form-group mb-2">
        <label for="company_id" class="form-label">Company ID</label>
        <select name="company_id" id="company_id" class="form-select">
        </select>
    </div>
    
    <div class="form-group mb-2">
        <label for="contact_id" class="form-label">Contact ID</label>
        <select name="contact_id" id="contact_id" class="form-select">
        </select>
    </div>


    <div class="form-group mb-2">
        <label for="invoice_number" class="form-label">Invoice Number</label>
        <input type="text" class="form-control" id="invoice_number" name="invoice_number">
    </div>

    <div class="form-group mb-2">
        <label for="invoice_date" class="form-label">Invoice Date</label>
        <input type="date" class="form-control" id="invoice_date" name="invoice_date">
    </div>
    
    <div class="form-group mb-2">
        <label for="total_price" class="form-label">Total Price</label>
        <input type="number" class="form-control" id="total_price" name="total_price" step="0.01">
    </div>

    <div class="form-group mb-2">
        <label for="invoice_unique_id" class="form-label">Invoice Unique ID</label>
        <input type="text" class="form-control" id="invoice_unique_id" name="invoice_unique_id">
    </div>

    <div class="form-group mb-2">
        <label for="reference_number" class="form-label">Reference Number</label>
        <input type="text" class="form-control" id="reference_number" name="reference_number">
    </div>


  

    <div class="form-group mb-2">
        <label for="purchase_request_made" class="form-label">Purchase Request made</label>
        <input type="text" class="form-control" id="purchase_request_made" name="purchase_request_made">
    </div>

    <div class="form-group mb-2">
        <label for="purchase_request_id" class="form-label">Purchase Request ID</label>
        <input type="text" class="form-control" id="purchase_request_id" name="purchase_request_id">

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>