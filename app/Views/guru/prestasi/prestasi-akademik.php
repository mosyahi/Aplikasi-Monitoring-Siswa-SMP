<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
	<?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center h-10">
	<h2 class="text-lg font-medium truncate mr-5">
		Prestasi Siswa
	</h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
		<a type="button" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">Add Prestasi</a>
		<div class="dropdown">
			<a type="button" class="btn px-2 box" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
				<span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
			</a>
		</div>
		<div class="hidden md:block mx-auto text-slate-500">
			<a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
		</div>
		<div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
			<div class="w-56 relative text-slate-500">
				<input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
				<i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
			</div>
		</div>
	</div>
	<div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
		<table class="table table-report -mt-2">
			<thead>
				<tr>
					<th class="whitespace-nowrap">NO</th>
					<th class="whitespace-nowrap">FOTO</th>
					<th class="text-center whitespace-nowrap">NAMA</th>
					<th class="text-center whitespace-nowrap">KATEGORI</th>
					<th class="text-center whitespace-nowrap">PRESTASI</th>
					<th class="text-center whitespace-nowrap">KETERANGAN</th>
					<th class="text-center whitespace-nowrap">TANGGAL</th>
					<th class="text-center whitespace-nowrap">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($prestasi)) : ?>
					<tr>
						<td colspan="8" class="text-center whitespace-nowrap">-- Belum ada data --</td>
					</tr>
				<?php else : ?>
					<?php $i =1; ?>
					<?php foreach ($prestasi as $item) : ?>
						<tr class="intro-x">
							<td><?= $i++ ?></td>
							<td class="w-40">
								<div class="flex">
									<div class="w-10 h-10 image-fit zoom-in">
										<img src="<?= base_url('uploads/prestasi-akademik/' . $item['foto']) ?>" data-action="zoom" class="tooltip rounded-full" alt="<?= $item['nama_prestasi'] ?>" title="Uploaded at <?= $item['created_at'] ?>">
									</div>
								</div>
							</td>
							<td class="w-30">
								<?php foreach ($siswa as $s): ?>
									<?php if ($s['id_siswa'] == $item['id_siswa']) : ?>
										<div class="font-medium whitespace-nowrap">
											<?= $s['nama'] ?>
										</div>
										<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Kelas : <strong><?= $kelasSiswa[$item['id_siswa']] ?? ''; ?></strong></div>
									<?php endif; ?>
								<?php endforeach ?>
							</td>
							<td>
								<div class="flex items-center justify-center">
									<?= $item['kategori_prestasi'] ?>
								</div>
							</td>
							<td>
								<div class="flex items-center justify-center">
									<?= $item['nama_prestasi'] ?>
								</div>
							</td>
							<td>
								<div class="flex justify-center items-center">
									<a href="javascript:;" data-theme="light" data-tooltip-content="#custom-content-tooltip" data-trigger="click" class="tooltip btn btn-primary-soft w-12 mr-1 btn-sm btn-rounded"><i class="fas fa-eye"></i></a>
									<div class="tooltip-content">
										<div id="custom-content-tooltip" class="relative flex items-center py-1">
											<?php foreach ($siswa as $s): ?>
												<?php if ($s['id_siswa'] == $item['id_siswa']) : ?>
													<div class="w-12 h-12 image-fit"> 
														<div class="w-10 h-10 image-fit zoom-in">
															<img src="<?= base_url('uploads/siswa/' . $s['foto']) ?>" class="tooltip rounded-full" alt="<?= $s['nama'] ?>" title="Uploaded at <?= $s['created_at'] ?>"> 
														</div>
													</div>
													<div class="ml-4 mr-auto">
														<div class="font-medium dark:text-slate-200 leading-relaxed"><?= $s['nama'] ?></div>
														<div class="text-slate-500 dark:text-slate-400"><?= $item['keterangan_prestasi'] ?></div>
													</div>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</div>
								</div>
							</td>
							<td class="table-report__action">
								<div class="flex justify-center items-center">
									<div class="font-medium whitespace-nowrap">
										<?= $item['tgl_prestasi'] ?>
									</div>
								</div>
							</td>
							<td class="table-report__action w-56">
								<div class="flex justify-center items-center">
									<button class="flex items-center mr-3" data-tw-toggle="modal" data-tw-target="#update-<?= $item['id_prestasi'] ?>"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </button>
									<button class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_prestasi'] ?>" data-delete-url="<?= base_url('admin/prestasi-akademik/delete/' . $item['id_prestasi']) ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </button>
								</div>
							</td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
		<nav class="w-full sm:w-auto sm:mr-auto">
			<ul class="pagination">
				<!-- Baca Dari Class Pagination -->
			</ul>
		</nav>
		<select class="w-20 form-select box mt-3 sm:mt-0" id="items-per-page">
			<option value="1">Set</option>
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="15">15</option>
			<option value="20">20</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="75">75</option>
			<option value="100">100</option>
		</select>
	</div>
</div>

<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="font-medium text-base mr-auto">Add Prestasi Akademik</h2> 
			</div>
			<form action="<?= base_url('admin/prestasi-akademik/add') ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Siswa</label> 
						<select data-placeholder="Pilih Siswa" name="id_siswa" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Siswa --</option>
							<?php foreach ($siswa as $s): ?>
								<option value="<?= $s['id_siswa'] ?>">
									<?= $s['nis'] ?> - <?= $s['nama'] ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>  
					<div class="col-span-12 sm:col-span-12"> 
						<label for="modal-form-1" class="form-label">Kategori Prestasi</label> 
						<select data-placeholder="Pilih Kategori" name="kategori_prestasi" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Kategori Prestasi --</option>
							<option>Akademik</option>
							<option>Non-Akademik</option>
						</select>
					</div>
					<div class="col-span-12 sm:col-span-12"> 
						<label for="modal-form-1" class="form-label">Nama Prestasi</label> 
						<input id="regular-form-1" name="nama_prestasi" type="text" class="form-control" placeholder="Nama perolehan prestasi siswa" required>
					</div>
					<div class="col-span-12 sm:col-span-12"> 
						<label for="regular-form-1" class="form-label">Tanggal Prestasi</label>
						<input type="text" name="tgl_prestasi" class="datepicker form-control block mx-auto" data-single-mode="true" required>
					</div>
					<div class="col-span-12 sm:col-span-12"> 
						<label for="modal-form-1" class="form-label">Keterangan</label> 
						<textarea rows="3" id="regular-form-1" name="keterangan_prestasi" type="text" class="form-control" placeholder="Catatan Point Keaktifan" required></textarea>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="regular-form-1" class="form-label mt-3">Dokumentasi Prestasi</label>
						<div class="dropzone">
							<div class="fallback"> 
								<input name="foto" type="file" id="uploadFoto" onchange="previewFoto(this);" /></div>
								<div id="fotoPreview" class="mt-3">
									<img id="previewImage" src="" alt="" style="max-width: 250px;">
								</div>
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
	<!-- END -->

	<!-- MODAL EDIT -->
	<?php foreach ($prestasi as $key => $value): ?>
		<div id="update-<?= $value['id_prestasi'] ?>" class="modal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="font-medium text-base mr-auto">Edit Prestasi Akademik</h2> 
					</div>
					<form action="<?= base_url('admin/prestasi-akademik/update/' . $value['id_prestasi']) ?>" method="POST" enctype="multipart/form-data">
						<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
							<div class="col-span-12 sm:col-span-12">
								<label for="modal-form-1" class="form-label">Siswa</label> 
								<select data-placeholder="Pilih Siswa" name="id_siswa" class="tom-select w-full" required>
									<?php foreach ($siswa as $s): ?>
										<option value="<?= $s['id_siswa'] ?>" <?= ($s['id_siswa'] == $value['id_siswa']) ? 'selected' : ''; ?>>
											<?= $s['nis'] ?> - <?= $s['nama'] ?>
										</option>
									<?php endforeach ?>
								</select>
							</div> 
							<div class="col-span-12 sm:col-span-12"> 
								<label for="modal-form-1" class="form-label">Kategori Prestasi</label> 
								<select data-placeholder="Pilih Kategori" name="kategori_prestasi" class="tom-select w-full" required>
									<option disabled>-- Pilih Kategori Prestasi --</option>
									<option <?= ($value['kategori_prestasi'] == 'Akademik') ? 'selected' : '' ?>>Akademik</option>
									<option <?= ($value['kategori_prestasi'] == 'Non-Akademik') ? 'selected' : '' ?>>Non-Akademik</option>
								</select>
							</div> 
							<div class="col-span-12 sm:col-span-12"> 
								<label for="modal-form-1" class="form-label">Nama Prestasi</label> 
								<input id="regular-form-1" name="nama_prestasi" type="text" class="form-control" placeholder="Nama perolehan prestasi siswa" value="<?= $value['nama_prestasi'] ?>" required>
							</div>
							<div class="col-span-12 sm:col-span-12"> 
								<label for="regular-form-1" class="form-label">Tanggal Prestasi</label>
								<input type="text" name="tgl_prestasi" class="datepicker form-control block mx-auto" value="<?= $value['tgl_prestasi'] ?>" data-single-mode="true" required>
							</div>
							<div class="col-span-12 sm:col-span-12"> 
								<label for="modal-form-1" class="form-label">Keterangan</label> 
								<textarea rows="3" id="regular-form-1" name="keterangan_prestasi" type="text" class="form-control" placeholder="Catatan Point Keaktifan" required><?= $value['keterangan_prestasi'] ?></textarea>
							</div>
							<div class="col-span-12 sm:col-span-12">
								<label for="regular-form-1" class="form-label mt-3">Dokumentasi Prestasi</label>
								<div class="dropzone">
									<div class="fallback"> 
										<input name="foto" type="file" id="uploadFoto" onchange="previewFotoPrestasi(this);" /></div>
										<div id="fotoPreviewPrestasi" class="mt-3">
											<img id="previewImagePrestasi" src="<?= base_url('uploads/prestasi-akademik/' . $value['foto']) ?>" alt="Foto Prestasi" style="max-width: 250px;">
										</div>
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

			<!-- MODAL HAPUS -->
			<div id="delete-<?= $value['id_prestasi'] ?>" class="modal" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
						<div class="modal-body p-0">
							<div class="p-5 text-center"> 
								<i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
								<div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
								<div class="text-slate-500 mt-2">Apakah anda yakin ingin menghapus data ini? </div>
							</div>
							<div class="px-5 pb-8 text-center"> 
								<a type="button" href="<?= base_url('admin/prestasi-akademik/delete/' . $item['id_prestasi']) ?>" type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Hapus</a> 
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
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
			function previewFotoPrestasi(input) {
				var fotoPreviewPrestasi = document.getElementById('fotoPreviewPrestasi');
				var previewImagePrestasi = document.getElementById('previewImagePrestasi');

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function(e) {
						previewImagePrestasi.src = e.target.result;
						fotoPreviewPrestasi.style.display = 'block';
					};

					reader.readAsDataURL(input.files[0]);
				} else {
					fotoPreviewPrestasi.style.display = 'none';
				}
			}
		</script> 

		<?= $this->endSection() ?>
