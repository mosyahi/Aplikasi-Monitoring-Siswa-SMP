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
					<th class="text-center whitespace-nowrap">KATEGORI</th>
					<th class="text-center whitespace-nowrap">PRESTASI</th>
					<th class="text-center whitespace-nowrap">TANGGAL</th>
					<th class="text-center whitespace-nowrap">KETERANGAN</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($prestasi)) : ?>
					<tr>
						<td colspan="7" class="text-center whitespace-nowrap">-- Belum ada data --</td>
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
								<div class="font-medium whitespace-nowrap">
									<?= $siswa['nama'] ?>
								</div>
								<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Kelas : <strong><?= $kelasSiswa[$siswa['id_siswa']] ?? ''; ?></strong></div>
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
									<div class="font-medium whitespace-nowrap">
										<?= $item['tgl_prestasi'] ?>
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
												<div class="text-slate-500 dark:text-slate-400"><?= $item['keterangan_prestasi'] ?></div>
											</div>
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

<?= $this->endSection() ?>