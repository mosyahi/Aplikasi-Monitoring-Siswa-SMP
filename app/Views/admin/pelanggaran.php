<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
	<?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center h-10">
	<h2 class="text-lg font-medium truncate mr-5">
		Pelanggaran Siswa
	</h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
		<a type="button" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">Add Pelanggaran</a>
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
					<th class="text-center whitespace-nowrap">PEMBUAT</th>
					<th class="text-center whitespace-nowrap">NAMA</th>
					<th class="text-center whitespace-nowrap">PELANGGARAN</th>
					<th class="text-center whitespace-nowrap">KET PELANGGARAN</th>
					<th class="text-center whitespace-nowrap">PANGGILAN ORTU</th>
					<th class="text-center whitespace-nowrap">SP</th>
					<th class="text-center whitespace-nowrap">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($pelanggaran)) : ?>
					<tr>
						<td colspan="8" class="text-center whitespace-nowrap">-- Belum ada data --</td>
					</tr>
				<?php else : ?>
					<?php $i = 1; ?>
					<?php
					usort($pelanggaran, function($a, $b) {
						return $a['id_siswa'] - $b['id_siswa'];
					});
					?>
					<?php foreach ($pelanggaran as $item) : ?>
						<tr class="intro-x">
							<td><?= $i++ ?></td>
							<td class="w-30">
								<?php foreach ($user as $us): ?>
									<?php if ($us['id_user'] == $item['created_by_user_id']): ?>
										<div class="flex items-center justify-center font-medium whitespace-nowrap">
											<?= $us['nama'] ?>
										</div>
										<div class="flex items-center justify-center text-slate-500 text-xs whitespace-nowrap mt-0.5">Role : <strong>&nbsp; <?= $us['role'] ?></strong></div>
									<?php endif; ?>
								<?php endforeach ?>
							</td>
							<td class="w-30">
								<?php foreach ($siswa as $s) : ?>
									<?php if ($s['id_siswa'] == $item['id_siswa']) : ?>
										<div class="flex justify-center items-center font-medium whitespace-nowrap">
											<?= $s['nama'] ?>
										</div>
										<div class="flex justify-center items-center text-slate-500 text-xs whitespace-nowrap mt-0.5">Kelas : <?= $kelasSiswa[$item['id_siswa']] ?? ''; ?></div>
									<?php endif; ?>
								<?php endforeach ?>
							</td>
							<td>
								<div class="flex justify-center items-center">
									<div class="font-medium whitespace-nowrap">
										<?= $item['jenis_pelanggaran'] ?>
									</div>
								</div>
							</td>
							<td>
								<div class="flex justify-center items-center">
									<a href="javascript:;" data-theme="light" data-tooltip-content="#custom-content-tooltip" data-trigger="click" class="tooltip btn btn-primary-soft w-12 mr-1 btn-sm btn-rounded"><i class="fas fa-eye"></i></a>
									<div class="tooltip-content">
										<div id="custom-content-tooltip" class="relative flex items-center py-1">
											<?php foreach ($siswa as $s) : ?>
												<?php if ($s['id_siswa'] == $item['id_siswa']) : ?>
													<div class="w-12 h-12 image-fit">
														<div class="w-10 h-10 image-fit zoom-in">
															<img src="<?= base_url('uploads/siswa/' . $s['foto']) ?>" class="tooltip rounded-full" alt="<?= $s['nama'] ?>" title="Uploaded at <?= $s['created_at'] ?>">
														</div>
													</div>
													<div class="ml-4 mr-auto">
														<div class="font-medium dark:text-slate-200 leading-relaxed"><?= $s['nama'] ?></div>
														<div class="text-slate-500 dark:text-slate-400"><?= $item['keterangan_pelanggaran'] ?></div>
													</div>
												<?php endif ?>
											<?php endforeach ?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="flex justify-center items-center <?php echo $item['panggilan_ortu'] === 'Ya' ? 'text-success' : 'text-danger'; ?>">
									<i data-lucide="<?php echo $item['panggilan_ortu'] === 'Ya' ? 'check-square' : 'x'; ?>" class="w-4 h-4 mr-2"></i>
									<strong><?= $item['panggilan_ortu'] ?></strong>
								</div>
							</td>
							<td class="w-30">
								<div class="flex justify-center items-center">
									<?php if ($item['surat_peringatan'] !== null) : ?>
										<a class="btn btn-sm btn-primary-soft w-24 mr-1 mb-2" href="<?= base_url('uploads/sp/' . $item['surat_peringatan']) ?>" download>

											<i data-lucide="file-text" class="w-4 h-4 mr-2 text-primary"></i>Download
										</a>
									<?php else : ?>
										<i data-lucide="x-square" class="w-4 h-4 mr-2 text-danger"></i>No File
									<?php endif; ?>
								</div>
								<div class="flex justify-center items-center text-slate-500 text-xs whitespace-nowrap mt-0.5">
									<?php
									$jenisSp = $item['jenis_sp'];
									switch ($jenisSp) {
										case 'Tidak ada SP':
										echo '<strong>' . $jenisSp . '</strong>';
										break;
										case 'SP 1':
										echo '<strong class="text-primary">' . $jenisSp . '</strong>';
										break;
										case 'SP 2':
										echo '<strong class="text-warning">' . $jenisSp . '</strong>';
										break;
										case 'SP 3':
										echo '<strong class="text-danger">' . $jenisSp . '</strong>';
										break;
										default:
										echo '<strong>' . $jenisSp . '</strong>';
									}
									?>
								</div>
							</td>
							<td class="table-report__action w-56">
								<div class="flex justify-center items-center dropdown">
									<a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="settings" class="w-5 text-slate-500"></i> </a>
									<div class="dropdown-menu w-40">
										<div class="dropdown-content">
											<a type="button" href="<?= base_url('admin/data-pelanggaran/cetak/' . $item['id_pelanggaran']) ?>" class="flex items-center dropdown-item"> <i data-lucide="sunset" class="w-4 h-4 mr-1"></i> Unduh </a>
											<a type="button" href="javascript:;" class="flex items-center dropdown-item text-primary" data-tw-toggle="modal" data-tw-target="#update-<?= $item['id_pelanggaran'] ?>"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
											<a type="button" class="flex items-center dropdown-item text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_pelanggaran'] ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
										</div>
									</div>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="font-medium text-base mr-auto">Add Pelanggaran</h2>
			</div>
			<form action="<?= base_url('admin/data-pelanggaran/add') ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
					<input type="hidden" name="created_by_user_id" value="<?= session()->get('id_user') ?>">
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Siswa</label>
						<select data-placeholder="Pilih Siswa" name="id_siswa" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Siswa --</option>
							<?php foreach ($siswa as $s) : ?>
								<option value="<?= $s['id_siswa'] ?>" <?= (old('id_siswa') == ($s['id_siswa'])) ? 'selected' : '' ?>>
									<?= $kelasSiswa[$s['id_siswa']] ?? ''; ?> - <?= $s['nama'] ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Jenis Pelanggaran</label>
						<select data-placeholder="Pilih Jenis" name="jenis_pelanggaran" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Jenis Pelanggaran --</option>
							<option <?= (old('jenis_pelanggaran') == 'Kecil') ? 'selected' : '' ?>>Kecil</option>
							<option <?= (old('jenis_pelanggaran') == 'Sedang') ? 'selected' : '' ?>>Sedang</option>
							<option <?= (old('jenis_pelanggaran') == 'Berat') ? 'selected' : '' ?>>Berat</option>
						</select>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Jenis SP</label>
						<select data-placeholder="Pilih Jenis" name="jenis_sp" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Jenis SP --</option>
							<option <?= (old('jenis_sp') == 'Tidak ada SP') ? 'selected' : '' ?>>Tidak ada SP</option>
							<option <?= (old('jenis_sp') == 'SP 1') ? 'selected' : '' ?>>SP 1</option>
							<option <?= (old('jenis_sp') == 'SP 2') ? 'selected' : '' ?>>SP 2</option>
							<option <?= (old('jenis_sp') == 'SP 3') ? 'selected' : '' ?>>SP 3</option>
						</select>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Panggilan Orangtua</label>
						<select data-placeholder="Pilih Panggilan" name="panggilan_ortu" class="tom-select w-full" required>
							<option selected disabled>-- Pilih Jenis Panggilan --</option>
							<option <?= (old('panggilan_ortu') == 'Ya') ? 'selected' : '' ?>>Ya</option>
							<option <?= (old('panggilan_ortu') == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
						</select>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="modal-form-1" class="form-label">Keterangan Pelanggaran</label>
						<textarea rows="3" id="regular-form-1" name="keterangan_pelanggaran" type="text" class="form-control" placeholder="Isi keterangan pelanggaran disini..." required><?= old('keterangan_pelanggaran') ?></textarea>
					</div>
					<div class="col-span-12 sm:col-span-12">
						<label for="regular-form-1" class="form-label">Dokumentasi Prestasi</label>
						<div>
							<div class="fallback">
								<input name="surat_peringatan" type="file" id="uploadFoto" />
							</div>
							<div class="form-help text-danger">
								*Kosongkan jika tidak ada
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
<?php foreach ($pelanggaran as $key => $item) : ?>
	<div id="update-<?= $item['id_pelanggaran'] ?>" class="modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="font-medium text-base mr-auto">Edit Pelanggaran</h2>
				</div>
				<form action="<?= base_url('admin/data-pelanggaran/update/' . $item['id_pelanggaran']) ?>" method="POST" enctype="multipart/form-data">
					<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
						<input type="hidden" name="created_by_user_id" value="<?= $item['created_by_user_id'] ?>">
						<div class="col-span-12 sm:col-span-12">
							<label for="modal-form-1" class="form-label">Siswa</label>
							<select data-placeholder="Pilih Siswa" name="id_siswa" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Siswa --</option>
								<?php foreach ($siswa as $value) : ?>
									<option value="<?= $value['id_siswa'] ?>" <?= ($item['id_siswa'] == $value['id_siswa']) ? 'selected' : '' ?>><?= $kelasSiswa[$item['id_siswa']] ?? ''; ?> - <?= $value['nama'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-span-12 sm:col-span-12">
							<label for="modal-form-1" class="form-label">Jenis Pelanggaran</label>
							<select data-placeholder="Pilih Jenis" name="jenis_pelanggaran" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Jenis Pelanggaran --</option>
								<option value="Kecil" <?= ($item['jenis_pelanggaran'] == 'Kecil') ? 'selected' : '' ?>>Kecil</option>
								<option value="Sedang" <?= ($item['jenis_pelanggaran'] == 'Sedang') ? 'selected' : '' ?>>Sedang</option>
								<option value="Berat" <?= ($item['jenis_pelanggaran'] == 'Berat') ? 'selected' : '' ?>>Berat</option>
							</select>
						</div>
						<div class="col-span-12 sm:col-span-12">
							<label for="modal-form-1" class="form-label">Jenis SP</label>
							<select data-placeholder="Pilih Jenis" name="jenis_sp" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Jenis SP --</option>
								<option value="Tidak ada SP" <?= ($item['jenis_sp'] == 'Tidak ada SP') ? 'selected' : '' ?>>Tidak ada SP</option>
								<option value="SP 1" <?= ($item['jenis_sp'] == 'SP 1') ? 'selected' : '' ?>>SP 1</option>
								<option value="SP 2" <?= ($item['jenis_sp'] == 'SP 2') ? 'selected' : '' ?>>SP 2</option>
								<option value="SP 3" <?= ($item['jenis_sp'] == 'SP 3') ? 'selected' : '' ?>>SP 3</option>
							</select>
						</div>
						<div class="col-span-12 sm:col-span-12">
							<label for="modal-form-1" class="form-label">Panggilan Orangtua</label>
							<select data-placeholder="Pilih Panggilan" name="panggilan_ortu" class="tom-select w-full" required>
								<option selected disabled>-- Pilih Jenis Panggilan --</option>
								<option value="Ya" <?= ($item['panggilan_ortu'] == 'Ya') ? 'selected' : '' ?>>Ya</option>
								<option value="Tidak" <?= ($item['panggilan_ortu'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
							</select>
						</div>
						<div class="col-span-12 sm:col-span-12">
							<label for="modal-form-1" class="form-label">Keterangan Pelanggaran</label>
							<textarea rows="3" id="regular-form-1" name="keterangan_pelanggaran" type="text" class="form-control" placeholder="Isi keterangan pelanggaran disini..." required><?= $item['keterangan_pelanggaran'] ?></textarea>
						</div>
						<div class="col-span-12 sm:col-span-12">
							<label for="regular-form-1" class="form-label">Dokumentasi Prestasi</label>
							<div>
								<div class="fallback">
									<input name="surat_peringatan" type="file" id="uploadFoto" />
								</div>
								<div class="form-help text-danger">
									*Kosongkan jika tidak ada
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
	<!-- MODAL DELETE -->
	<div id="delete-<?= $item['id_pelanggaran'] ?>" class="modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
				<div class="modal-body p-0">
					<div class="p-5 text-center">
						<i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
						<div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
						<div class="text-slate-500 mt-2">Apakah anda yakin ingin menghapus data ini? </div>
					</div>
					<div class="px-5 pb-8 text-center">
						<a type="button" href="<?= base_url('admin/data-pelanggaran/delete/' . $item['id_pelanggaran']) ?>" type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Hapus</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?php $this->endSection() ?>