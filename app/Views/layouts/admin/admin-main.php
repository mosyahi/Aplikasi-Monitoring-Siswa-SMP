<!DOCTYPE html>
<html lang="en" class="light" id="theme-switcher">
<!-- BEGIN: Head -->

<!-- head -->
<?= $this->include('layouts/admin/admin-head'); ?>
<!-- End head -->

<!-- END: Head -->

<body class="py-5">

	<!-- Sidebar Mobile -->
	<?php if (session()->get('role') === 'Admin') : ?>

	<?= $this->include('layouts/admin/admin-sidebar-mobile'); ?>

	<?php elseif (session()->get('role') === 'Siswa') : ?>

	<?= $this->include('layouts/siswa/siswa-sidebar-mobile'); ?>

	<?php elseif (session()->get('role') === 'Guru') : ?>

	<?= $this->include('layouts/guru/guru-sidebar-mobile'); ?>

	<?php endif; ?>
	<!-- End Sidebar Mobile -->

	<div class="flex mt-[4.7rem] md:mt-0">

	<!-- Sidebar Web -->
	<?php if (session()->get('role') === 'Admin') : ?>

	<?= $this->include('layouts/admin/admin-sidebar-web'); ?>

	<?php elseif (session()->get('role') === 'Siswa') : ?>

	<?= $this->include('layouts/siswa/siswa-sidebar-web'); ?>

	<?php elseif (session()->get('role') === 'Guru') : ?>

	<?= $this->include('layouts/guru/guru-sidebar-web'); ?>

	<?php endif; ?>
	<!-- End Sidebar Web -->

	<!-- Content -->
	<div class="content">

	<!-- BEGIN: Top Bar -->
	<?php if (session()->get('role') === 'Admin') : ?>

	<?= $this->include('layouts/admin/admin-top-bar'); ?>

	<?php elseif (session()->get('role') === 'Siswa') : ?>

	<?= $this->include('layouts/siswa/siswa-top-bar'); ?>

	<?php elseif (session()->get('role') === 'Guru') : ?>

	<?= $this->include('layouts/guru/guru-top-bar'); ?>

	<?php endif; ?>
	<!-- END: Top Bar -->

		<!-- Isi Conten -->
			<?= $this->renderSection('content') ?>
		<!-- END Isi Content -->

		<div class="intro-y box p-5 mt-12 sm:mt-5">
			<footer class="text-center text-gray-600">
				Copyright &copy; 
				<script>
					var CurrentYear = new Date().getFullYear()
					document.write(CurrentYear)
				</script>
				<a class="text-primary" href="#" target="blank">SMPN 2 Sumber.</a>
			</footer>
		</div>
	</div>
	<!-- END Content -->
</div>

<!-- script -->
<?= $this->include('layouts/admin/admin-script'); ?>
<!-- End script -->

</body>

</html>