<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">My Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <?php echo ucfirst($this->session->userdata('username')); ?>
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php base_url()?>logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- <div class="container bg-light">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 text-center"><h3><b><i>Blog Application</i></b></h3></div>
    <div class="col-md-4 text-center">You Login As <?php echo $this->session->userdata('username'); ?> <a href="<?php base_url()?>logout">Logout</a></div>
  </div>
</div> -->