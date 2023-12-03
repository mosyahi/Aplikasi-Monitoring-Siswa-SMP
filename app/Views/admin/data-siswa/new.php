<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
	<?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center mt-4">
	<h2 class="text-lg font-medium mr-auto">
		Form Tambah Data Siswa
	</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 lg:col-span-12">
		<!-- BEGIN: Input -->
		<div class="intro-y box">
			<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
				<h2 class="font-medium text-base mr-auto">
					Input Data Siswa
				</h2>
			</div>
			<form action="<?= site_url('admin/data-siswa/add') ?>" method="POST" enctype="multipart/form-data">
				<div id="input" class="p-5">
					<div class="preview">
						<div>
							<label for="regular-form-1" class="form-label">Nama</label>
							<input id="regular-form-1" name="nama" type="text" class="form-control" placeholder="Nama Lengkap Siswa" value="<?= old('nama') ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Email</label>
							<input id="regular-form-1" name="email" type="email" class="form-control" placeholder="Email Aktif" value="<?= old('email') ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">No Hp Siswa</label>
							<input id="regular-form-1" name="no_hp" type="number" class="form-control" placeholder="Cth: 6289887xxxxxx" value="<?= old('no_hp') ?>" required>
							<div class="form-help text-danger">
								*Nomor Whatsapp Aktif!
							</div>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">No Hp Orangtua/Wali</label>
							<input id="regular-form-1" name="no_hp_orangtua" type="number" class="form-control" placeholder="Cth: 6289887xxxxxx" value="<?= old('no_hp_orangtua') ?>" required>
							<div class="form-help text-danger">
								*Nomor Whatsapp Aktif!
							</div>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Nis</label>
							<input id="regular-form-1" name="nis" type="number" class="form-control" placeholder="Nomor Induk Siswa" minlength="10" value="<?= old('nis') ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Kelas</label>
							<select data-placeholder="Pilih Kelas" name="id_kelas" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Kelas --</option>
								<?php foreach ($kelas as $item) : ?>
									<option value="<?= $item['id_kelas'] ?>">
										<?= $item['tingkat'] ?> <?= $item['tipe_kelas'] ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Jenis Kelamin</label>
							<select data-placeholder="Pilih JK" name="jk" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Jenis Kelamin --</option>
								<option value="L">Laki - Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Tanggal Lahir</label>
							<input type="text" name="tgl_lahir" class="datepicker form-control block mx-auto" data-single-mode="true" value="<?= old('tgl_lahir') ?>" required>
						</div>
					</div>
					<div class="preview">
						<div class="mt-3">
							<label for="regular-form-1" class="form-label">Alamat</label>
							<textarea id="regular-form-1" rows="2" name="alamat" type="text" class="form-control" placeholder="Isi alamat lengkap disini..." minlength="10" required><?= old('alamat') ?></textarea>
						</div>
					</div>
					<div class="preview">
						<label for="regular-form-1" class="form-label mt-3">Upload Foto</label>
						<div>
							<div class="fallback"> 
								<input name="foto" type="file" id="uploadFoto" onchange="previewFoto(this);" /></div>
								<div id="fotoPreview" class="mt-3">
									<img id="previewImage" src="" alt="" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="mt-3">
							<button type="submit" class="btn btn-rounded btn-primary-soft w-24 mr-1 mb-2">Simpan</button>
							<a type="button" href="<?= base_url('admin/data-siswa') ?>" class="btn btn-rounded btn-pending-soft w-24 mr-1 mb-2">Batal</a>
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