<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Medicine</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    /* Select2 ko Bootstrap input ke equal banane ke liye */
    .select2-container--default .select2-selection--single {
      height: 38px !important;
      padding: 6px 12px;
      border: 1px solid #ced4da;
      border-radius: 0.375rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 24px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 36px !important;
      right: 8px;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="content">
      <h2>Purchase Medicine</h2>

      <!-- Link to Medicine List -->
      <div class="mb-3 text-end">
        <a href="<?php echo base_url(); ?>/medicine/medicine_stock" class="btn btn-info">
          Stock List
        </a>
      </div>

      <form id="medicineForm" method="post" action="<?php echo base_url();?>/medicine/purchase_medicine">
        <input type="hidden" name="id" id="id"/>

        <div class="row-container">
          <!-- First Row -->
          <div class="row g-3 align-items-end mb-2">
            <!-- Medicine -->
            <div class="col-md-5">
              <label for="medicine" class="form-label">Medicine</label>
              <select name="medicine[]" class="form-select medicine-select">
                <option></option>
                <?php foreach ($medicines as $medicine) { ?>
                  <option value="<?php echo $medicine->id;?>"><?php echo $medicine->name; ?></option>
                <?php } ?>
              </select>
            </div>
              <!-- <div class="col-md-3">
                <label class="form-label">Price</label>
                <input type="number" name="price[]" class="form-control"/>
              </div> -->
            <!-- Quantity -->
            <div class="col-md-5">
              <label class="form-label">Quantity</label>
              <input type="number" name="quantity[]" class="form-control"/>
            </div>
            <!-- Price -->
          </div>
          <!-- Add More Button -->
          <div class="text-end mt-2">
            <button type="button" class="btn btn-success add-new-row">+ Add More</button>
          </div>
        </div>

        <!-- Submit -->
        <div class="col-12 text-center mt-4">
          <button type="submit" class="btn btn-primary w-100">Save</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

<script>

$(document).ready(function() {
  // First time init
  $('.medicine-select').select2({
    placeholder: "Select a medicine",
    allowClear: true,
    width: '100%'
  });
});

// Add new row
$(document).on('click','.row-container .add-new-row', function(){
  var firstRow = $(this).closest('.row-container').find('.row').first();

  // Clone row
  var row = firstRow.clone();

  // Clear values
  row.find('input').val('');
  row.find('select').val('').trigger('change');

  // Remove any old select2 wrapper (important)
  row.find('.select2').remove();

  // Add delete button
  row.append('<div class="col-md-1"><label>Delete</label><br><span class="remove-new-row btn btn-danger">x</span></div>');

  // Insert row
  row.insertBefore($(this).closest('.text-end'));

  // Re-init select2 on cloned select
  row.find('.medicine-select').select2({
    placeholder: "Select a medicine",
    allowClear: true,
    width: '100%'
  });
});

// Delete row
$(document).on('click','.row-container .remove-new-row', function(){
  $(this).closest('.row').remove();
});
</script>
