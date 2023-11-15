<!DOCTYPE html>
<html lang="en" class="dark">
<!-- BEGIN: Head -->

<!-- head -->
<?= $this->include('layouts/admin/admin-head'); ?>
<!-- End head -->

<!-- END: Head -->
<body class="py-5">
	
	<!-- Sidebar Mobile -->
	<?= $this->include('layouts/admin/admin-sidebar-mobile'); ?>
	<!-- End Sidebar Mobile -->

	<div class="flex mt-[4.7rem] md:mt-0">
		<!-- Sidebar Mobile -->
		<?= $this->include('layouts/admin/admin-sidebar-web'); ?>
		<!-- End Sidebar Mobile -->

		<!-- Content -->
		<div class="content">

			<!-- BEGIN: Top Bar -->
			<?= $this->include('layouts/admin/admin-top-bar'); ?>
			<!-- END: Top Bar -->
			
			<!-- Isi Conten -->
			<?= $this->renderSection('content') ?>
			<!-- END Isi Content -->

		</div>
		<!-- END Content -->

	</div>

	<!-- script -->
	<?= $this->include('layouts/admin/admin-script'); ?>
	<!-- End script -->

</body>
</html>