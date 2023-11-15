<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
	<?= $this->include('components/alert-login') ?>
</div>

<div class="intro-y flex items-center mt-4">
	<h2 class="text-lg font-medium mr-auto">
		Add Data Orang Tua Siswa
	</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 lg:col-span-12">
		<!-- BEGIN: Input -->
		<div class="intro-y box">
			<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
				<h2 class="font-medium text-base mr-auto">
					Input Data Orang Tua
				</h2>
			</div>
			<form action="<?= site_url('admin/data-orangtua/add') ?>" method="POST" enctype="multipart/form-data">
				<div id="input" class="p-5">
					<div class="preview">
						<div>
							<label for="regular-form-1" class="form-label">Nama</label>
							<input id="regular-form-1" name="nama" type="text" class="form-control" placeholder="Nama Lengkap Orangtua" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Nama Siswa</label>
							<select data-placeholder="Pilih Siswa" name="id_siswa" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Siswa --</option>
								<?php foreach ($siswa as $item) : ?>
									<option value="<?= $item['id_siswa'] ?>"><?= $item['nis'] ?> - <?= $item['nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Email</label>
							<input id="regular-form-1" name="email" type="email" class="form-control" placeholder="Email Aktif" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Posisi</label>
							<select data-placeholder="Pilih Kelas" name="sbg" class="tom-select w-full" required>
								<option selected disabled>-- Pilih --</option>
								<option>Ayah</option>
								<option>Ibu</option>
								<option>Kakak</option>
								<option>Saudara</option>
								<option>Wali</option>
							</select>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Pekerjaan</label>
							<input id="regular-form-1" name="pekerjaan" type="text" class="form-control" placeholder="Nama Lengkap Siswa" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Alamat</label>
							<textarea id="regular-form-1" rows="2" name="alamat" type="text" class="form-control" placeholder="Alamat Lengkap" required></textarea>
						</div>
					</div>
					<div class="preview">
						<label for="regular-form-1" class="form-label mt-3">Upload Foto</label>
						<div class="dropzone">
							<div class="fallback"> 
								<input name="foto" type="file" id="uploadFoto" onchange="previewFoto(this);" /></div>
								<div id="fotoPreview" class="mt-3">
									<img id="previewImage" src="" alt="" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="mt-3">
							<button type="submit" class="btn btn-rounded btn-primary-soft w-24 mr-1 mb-2">Simpan</button>
							<a type="button" href="<?= base_url('admin/data-orangtua') ?>" class="btn btn-rounded btn-pending-soft w-24 mr-1 mb-2">Batal</a>
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