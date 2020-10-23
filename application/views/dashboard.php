<!DOCTYPE html>
<html>
   <head>
      <title>Dashboard</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <style>
        body{
          font-style:italic;
        }
         .err-msg
         {
         color: red;
         font-size: 12px;
         }
         .pagination {
         float:right;
         }
         .pagination li a { 
         padding:4px 8px;
         border:1px solid #0056b3;
         margin:2px;
         }
         .pagination li a:hover{
         text-decoration:none;
         background-color:#0056b3;
         color:#fff;
         }
         .pagination li a.current_page{
         background-color:#0056b3;
         color:#fff;
         }
      </style>
   </head>
   <body>
      <?php include "header.php"; ?><br><br>
      <!-- start search blog -->
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-3 mx-auto text-center">
            <?php if($this->session->userdata('username') == 'admin')  {?>
            <button id="btnAdd" class="btn btn-success" style="border-radius: 8px;">Create Blog</button>
            <?php }else { ?>
            <button id="" class="btn btn-success" data-toggle='tooltip' title='No Access To Create Blog' disabled style="border-radius: 8px;">Create Blog</button>
            <?php } ?>
          </div>
            <div class="col-md-5 mx-auto text-center">
              <div class="search-field">
                <input type="text" class="form-control" name="search_key" id="search_key" placeholder="Search By Category Name" />
              </div>
            </div>
            <div class="col-md-4 mx-auto text-center">
              <div class="search-button">
                <button type="button" id="searchBtn" class="btn btn-info" style="border-radius: 8px;">Search</button>
                <button type="button" id="resetBtn" class="btn btn-warning" style="border-radius: 8px;">Reset</button>
              </div>
            </div>
      </div>
    </div>
    </div>
    <!-- end search blog -->
      <div class="container">
         
      </div>
      <br>
      <div class=" container alert alert-success" style="display: none;">
       </div>
      <!-- start model -->
      <div class="modal" tabindex="-1" role="dialog" id="myModal">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form method="post" id="myForm">
                    <input type="hidden" name="txtId" value="0">
                     <div class="form-group">
                        <label for="name" class="label-control col-md-4">Author Name</label>
                        <div class="col-md-12">
                           <input type="text" name="author" class="form-control" id="author">
                           <span class="err-msg" id="author_error"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="name" class="label-control col-md-4">Blog Description</label>
                        <div class="col-md-12">
                           <textarea class="form-control" id="description" name="description" value=""></textarea>
                           <span class="err-msg" id="description_error"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="name" class="label-control col-md-8">Select Blog Categories</label>
                        <div class="col-md-12">
                           <select class="form-control" id="categories" name="categories">
                              <option value="" selected>Select Categories</option>
                              <option value="Fashion Blog">Fashion Blog</option>
                              <option value="Food Blog">Food Blog</option>
                              <option value="Travel Blog">Travel Blog</option>
                              <option value="Music blog">Music Blog</option>
                              <option value="Lifestyle Blog">Lifestyle Blog</option>
                              <option value="Fitness Blog">Fitness Blog</option>
                           </select>
                           <span class="err-msg" id="categories_error"></span>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- end model -->
      <!-- show blogs -->

               <div id="ajaxContent"></div>
      <!-- end show blogs -->
      <!-- Delete.modal -->
      <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Confirm Delete</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
               <div class="modal-body">
                  Do you want to delete this record?
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
               </div>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /. Delete modal -->

      <!-- <div class="container bg-light" style="border: 1px solid cyan; border-radius: 10px;">
        <div class="row">
          <div class="col-md-6">
            <label><b>Author :-</b></label> <span>Admin</span>
          </div>
          <div class="col-md-6 text-right">
            <label><b>Action :-</b></label>
            <a href="#">Edit</a>
            <a href="#">Delete</a>
          </div>
          <div class="col-md-12 text-center">
            <label><b>Blog Description</b></label>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived..</p>
          </div>
          <div class="col-md-12 text-right">
            <label><b>Created At :-</b></label><span>2020-01-02</span>
          </div>
        </div>
      </div> -->

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
          $('.closeM').on('click',function(){
            $('#deleteModal').hide();
          });
        });
     </script>
      <script>
        $(document).ready(function(){
          // add blog
          $('#btnAdd').click(function(){
            $('#myForm')[0].reset();
                $('#myModal').modal('show');
                $('#myModal').find('.modal-title').text('Create New Blog');
                $('#myForm').attr('action', '<?php echo base_url() ?>Site/createBlog');
              });
              $('#btnSave').click(function(){
              var url = $('#myForm').attr('action');
              var data = $('#myForm').serialize();
              var is_error = false;
              $('.err-msg').text('');
              var author = $.trim($('#author').val());
              var description = $.trim($('#description').val());
              var categories = $.trim($('#categories').val());
           
                      if (author == "") {
                          scroll_validate("author", "Please Enter Author Name");
                          is_error = true;
                      }              
                      if (description == "") {
                          scroll_validate('description', "Please Enter Blog Description");
                          is_error = true;
                      }
                     if (categories == "") {
                        scroll_validate('categories', 'Please Select Blog Categorie');
                        is_error = true;
                      }
                      if (is_error == true) {
                          return false;
                      }
           
              if(is_error == false){
                $.ajax({
                  type: 'ajax',
                  method: 'post',
                  url: url,
                  data: data,
                  async: false,
                  dataType: 'json',
                  success: function(response){
                    if (response.status == 'success') {
                      $('#myModal').modal('hide');
                      $('#myForm')[0].reset();
                         if(response.type=='add'){
                            var type = 'added'
                          }else if(response.type=='update'){
                            var type ="updated"
                          }
                          $('.alert-success').html('Blog '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                      // swal("Thank You For Your Response");
                      ajaxlist(page_url=false);
                    }
                    if (response.status == 'error') {
                      $("#btnSave").attr("disabled", false);
                                    $.each(response.errors, function (element, value) {
                                        scroll_validate(element, value);
                                    });
                    }
                  },
                  error: function(){
                    alert('Something Went Wrong');
                  }
                });
              }
            });
         
              //edit blog
            $('#ajaxContent').on('click', '.item-edit', function(){
                 $('.err-msg').text('');
              var id = $(this).attr('data');
              $('#myModal').modal('show');
              $('#myModal').find('.modal-title').text('Edit Blog');
              $('#myForm').attr('action', '<?php echo base_url() ?>Site/updateBlog');
              $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>Site/editBlog',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                  $('input[name=author]').val(data.author);
                  $('textarea[name=description]').val(data.description);
                  $('select[name=categories]').val(data.categories);
                  $('input[name=txtId]').val(data.id);
                },
                error: function(){
                  alert('Could not Edit Data');
                }
              });
            });
         
            //delete- blog
            $('#ajaxContent').on('click', '.item-delete', function(){
              var id = $(this).attr('data');
              $('#deleteModal').modal('show');
              //prevent previous handler - unbind()
              $('#btnDelete').unbind().click(function(){
                $.ajax({
                  type: 'ajax',
                  method: 'get',
                  async: false,
                  url: '<?php echo base_url() ?>Site/deleteBlog',
                  data:{id:id},
                  dataType: 'json',
                  success: function(response){
                    if(response.status == 'success'){
                      $('#deleteModal').modal('hide');
                      $('.alert-success').html('Blog Deleted successfully..').fadeIn().delay(4000).fadeOut('slow');
                      ajaxlist(page_url=false);
                    }else{
                      alert('Error');
                    }
                  },
                  error: function(){
                    alert('Error deleting');
                  }
                });
              });
              });
         
              function scroll_validate(id, message) {
                             $('#' + id + "_error").text(message);
                             $('#' + id + "_error").css('display', 'block');
                             return true;
                }
          
          /*--first time load--*/
          ajaxlist(page_url=false);

          /*-- Search keyword--*/
          $(document).on('click', "#searchBtn", function(event) {
            ajaxlist(page_url=false);
            event.preventDefault();
          });
    
          /*-- Reset Search--*/
          $(document).on('click', "#resetBtn", function(event) {
            $("#search_key").val('');
            ajaxlist(page_url=false);
            event.preventDefault();
          });
         
          /*-- Page click --*/
          $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxlist(page_url);
            event.preventDefault();
          });
          
          /*-- create function ajaxlist --*/
          function ajaxlist(page_url = false)
          {
            var search_key = $("#search_key").val();
            
            var dataString = 'search_key=' + search_key;
            var base_url = '<?php echo site_url('Site/index_ajax') ?>';
            
            if(page_url == false) {
              var page_url = base_url;
            }
            
            $.ajax({
              type: "POST",
              url: page_url,
              data: dataString,
              success: function(response) {
                // console.log(response);
                $("#ajaxContent").html(response);
              }
            });
          }
          });
      </script>
   </body>
</html>