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
<script src="<?= base_url();?>/public/frontEnd/vendor/jquery/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
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

    $('#leadDetails').on('show.bs.modal', function(e) {
      var lead = $(e.relatedTarget).data('id');
      var lead_data = lead.split("*");
      var lead_id = lead_data[0];
      var lead_client = lead_data[1];
      var lead_dept = lead_data[2];
      var lead_contact = lead_data[3];
      // console.log(lead_dept);
      $.post('<?= site_url('Sales/getLeadInfo') ?>',{chkVal:lead_id},function(lData){
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $('.lead_date').html(new Date(lData[0].lead_due_date).getDate()+" "+months[new Date(lData[0].lead_due_date).getMonth()]+" "+new Date(lData[0].lead_due_date).getFullYear());
        $('.lead_budget').html(lData[0].lead_budget+" /-");
      },'json');

      $.post('<?= site_url('Sales/getClientInfo') ?>',{chkVal:lead_client},function(clData){
        $('.client_name').html(clData[0].client_name);
        $('.contact_no').html(clData[0].client_contact);
        $('.contact_email').html(clData[0].client_email);
      },'json');

      $.post('<?= site_url('Sales/getDepartmentInfo') ?>',{chkVal:lead_dept},function(dpData){
        console.log('Department : '+dpData);
        $('.dept_name').html(dpData[0].dept_name);
      },'json');

      $.post('<?= site_url('Sales/getContactPersonsInfo') ?>',{chkVal:lead_contact},function(cpData){
        console.log(cpData);
        $('.contact_person_name').html(cpData[0].cp_last_name+" "+cpData[0].cp_first_name+" "+cpData[0].cp_middle_name);
        $('.contact_person_no').html(cpData[0].cp_mobile);
        $('.contact_person_email').html(cpData[0].cp_email);
      },'json');

      $.post('<?= site_url('Sales/getLeadProducts') ?>',{lead_id},function(prData){
        console.log(prData);
        $(".product_data").empty();
        var i = 1;
        $.each(prData,function(x,y){           
          $(".product_data").append('<tr><td><center>'+i+'</center></td><td>'+y.product_name+'</td><td><center>'+y.lr_quantity+'</center></td><tr>'); 
          i++;    
        }); 
      },'json');
    });

    $('#masterData').validate({
      rules: {
        dc_action:{
          required:true
        },
        dc_date:{
          required:true
        },
        dc_remark:{
          required:true
        },     
      },
      messages: {
      },      
    });
  });
</script>
</body>
</html>
