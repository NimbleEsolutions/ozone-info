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
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- jquery-validation -->
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
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

		$(document).on('click','#import_users',function(){
			$('#import_profiles').toggle();
		});

		$(document).on('change','select[name="user_role_id"]',function(){
			var role_id = $("select[name='user_role_id']").val();
			$("select[name='up_mod_id']").val("");
			if(role_id == 5){
				$('#user_program').toggle();			
			}else{
				$('#user_program').hide();
			}
		});

		bsCustomFileInput.init();

		$('#createProfile').validate({
			rules: {
				user_firstName: {
					required: true
				},
				user_lastName: {
					required: true
				},
				user_email: {
					required:true,
					email: true
				},
				user_mobile: {
					required:true,
					digits:true,
					minlength:10,
					maxlength:10
				},
				user_role_id: {
					required: true
				},
				up_mod_id: {
					required: true
				},
				user_password: {
					required: true,
					minlength: 6
				},
				user_cfm_password: {
					required: true,
					equalTo:'input[name="user_password"]'
				},
				user_file: {
					required: true,
					extension: "xlsx|xls"
				}
			},
			messages: {
				user_file: {
					required: true,
					extension: "Please upload valid file formats .xlsx, .xls only."
				}
			},
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	});
</script>
</body>
</html>
