<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    <!-- Anything you want -->
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2021-2022 <a href="https://nimble-esolutions.com/">Nimble e-Solutions</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url();?>/public/frontEnd/vendor/jquery/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
<script src="<?php echo  base_url();?>/public/frontEnd/vendor/validate/jquery.validate.min.js"></script>
<script src="<?php echo  base_url();?>/public/frontEnd/vendor/validate/additional-methods.min.js"></script>


<script type="text/javascript">
	$(window).on('load',function() {
    $(".loader").fadeOut("slow");
  });

  $(document).ready(function () {
    <?php if(isset($success)): ?>
      toastr.success("<?php echo $success; ?>");
    <?php endif; ?>
    <?php if(isset($info)): ?>
      toastr.info("<?php echo $info; ?>");
    <?php endif; ?>
    <?php if(isset($error)): ?>
      toastr.error("<?php echo $error; ?>");
    <?php endif; ?>

    $( ".datepicker" ).datepicker({
      dateFormat : 'yy-m-d',
      changeMonth: true,
      changeYear: true,
    });

    $(document).on('change',"select[name='lead_client']",function(){
      var chkVal=$(this).val(); 
      $('input[name="client_contact"]').empty();
      $('input[name="client_email"]').empty();

      $.post('<?= site_url('Sales/getClientInfo') ?>',{chkVal}, function(clientInfo){
        $('input[name="client_contact"]').val(clientInfo[0]['client_contact']);
        $('input[name="client_email"]').val(clientInfo[0]['client_email']);
      },'JSON');
    });

    $(document).on('change',"select[name='lead_dept']",function(){
      var dept=$(this).val(); 
        var client=$("select[name='lead_client']").val(); //alert(client);
        $("select[name='cp_contact_person']").empty();
        $.post('<?= site_url('Sales/getContactPersonsDept') ?>',{dept,client}, function(cpInfo){
          $("select[name='cp_contact_person']").append('<option value="">Please select</option>');
          $.each(cpInfo,function(x,y){           
            $("select[name='cp_contact_person']").append('<option value="'+y.cp_id+'">'+y.cp_first_name+' '+y.cp_middle_name+' '+y.cp_last_name+'</option>');            
          });       
        },'JSON'); 
      });


        //volume calculation
        var rowCnt = 1; 
        var arryRow = 0;
        $('.add_row').click(function () { //alert("hi");
          arryRow++;
          rowCnt++;
          var old = $('#stock').html();
          var newrow = '<tr id="org">'+
          '<td><input type="checkbox"></td>'+
          '<td id="item">'+
          '<select class="form-control lr_product_id" name="lr_product_id['+arryRow+']" required>'+
          '<option value="">- Choose item -</option>'+
          '<?php foreach($all_products as $key) {?>'+
          '<option value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>'+                                                  
          '<?php } ?>'+
          '</select>'+
          '</td>'+
          '<td id="lr_quantity">'+
          '<input type="text" class="form-control lr_quantity" name="lr_quantity['+arryRow+']">'+
          '</td>'+
          '<td id="lr_proposed_product"><input type="text" class="form-control lr_proposed_product" name="lr_proposed_product['+arryRow+']"></td>'+
          '<td id="lr_product_specification"><input type="text" class="form-control lr_product_specification" name="lr_product_specification['+arryRow+']"></td>'+
          '<td id="lr_product_gem_link"><input type="text" class="form-control lr_product_gem_link" name="lr_product_gem_link['+arryRow+']"></td>'+
          '</tr>';
          $('#stock').append(newrow);
          

          $("[name^=lr_quantity]").each(function () {
            $(this).rules("add", {
              required: true,
              digits: true
            });
                // $(this).messages("add",{
                //   digits: "Please enter quantity in digits"
                // });
              });       
        });


        $('#createLead').validate({
          rules: {
            lead_budget:{
              required:true,
              digits:true
            },
            lead_client:{
              required:true
            },
            lead_region:{
              required:true
            },
            lead_dept:{
              required:true
            },
            cp_contact_person:{
              required:true
            },
            lead_generated_date:{
              required:true
            },
            lead_due_date:{
              required:true
            }        
          },
          messages: { 
          },
        });

        $('#masterData').validate({
          rules: {
            dept_name:{
              required:true
            },
            product_name:{
              required:true
            }        
          },
          messages: {

          },
        });

        $('#contactData').validate({
          rules: {
            cp_first_name:{
              required:true
            },
            cp_last_name:{
              required:true
            },
            cp_mobile:{
              required:true,
              digits:true,
              minlength:10,
              maxlength:10
            },
            cp_email:{
              required:true
            },
            cp_department:{
              required:true
            }        
          },
          messages: {

          },
        });

        $( "#masterData" ).submit(function( event ) {
          event.preventDefault();
          if($(this).valid()) {
            var department = $('input[name="dept_name"]').val();
            $("select[name='lead_dept'],select[name='cp_department']").empty();
            $.post("<?= site_url('sales/register_department'); ?>",{department},function(drpt){
          // console.log(drpt);
          $("select[name='lead_dept'],select[name='cp_department']").append('<option value="">Please select</option>');
          $.each(drpt,function(p,q){           
            $("select[name='lead_dept'],select[name='cp_department']").append('<option value="'+q.dept_id+'">'+q.dept_name+'</option>');            
          });
          toastr.success("Department created successfully...!!");
          $('#newDepartment').modal('toggle');
        },"JSON");
          }
        });

        $( "#contactData" ).submit(function( event ) {
          event.preventDefault();
          if($(this).valid()) {
            var lead_client = $('select[name="lead_client"]').val();
            var lead_dept = $('select[name="lead_dept"]').val();
            var cp_first_name = $('input[name="cp_first_name"]').val();
            var cp_middle_name = $('input[name="cp_middle_name"]').val();
            var cp_last_name = $('input[name="cp_last_name"]').val();
            var cp_mobile = $('input[name="cp_mobile"]').val();
            var cp_email = $('input[name="cp_email"]').val();
            var cp_department = $('select[name="cp_department"]').val();
            $("select[name='cp_contact_person']").empty();
            $.post("<?= site_url('sales/register_contact_person'); ?>",{lead_dept, lead_client,cp_first_name, cp_middle_name, cp_last_name, cp_mobile, cp_email, cp_department},function(contactPerson){
              console.log(contactPerson);
              $("select[name='cp_contact_person']").append('<option value="">Please select</option>');
              $.each(contactPerson,function(p,q){           
                $("select[name='cp_contact_person']").append('<option value="'+q.cp_id+'">'+q.cp_first_name+" "+cp_last_name+'</option>');            
              }); 
              toastr.success("Contact Person created successfully...!!");
              $('#newContactPersons').modal('toggle');
            },"JSON");
          }
        });
      });

      function deleteRow(tbid) {
        //alert("Hiiii");
        try {
          var table = document.getElementById(tbid);
          var rowCount = table.rows.length;
          for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chk = row.cells[0].childNodes[0];
            if (null != chk && true == chk.checked) {
              if (rowCount <= 1) {
                alert("Cannot delete all rows.");
                break;
              }
              table.deleteRow(i);
              rowCount--;
              i--;
            }
          }
        } catch (e) {
          alert(e);
        }
      }
    </script>
  </body>
  </html>
