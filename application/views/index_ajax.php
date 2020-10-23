
<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<?php if( ! empty($products)) { ?>
      <?php foreach($products as $product){ ?>
<div class="container bg-light mt-4" style="border: 1px solid cyan; border-radius: 10px;box-shadow: 5px 2px 7px 4px #888888;
">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-6">
            <label><b>Author :-</b></label> <span><?php echo $product->author ?></span>
          </div>
          <div class="col-md-6 col-sm-6 col-6 text-right">
            
            <?php if($this->session->userdata('username') == 'admin')  {?>
              <label><b>Action :-</b></label>
            <a href="javascript:;" class="item-edit" data="<?php echo $product->id ?>">Edit</a>
            <a href="javascript:;" class="item-delete" data="<?php echo $product->id ?>">Delete</a>
          <?php }else{ ?>

          <?php } ?>
          </div>
          <div class="col-md-12 text-center">
            <label><b>Blog Description</b></label>
            <p><?php echo $product->description  ?></p>
          </div>
          <div class="col-md-6 col-sm-6 col-6">
            <label><b>Category :-</b></label><span><?php echo $product->categories   ?></span>
          </div>
          <div class="col-md-6 col-sm-6 col-6 text-right">
            <label><b>Created At :-</b></label><span><?php echo $product->created_at  ?></span>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } else { ?>
        <center>No records</center>
      <?php } ?>
<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<div class="container mt-3">
  <div class="box-footer">
  <ul class="pagination">
    <?php echo $page ?>
  </ul>
</div>
</div>
