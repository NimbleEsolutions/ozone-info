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
      console.log('<?= $success; ?>');
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

    $('#deleteCP').on('show.bs.modal', function(e) {
        var cp_id = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="cp_id"]').val(cp_id);
    });

    $('#deleteDept').on('show.bs.modal', function(e) {
        var dept_id = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="dept_id"]').val(dept_id);
    });

    $('#deleteClient').on('show.bs.modal', function(e) {
        var client_id = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="client_id"]').val(client_id);
    });

     $(document).on('change',"select[name='client_state']",function(){
     // alert("hii");
      var chkVal=$(this).val(); //alert("chkVal"+chkVal);
      // $('input[name="client_city"]').val('');
     
      $.post('<?= site_url('Master/getCity') ?>',{chkVal}, function(cityInfo){
        console.log(cityInfo);
        $('select[name="client_city"]').empty();
        $("select[name='client_city']").append('<option value="">Please select</option>');            
        $.each(cityInfo,function(p,q){           
            $("select[name='client_city']").append('<option value="'+q.ct_id+'">'+q.ct_name+'</option>');            
        });       
      },'JSON'); 
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

     $('#createClient').validate({
      rules: {
        client_name:{
          required:true
        },
        client_contact:{
          required:true,
          digits:true,
          maxlength:10,
          minlength:10
        },
        client_email:{
          required:true
        },
        client_other_contact:{
          digits:true,
          maxlength:10,
          minlength:10
        },
        client_state:{
          required:true
        },
        client_city:{
          required:true
        },
        client_address:{
          required:true
        },
        client_pincode:{
          required:true,
          digits:true,
          maxlength:6,
          minlength:6
        },
        cp_first_name:{
          required:true
        },
        cp_last_name:{
          required:true
        },
        cp_mobile:{
          required:true,
          digits:true,
          maxlength:10,
          minlength:10
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
  });
</script>
</body>
</html>
