<!DOCTYPE html>
<html lang="en" class="light" id="theme-switcher">
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

		<!-- Sidebar Web -->
		<?php if (session()->get('role') === 'Admin') : ?>

			<?= $this->include('layouts/admin/admin-sidebar-web'); ?>

		<?php elseif (session()->get('role') === 'Siswa') : ?>

			<?= $this->include('layouts/admin/siswa-sidebar-web'); ?>

		<?php elseif (session()->get('role') === 'Orangtua') : ?>

			<?= $this->include('layouts/admin/ortu-sidebar-web'); ?>

		<?php endif; ?>
		<!-- End Sidebar Web -->

		<!-- Content -->
		<div class="content">

			<!-- BEGIN: Top Bar -->
			<?= $this->include('layouts/admin/admin-top-bar'); ?>
			<!-- END: Top Bar -->

			<!-- Isi Conten -->
			<?= $this->renderSection('content') ?>
			<!-- END Isi Content -->

			<div class="intro-y box p-5 mt-12 sm:mt-5">
				<footer class="text-center text-gray-600">
					&copy; Template by Midone Tailwind | &copy; 2023 <a class="text-primary" href="https://mosyahizuku.site/blog" target="blank">Webcrafser.</a>
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