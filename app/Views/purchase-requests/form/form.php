<form action="" class="purchase-request">
    <div class="form-group mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label for="company" class="form-label">Company</label>
                <select name="company" id="company" class="form-select"></select>

            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group mb-3">
                <label for="companyContact" class="form-label">Company Contact</label>
                <select name="companyContact" id="companyContact" class="form-select"></select>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width:40%">Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>SubTotal</th>
                        <th>Tax(%)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="p-0">
                            <textarea name="notes" id="notes" class="form-control notes" placeholder="Notes"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-end">Total</th>
                        <td class="p-0">
                            <input type="text" class="form-control overall-total text-end" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-end">Taxes</th>
                        <td class="p-0">
                            <input type="text" class="form-control overall-taxes text-end" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="6" class="text-end">Discount</th>
                        <td class="p-0">
                            <input type="text" class="form-control track-change overall-discount  text-end">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-end">Payable</th>
                        <td class="p-0">
                            <input type="text" class="form-control overall-payable  text-end" readonly>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end align-items-center my-3">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>

<script type="text/html" id="tbodyTpl">
<tr>
    <td class="p-0">
        <button class="btn btn-sm btn-outline-danger btn-delete-row" type="button">
            <?php echo svg('trash') ?>
        </button>
    </td>
    <td class="p-0">
        <select name="item" class="form-select item"></select>
    </td>
    <td class="p-0">
        <input type="text" class="form-control quantity track-change text-end" value="0">
    </td>
    <td class="p-0">
        <input type="text" class="form-control price track-change text-end" value="0">
    </td>
       <td class="p-0">
        <input type="text" class="form-control subtotal text-end" value="0" readonly>
    </td>
    <td class="p-0">
        <div>
        <input type="text" class="form-control tax track-change text-end" value="0">

        </div>
        <div>
        <input type="text" class="form-control tax_amount text-end" value="0" readonly>

        </div>
    </td>
    <td class="p-0">
        <input type="text" class="form-control total text-end" value="0" readonly>
    </td>
</tr>
</script>