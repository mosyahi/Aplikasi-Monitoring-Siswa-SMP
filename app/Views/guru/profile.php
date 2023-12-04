<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<style>
	.password-input-group {
		position: relative;
	}

	.password-toggle {
		position: absolute;
		top: 70%;
		right: 10px;
		transform: translateY(-50%);
		cursor: pointer;
	}
</style>

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
			<form action="<?= site_url('guru/profile/update/' . $guruData['id_guru']) ?>" method="POST" enctype="multipart/form-data">
				<div id="input" class="p-5">
					<div class="preview">
						<div>
							<label for="regular-form-1" class="form-label">Nama</label>
							<input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $guruData['nama'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Email</label>
							<input type="email" name="email" class="form-control block mx-auto" value="<?= $guruData['email'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">NIP</label>
							<input id="regular-form-1" name="nip" type="number" class="form-control" value="<?= $guruData['nip'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Tempat Lahir</label>
							<input id="regular-form-1" name="tempat_lahir" type="text" class="form-control" value="<?= $guruData['tempat_lahir'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Tanggal Lahir</label>
							<input type="text" name="tanggal_lahir" class="datepicker form-control block mx-auto" value="<?= $guruData['tanggal_lahir'] ?>" data-single-mode="true" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Jenis Kelamin</label>
							<select data-placeholder="Pilih Jenis Kelamin" name="jk" class="tom-select w-full" required>
								<option value="L" <?= ($guruData['jk'] == 'L') ? 'selected' : '' ?>>Laki - Laki</option>
								<option value="P" <?= ($guruData['jk'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
							</select> 
						</div>
					</div>
					<!-- <div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Password</label>
							<input type="password" name="password" class="form-control block mx-auto" placeholder="BELUM SELESAI">
						</div>
					</div> -->
					<div class="preview">
						<label for="regular-form-1" class="form-label mt-3">Upload Foto</label>
						<div>
							<div class="fallback"> 
								<input name="foto" type="file" id="uploadFoto" onchange="previewFoto(this);" /></div>
								<div id="fotoPreview" class="mt-3">
									<img id="previewImage" src="<?= base_url('uploads/guru/' . $guruData['foto']) ?>" alt="Foto Guru" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="mt-5">
							<button type="submit" class="btn btn-primary-soft w-24 mr-1 mb-2"><i class="w-4 h-4 mr-2 fas fa-edit"></i>Simpan</button>
							<a type="button" href="<?= base_url('guru/dashboard') ?>" class="btn btn-pending-soft w-24 mr-1 mb-2"><i class="w-4 h-4 mr-2 fas fa-times"></i>Batal</a>
						</form>
						<a type="button" class="btn btn-dark-soft w-35 mr-1 mb-2" data-tw-toggle="modal" data-tw-target="#update-<?= $guruData['id_user'] ?>"><i class="w-4 h-4 mr-2 fas fa-lock"></i>Ganti Password</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Input -->


	<div id="update-<?= $guruData['id_user'] ?>" class="modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="font-medium text-base mr-auto">Reset Password</h2> 
				</div>
				<form action="<?= base_url('guru/profile/ganti-password/' . $guruData['id_user']) ?>" method="POST">
					<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
						<div class="col-span-12 sm:col-span-12">
							<div class="password-input-group">
								<label for="regular-form-1" class="form-label">Password Lama</label>
								<input id="password_lama" name="password_lama" type="password" class="form-control" value="<?= old('password_lama') ?>" required>
								<i class="password-toggle fas fa-eye-slash text-primary" onclick="togglePassword('password_lama')"></i>
							</div>
						</div>

						<!-- Password Baru -->
						<div class="col-span-12 sm:col-span-12">
							<div class="password-input-group">
								<label for="regular-form-1" class="form-label">Password Baru</label>
								<input id="password_baru" name="password_baru" type="password" class="form-control" value="<?= old('password_baru') ?>" required>
								<i class="password-toggle fas fa-eye-slash text-primary" onclick="togglePassword('password_baru')"></i>
							</div>
						</div>

						<!-- Konfirmasi Password -->
						<div class="col-span-12 sm:col-span-12">
							<div class="password-input-group">
								<label for="regular-form-1" class="form-label">Konfirmasi Password</label>
								<input id="konfirmasi_password" name="konfirmasi_password" type="password" class="form-control" value="<?= old('konfirmasi_password') ?>" required>
								<i class="password-toggle fas fa-eye-slash text-primary" onclick="togglePassword('konfirmasi_password')"></i>
							</div>
						</div>
					</div>
					<div class="modal-footer"> 
						<button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button> 
						<button type="submit" class="btn btn-primary w-20">Simpan</button> 
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function previewFoto(input) {
			var fotoPreview = document.getElementById('fotoPreview');
			var previewImage = document.getElementById('previewImage');

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					previewImage.src = e.target.result;
					fotoPreview.style.display = 'block';
				};

				reader.readAsDataURL(input.files[0]);
			} else {
				fotoPreview.style.display = 'none';
			}
		}

		function togglePassword(inputId) {
			const passwordInput = document.getElementById(inputId);
			const icon = document.querySelector(`#${inputId} + i`);

			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				icon.classList.remove('fa-eye-slash');
				icon.classList.add('fa-eye');
			} else {
				passwordInput.type = "password";
				icon.classList.remove('fa-eye');
				icon.classList.add('fa-eye-slash');
			}
		}
	</script>

	<?= $this->endSection() ?>