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
      // alert("hii");
      var chkVal=$(this).val(); //alert("chkVal"+chkVal);
      $('input[name="client_contact"]').empty();
      $('input[name="client_email"]').empty();
      $("select[name='cp_contact_person']").empty();

      $.post('<?= site_url('Sales/getClientInfo') ?>',{chkVal}, function(clientInfo){
        console.log(clientInfo);
        $('input[name="client_contact"]').val(clientInfo[0]['client_contact']);
        $('input[name="client_email"]').val(clientInfo[0]['client_email']);
      },'JSON'); 

      $.post('<?= site_url('Sales/getDepartment') ?>',{chkVal}, function(compInfo){
        console.log(compInfo);
        $.each(compInfo,function(p,q){           
            $("select[name='lead_dept']").append('<option value="'+q.dept_id+'">'+q.dept_name+'</option>');            
        });       
      },'JSON'); 

      $.post('<?= site_url('Sales/getContactPersons') ?>',{chkVal}, function(cpInfo){
        console.log(cpInfo);
        $.each(cpInfo,function(x,y){           
            $("select[name='cp_contact_person']").append('<option value="'+y.cp_id+'">'+y.cp_first_name+' '+y.cp_middle_name+' '+y.cp_last_name+'</option>');            
        });       
      },'JSON'); 

     });

    $(document).on('change',"select[name='lead_dept']",function(){
        var dept=$(this).val(); 
        var client=$("select[name='lead_client']").val(); //alert(client);
        $("select[name='cp_contact_person']").empty();
        $.post('<?= site_url('Sales/getContactPersonsDept') ?>',{dept,client}, function(cpInfo){
        console.log(cpInfo);
        $.each(cpInfo,function(x,y){           
            $("select[name='cp_contact_person']").append('<option value="'+y.cp_id+'">'+y.cp_first_name+' '+y.cp_middle_name+' '+y.cp_last_name+'</option>');            
        });       
      },'JSON'); 
    });


        //product calculation
        var rowCnt = 1; 
       // var arryRow = 0;
        $('.deleteProd').click(function () {
          var lr_id=$(this).attr("id"); //alert(lr_id);
          var lead_id=$("input[name='lead_id']").val(); alert(lead_id);
          $.post('<?php echo site_url('Sales/delete_lead_product')?>',{lead_id,lr_id},function(data){
            console.log(data);
            if(data==true){
              alert("Producct Deleted");
              // window.location.href = "<?php echo site_url('sales/update_lead_open/'.$lead_id.'');?>";
              $(location).attr("href","<?php echo site_url('sales/update_lead_open/'); ?>"+lead_id);
            }else{
              alert("Error...");lead_id
            }
            
        },'JSON');  
        });
        $('.add_row').click(function () {
            arryRow=$("input[name='initialCnt']").val();
            rowCnt++;
            //alert(arryRow);
            // arryRow++;
            var old = $('#stock').html();
            var newrow = '<tr id="org">'+
                          '<td><input type="checkbox">'+
                          '<input type="hidden" class="form-control lr_id" name="lr_id['+arryRow+']" value="0">'+
                          '</td>'+
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
                          '<td id="lr_product_specification"><textarea class="form-control lr_product_specification" name="lr_product_specification['+arryRow+']"></textarea></td>'+
                          '<td id="lr_product_gem_link"><input type="text" class="form-control lr_product_gem_link" name="lr_product_gem_link['+arryRow+']"></td>'+
						  '<td id="lr_product_budget"><input type="text" class="form-control lr_product_budget" name="lr_product_budget['+arryRow+']"></td>'+
                          '<td id="lr_oem_involved">'+
                            '<select class="form-control lr_oem_involved" name="lr_oem_involved['+arryRow+']">'+
                              '<option>Please select</option>'+
                              '<option value="Yes">Yes</option>'+
                              '<option value="No">No</option>'+
                            '</select>'+
                          '</td>'+
                        '</tr>';
                $('#stock').append(newrow);
                var a=1;
                var rowVal=parseInt(arryRow) +parseInt(a);
                $("input[name='initialCnt']").val(rowVal);
                  

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
