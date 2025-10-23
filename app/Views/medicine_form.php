<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Medicine</title>
</head>
<?php
  if(isset($medicine)){
    $id=$medicine->id;
    $name=$medicine->name;
    $price=$medicine->price;
  }else {
    $id='';
    $name='';
    $quantity='';
    $price='';
  }
?>
<body>
  <div class="container mt-5">
    <div class="content">
      <h2>New Medicine</h2>

      <!-- Link to Medicine List -->
      <div class="mb-3" style="text-align:right">
        <a href="<?php echo base_url(); ?>/medicine" class="btn btn-info">
          View Medicine List
        </a>
      </div>

      <form method="post" action="<?= base_url('auth/logout') ?>" style="margin:0;">
        <input value="<?php echo $id; ?>" type="hidden" name="id" id="id" class="form-control"/>
        <div class="row g-3">
          <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input value="<?php echo $name; ?>" type="text" name="name" id="name" class="form-control"/>
          </div>
          <div class="col-md-6">
            <label for="price" class="form-label">Price</label>
            <input value="<?php echo $price; ?>" type="number" name="price" id="price" class="form-control" />
          </div>
          <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary w-100">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
