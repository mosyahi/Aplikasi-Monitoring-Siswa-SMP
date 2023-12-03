<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
	<?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center mt-4">
	<h2 class="text-lg font-medium mr-auto">
		Profile
	</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 lg:col-span-12">
		<!-- BEGIN: Input -->
		<div class="intro-y box">
			<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
				<h2 class="font-medium text-base mr-auto">
					Form Profile
				</h2>
			</div>
			<form action="<?= site_url('admin/profile/update/' . $userData['id_user']) ?>" method="POST" enctype="multipart/form-data">
				<div id="input" class="p-5">
					<div class="preview">
						<div>
							<label for="regular-form-1" class="form-label">Nama</label>
							<input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $userData['nama'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Email</label>
							<input type="email" name="email" class="form-control block mx-auto" value="<?= $userData['email'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Password</label>
							<input type="password" name="password" class="form-control block mx-auto" value="<?= $userData['password'] ?>" required disabled>
						</div>
					</div>
					<div class="mt-5">
						<button type="submit" class="btn btn-primary-soft w-24 mr-1 mb-2"><i class="w-4 h-4 mr-2 fas fa-edit"></i>Edit</button>
						<a type="button" href="<?= base_url('admin/dashboard') ?>" class="btn btn-pending-soft w-24 mr-1 mb-2"><i class="w-4 h-4 mr-2 fas fa-times"></i>Batal</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END: Input -->

<?= $this->endSection() ?>