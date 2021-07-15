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
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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


    $("input[name='bid_endDate'],input[name='bid_openDate']").inputmask("datetime");

    $("select[name='bid_emd']").change(function(){
      var bid_emd = $(this).val();
      if(bid_emd == 'Yes'){
        $("#bid_emd_val").removeClass().addClass('col-sm-3');
      }else{
        $("#bid_emd_val").removeClass().addClass('col-sm-3 hidden');        
        $("input[name='bid_emd_val']").val('');        
      }
    });

     $("select[name='bid_epbg']").change(function(){
      var bid_epbg = $(this).val();
      if(bid_epbg == 'Yes'){
        $("#bid_epbg_val").removeClass().addClass('col-sm-3');
      }else{
        $("#bid_epbg_val").removeClass().addClass('col-sm-3 hidden');        
        $("input[name='bid_epbg_val']").val('');        
      }
    })
    //volume calculation
    var rowCnt = <?= count($bid_product); ?>; 
    var arryRow = <?= count($bid_product)-1; ?>;
    $('.add_row').click(function () { //alert("hi");
      arryRow++;
      rowCnt++;
      var old = $('#stock').html();
      var newrow = '<tr id="org">'+
        '<td style="padding: 0;text-align: center;"><input type="checkbox"></td>'+
        '<td  style="padding: 0;vertical-align: top;" id="item">'+
          '<select class="form-control bidprod_product_id" name="bidprod_product_id['+arryRow+']" required>'+
            '+<option value="">- Choose item -</option>'+
            '<?php foreach($all_products as $key) {?>'+
              '<option value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>'+
            '<?php } ?>'+
          '</select>'+
        '</td>'+
        '<td  style="padding: 0;vertical-align: top;" id="bidprod_qty">'+
          '<input type="text" class="form-control bidprod_qty" name="bidprod_qty['+arryRow+']">'+
        '</td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_spcification"><textarea  class="form-control bidprod_spcification" name="bidprod_spcification['+arryRow+']" rows="1"></textarea></td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_mm"><textarea rows="1" class="form-control bidprod_mm" name="bidprod_mm['+arryRow+']"></textarea></td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_budget"><input type="text" class="form-control bidprod_budget" name="bidprod_budget['+arryRow+']"></td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_gem"><input type="text" class="form-control bidprod_gem" name="bidprod_gem['+arryRow+']"></td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_tprice"><input type="text" class="form-control bidprod_tprice" name="bidprod_tprice['+arryRow+']"></td>'+
        '<td style="padding: 0;vertical-align: top;" id="bidprod_qprice"><input type="text" class="form-control bidprod_qprice" name="bidprod_qprice['+arryRow+']"></td>'+
      '</tr>'
      $('#stock').append(newrow);
      

      $("[name^=lr_quantity]").each(function () {
        $(this).rules("add", {
          required: true,
          digits: true
        });           
      }); 
    });

    $( "#masterData" ).submit(function( event ) {
      event.preventDefault();
      if($(this).valid()) {
        var department = $('input[name="dept_name"]').val();
        $("select[name='bid_dept']").empty();
        $.post("<?= site_url('sales/register_department'); ?>",{department},function(drpt){
          $("select[name='bid_dept']").append('<option value="">Please select</option>');
          $.each(drpt,function(p,q){           
            $("select[name='bid_dept']").append('<option value="'+q.dept_id+'">'+q.dept_name+'</option>');            
          });
          toastr.success("Department created successfully...!!");
          $('#newDepartment').modal('toggle');
        },"JSON");
      }
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

    $('#createBid').validate({
      rules: {
        bid_type:{
          required:true
        },
        bid_lead_ref:{
          required:true
        },
        bid_endDate:{
          required:true
        },
        bid_openDate:{
          required:true
        },
        bid_validity:{
          required:true,
          digits:true
        },
        bid_region:{
          required:true
        },
        bid_client:{
          required:true
        },
        bid_dept:{
          required:true
        },
        bid_emd:{
          required:true
        },
        bid_emd_val:{
          required:true
        },
        bid_epbg:{
          required:true
        },
        bid_epbg_val:{
          required:true
        },             
      },
      messages: {
      },      
    });
  });

   function deleteRow(tbid) {
    // alert("Hiiii");
    try {
      var table = document.getElementById(tbid);
      var rowCount = table.rows.length;
      for (var i = 0; i < rowCount; i++) {
        var row = table.rows[i];
        var chk = row.cells[0].childNodes[0];
        console.log(chk);
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
