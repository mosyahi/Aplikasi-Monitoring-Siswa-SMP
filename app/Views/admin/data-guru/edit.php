<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
	<?= $this->include('components/alert-login') ?>
</div>

<div class="intro-y flex items-center mt-4">
	<h2 class="text-lg font-medium mr-auto">
		Edit Data Guru
	</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 lg:col-span-12">
		<!-- BEGIN: Input -->
		<div class="intro-y box">
			<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
				<h2 class="font-medium text-base mr-auto">
					Edit Data Guru
				</h2>
			</div>
			<form action="<?= site_url('admin/data-guru/update/' . $guru['id_guru']) ?>" method="POST" enctype="multipart/form-data">
				<div id="input" class="p-5">
					<div class="preview">
						<div>
							<label for="regular-form-1" class="form-label">Nama</label>
							<input id="regular-form-1" name="nama" type="text" class="form-control" placeholder="Nama Lengkap dan Gelar" value="<?= $guru['nama'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Email</label>
							<input id="regular-form-1" name="email" type="email" class="form-control" placeholder="Email Aktif" value="<?= $guru['email'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">NIP</label>
							<input id="regular-form-1" name="nip" type="number" class="form-control" placeholder="Nomor Induk" value="<?= $guru['nip'] ?>" minlength="10" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Tempat Lahir</label>
							<input id="regular-form-1" name="tempat_lahir" type="text" class="form-control" placeholder="Tempat Lahir" value="<?= $guru['tempat_lahir'] ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Tanggal Lahir</label>
							<input type="text" name="tanggal_lahir" class="datepicker form-control block mx-auto" value="<?= $guru['tanggal_lahir'] ?>" data-single-mode="true" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Jenis Kelamin</label>
							<select data-placeholder="Pilih Jenis Kelamin" name="jk" class="tom-select w-full" required>
								<option value="L" <?= ($guru['jk'] == 'L') ? 'selected' : '' ?>>Laki - Laki</option>
								<option value="P" <?= ($guru['jk'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
							</select> 
						</div>
					</div>
					<div class="preview">
						<label for="regular-form-1" class="form-label mt-3">Upload Foto</label>
						<div class="dropzone">
							<div class="fallback"> 
								<input name="foto" type="file" id="uploadFoto" onchange="previewFoto(this);" /></div>
								<div id="fotoPreview" class="mt-3">
									<img id="previewImage" src="<?= base_url('uploads/guru/' . $guru['foto']) ?>" alt="Foto Guru" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="mt-3">
							<button type="submit" class="btn btn-rounded btn-primary-soft w-24 mr-1 mb-2">Simpan</button>
							<a type="button" href="<?= base_url('admin/data-guru') ?>" class="btn btn-rounded btn-pending-soft w-24 mr-1 mb-2">Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Input -->

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
	</script>

	<?= $this->endSection() ?>