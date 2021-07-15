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

    $('#bidFile').on('show.bs.modal', function(e) {
      var bid_id = $(e.relatedTarget).data('id');
      $(e.currentTarget).find('input[name="up_type_id"]').val(bid_id);
    });
	
	 $('#bidDetails').on('show.bs.modal', function(e) {
      var bid = $(e.relatedTarget).data('id');
      var bid_data = bid.split("*"); //alert(bid);
      var bid_id = bid_data[0];
      var bid_client = bid_data[1];
      var bid_dept = bid_data[2];
      var bid_contact = bid_data[3];
      var bid_region = bid_data[4];
      // console.log(lead_dept);
      $.post('<?= site_url('Bid/getBidInfo') ?>',{chkVal:bid_id},function(bid_data){
        console.log(bid_data);
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $('.bid_end_date').html(new Date(bid_data[0].bid_endDate).getDate()+" "+months[new Date(bid_data[0].bid_endDate).getMonth()]+" "+new Date(bid_data[0].bid_endDate).getFullYear());
        $('.bid_open_date').html(new Date(bid_data[0].bid_openDate).getDate()+" "+months[new Date(bid_data[0].bid_openDate).getMonth()]+" "+new Date(bid_data[0].bid_openDate).getFullYear());
        $('.bid_no').html(bid_data[0].bid_lead_ref+"");
        $('.bid_emd').html(bid_data[0].bid_emd_val+"");
        $('.bid_epbg').html(bid_data[0].bid_epbg_val+"");
        $('.bid_validity').html(bid_data[0].bid_validity+"");
      },'json');

      $.post('<?= site_url('Sales/getRegionInfo') ?>',{chkVal:bid_region},function(clData){
         $('.bid_region').html(clData[0].reg_name);
      },'json');
      
      // $.post('<?= site_url('Sales/getClientInfo') ?>',{chkVal:lead_client},function(clData){
      //   $('.client_name').html(clData[0].client_name);
      //   $('.contact_no').html(clData[0].client_contact);
      //   $('.contact_email').html(clData[0].client_email);
      // },'json');

      $.post('<?= site_url('Bid/getDepartmentInfo') ?>',{chkVal:bid_dept},function(dpData){
        console.log(dpData);
        $('.client_dept').html(dpData[0].dept_name);
      },'json');

      $.post('<?= site_url('Sales/getContactPersonsInfo') ?>',{chkVal:bid_contact},function(cpData){
        console.log(cpData);
        $('.contact_person_name').html(cpData[0].cp_last_name+" "+cpData[0].cp_first_name+" "+cpData[0].cp_middle_name);
        $('.contact_person_no').html(cpData[0].cp_mobile);
        $('.contact_person_email').html(cpData[0].cp_email);
      },'json');     

      $.post('<?= site_url('Bid/getEligibility') ?>',{chkVal:bid_id},function(elInfo){
        console.log(elInfo);
        $(".elegibility_data").empty();
        var i = 1;
        $.each(elInfo,function(x,y){           
          $(".elegibility_data").append('<tr><td><center>'+i+'</center></td><td>'+y.el_name+'</td><td><center>'+y.be_value +'</center></td><td>'+y.be_doc_name+'</td><tr>'); 
          i++;    
        }); 
      },'json');

      $.post('<?= site_url('Bid/getTerms') ?>',{chkVal:bid_id},function(elInfo){
        console.log(elInfo);
        $(".terms_data").empty();
        var i = 1;
        $.each(elInfo,function(x,y){           
          $(".terms_data").append('<tr><td><center>'+i+'</center></td><td>'+y.term_name+'</td><td><center>'+y.bt_value +'</center></td><td>'+y.bt_doc_remark+'</td><tr>'); 
          i++;    
        }); 
      },'json');

		$.post('<?= site_url('Bid/getBidProducts') ?>',{chkVal:bid_id},function(prData){
        console.log(prData);
        $(".product_data").empty();
        var i = 1;
        $.each(prData,function(x,y){           
          $(".product_data").append('<tr><td><center>'+i+'</center></td><td>'+y.product_name+'</td><td><center>'+y.bidprod_qty+'</center></td><td>'+y.bidprod_spcification+'</td><td>'+y.bidprod_mm+'</td><td>'+y.bidprod_budget+'</td><td>'+y.bidprod_gem+'</td><td>'+y.bidprod_qprice+'</td><tr>'); 
          i++;    
        }); 
      },'json');

    });


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
    var rowCnt = 1; 
    var arryRow = 0;
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
