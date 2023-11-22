<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
	<?= $this->include('components/alert-login') ?>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
		<h2 class="text-lg font-medium truncate mr-5">
			<?= $title; ?>
		</h2> | &nbsp;&nbsp;
		<div class="md:block text-slate-500">
			<a href="<?= current_url() ?>" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
		</div>
	</div>
	<div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
		<table class="table table-report -mt-2">
			<thead>
				<tr>
					<th class="whitespace-nowrap">NO</th>
					<th class="whitespace-nowrap">FOTO</th>
					<th class="text-center whitespace-nowrap">NAMA</th>
					<th class="text-center whitespace-nowrap">PELANGGARAN</th>
					<th class="text-center whitespace-nowrap">KET PELANGGARAN</th>
					<th class="text-center whitespace-nowrap">PANGGILAN ORTU</th>
					<th class="text-center whitespace-nowrap">SP</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($pelanggaran)) : ?>
					<tr>
						<td colspan="7" class="text-center whitespace-nowrap">-- Belum ada data --</td>
					</tr>
				<?php else : ?>
					<?php $i = 1; ?>
					<?php foreach ($pelanggaran as $item) : ?>
						<tr class="intro-x">
							<td><?= $i++ ?></td>
							<td class="w-40">
								<div class="flex">
									<div class="w-10 h-10 image-fit zoom-in">
										<img src="<?= base_url('uploads/siswa/' . $siswa['foto']) ?>" data-action="zoom" class="tooltip rounded-full" alt="<?= $siswa['nama'] ?>" title="Uploaded at <?= $siswa['created_at'] ?>">
									</div>
								</div>
							</td>
							<td class="w-30">
								<div class="font-medium whitespace-nowrap">
									<?= $siswa['nama'] ?>
								</div>
								<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Kelas : <?= $kelasSiswa[$item['id_siswa']] ?? ''; ?></div>
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
											<div class="w-12 h-12 image-fit">
												<div class="w-10 h-10 image-fit zoom-in">
													<img src="<?= base_url('uploads/siswa/' . $siswa['foto']) ?>" class="tooltip rounded-full" alt="<?= $siswa['nama'] ?>" title="Uploaded at <?= $siswa['created_at'] ?>">
												</div>
											</div>
											<div class="ml-4 mr-auto">
												<div class="font-medium dark:text-slate-200 leading-relaxed"><?= $siswa['nama'] ?></div>
												<div class="text-slate-500 dark:text-slate-400"><?= $item['keterangan_pelanggaran'] ?></div>
											</div>
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

<?= $this->endSection() ?>