<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
	<?= $this->include('components/alert-login') ?>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
		<div class="intro-y flex items-center h-10">
			<h2 class="text-lg font-medium truncate mr-5">
				Rekap Monitoring Siswa
			</h2>
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
					<th class="text-center whitespace-nowrap">NIS</th>
					<th class="text-center whitespace-nowrap">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($siswa)) : ?>
					<tr>
						<td colspan="5" class="text-center whitespace-nowrap">-- Belum ada data --</td>
					</tr>
				<?php else : ?>
					<?php $i =1; ?>
					<?php foreach ($siswa as $item) : ?>
						<tr class="intro-x">
							<td><?= $i++ ?></td>
							<td class="w-40">
								<div class="flex">
									<div class="w-10 h-10 image-fit zoom-in">
										<img src="<?= base_url('uploads/siswa/' . $item['foto']) ?>" data-action="zoom" class="tooltip rounded-full" alt="<?= $item['nama'] ?>" title="Uploaded at 28 May 2020">
									</div>
								</div>
							</td>
							<td class="w-30">
								<div class="flex items-center justify-center font-medium whitespace-nowrap">
									<?= $item['nama'] ?>
								</div>
								<div class="flex items-center justify-center text-slate-500 text-xs whitespace-nowrap mt-0.5">Kelas : <?= $kelasSiswa[$item['id_siswa']] ?? ''; ?></div>
							</td>
							<td>
								<div class="flex items-center justify-center">
									<strong><?= $item['nis'] ?></strong>
								</div>
							</td>
							<td class="table-report__action w-56">
								<div class="flex justify-center items-center text-primary">
									<button class="flex items-center mr-3" href="javascript:;" data-tw-toggle="modal" data-tw-target="#view-<?= $item['id_siswa'] ?>"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> View </button>
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

<?php foreach ($siswa as $row): ?>
	<div id="view-<?= $row['id_siswa'] ?>" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header p-5">
					<h2 class="font-medium text-base mr-auto">Data Rekap <?= $row['nama'] ?></h2>
					<a type="button" href="<?= base_url('admin/rekap-monitoring/cetak/' . $row['id_siswa']) ?>" class="btn btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Rekap </a>
				</div>
				<div class="modal-body">
					<div id="faq-accordion-2" class="accordion accordion-boxed">
						<div class="accordion-item">
							<div id="faq-accordion-content-5" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-5" aria-expanded="true" aria-controls="faq-accordion-collapse-5"> Rekap Biodata </button> </div>
							<div id="faq-accordion-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-5" data-tw-parent="#faq-accordion-2">
								<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
									<div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
										<table class="table table-bordered table-hover mt-2">
											<tbody>
												<tr class="intro-x">
													<th class="text-center" colspan="2">Siswa</th>
												</tr>
												<tr class="intro-x">
													<th>Nama</th>
													<td><?= $row['nama'] ?></td>
												</tr>	
												<tr class="intro-x">
													<th>Email</th>
													<td><?= $row['email'] ?></td>
												</tr>
												<tr class="intro-x">
													<th>No HP</th>
													<td><?= $row['no_hp'] ?></td>
												</tr>
												<tr class="intro-x">
													<th>No HP Orangtua</th>
													<td><?= $row['no_hp_orangtua'] ?></td>
												</tr>
												<tr class="intro-x">
													<th>Nis</th>
													<td><?= $row['nis'] ?></td>
												</tr>
												<tr class="intro-x">
													<th>Kelas</th>
													<td>
														<?= $kelasSiswa[$row['id_siswa']] ?? ''; ?>
													</td>
												</tr>
												<tr class="intro-x">
													<th>Tgl Lahir</th>
													<td><?= $row['tgl_lahir'] ?></td>
												</tr>
												<tr class="intro-x">
													<th>Alamat</th>
													<td><?= $row['alamat'] ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<div id="faq-accordion-content-9" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-9" aria-expanded="false" aria-controls="faq-accordion-collapse-9"> Rekap Prestasi Akademik</button> </div>
							<div id="faq-accordion-collapse-9" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-9" data-tw-parent="#faq-accordion-2">
								<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
									<div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
										<table class="table table-bordered table-hover mt-2">
											<thead>
												<tr>
													<th class="text-center whitespace-nowrap">NO</th>
													<th class="text-center whitespace-nowrap">PRESTASI</th>
													<th class="text-center whitespace-nowrap">KETERANGAN</th>
												</tr>
											</thead>
											<tbody>
												<?php if (empty($prestasiAkademik[$row['id_siswa']])) : ?>
													<tr>
														<td colspan="3" class="text-center whitespace-nowrap">-- Belum ada data --</td>
													</tr>
												<?php else : ?>
													<?php $i = 1; ?>
													<?php foreach ($prestasiAkademik[$row['id_siswa']] as $akademik) : ?>
														<tr class="intro-x">
															<td>
																<div class="flex items-center justify-center">
																	<?= $i++ ?>
																</div>
															</td>
															<td>
																<div class="flex items-center justify-center">
																	<?= $akademik['nama_prestasi'] ?>
																</div>
															</td>
															<td>
																<div class="flex justify-center items-center">
																	<div class="dropdown inline-block" data-tw-placement="bottom">
																		<button class="dropdown-toggle btn btn-primary-soft btn-sm btn-rounded w-12 mr-1 mb-2"
																		aria-expanded="false" data-tw-toggle="dropdown"><i class="fas fa-eye"></i></button>
																		<div class="dropdown-menu w-40">
																			<div class="dropdown-content">
																				<?= $akademik['keterangan_prestasi'] ?>
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
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<div id="faq-accordion-content-10" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-10" aria-expanded="false" aria-controls="faq-accordion-collapse-10"> Rekap Pelanggaran </button> </div>
							<div spark v id="faq-accordion-collapse-10" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-10" data-tw-parent="#faq-accordion-2">
								<div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
									<div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
										<table class="table table-bordered table-hover mt-2">
											<thead>
												<tr>
													<th class="whitespace-nowrap">NO</th>
													<th class="text-center whitespace-nowrap">PELANGGARAN</th>
													<th class="text-center whitespace-nowrap">KET PELANGGARAN</th>
													<th class="text-center whitespace-nowrap">PANGGILAN ORTU</th>
													<th class="text-center whitespace-nowrap">SP</th>
													<th class="text-center whitespace-nowrap">SURAT</th>
												</tr>
											</thead>
											<tbody>
												<?php if (empty($pelanggaranData[$row['id_siswa']])) : ?>
													<tr>
														<td colspan="6" class="text-center whitespace-nowrap">-- Belum ada data --</td>
													</tr>
												<?php else : ?>
													<?php $i =1; ?>
													<?php foreach ($pelanggaranData[$row['id_siswa']] as $pelanggaran) : ?>
														<tr class="intro-x">
															<td><?= $i++ ?></td>
															<td>
																<div class="flex justify-center items-center">
																	<?= $pelanggaran['jenis_pelanggaran'] ?>
																</div>
															</td>
															<td>
																<div class="flex justify-center items-center">
																	<div class="dropdown inline-block" data-tw-placement="bottom">
																		<button class="dropdown-toggle btn btn-primary-soft btn-sm btn-rounded w-12 mr-1 mb-2"
																		aria-expanded="false" data-tw-toggle="dropdown"><i class="fas fa-eye"></i></button>
																		<div class="dropdown-menu w-40">
																			<div class="dropdown-content">
																				<?= $pelanggaran['keterangan_pelanggaran'] ?>
																			</div>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class="flex justify-center items-center <?php echo $pelanggaran['panggilan_ortu'] === 'Ya' ? 'text-success' : 'text-danger'; ?>">
																	<i data-lucide="<?php echo $pelanggaran['panggilan_ortu'] === 'Ya' ? 'check-square' : 'x'; ?>" class="w-4 h-4 mr-2"></i>
																	<strong><?= $pelanggaran['panggilan_ortu'] ?></strong>
																</div>
															</td>
															<td class="w-30">
																<div class="flex justify-center items-center">
																	<?php if ($pelanggaran['surat_peringatan'] !== null): ?>
																		<a class="btn btn-sm btn-primary-soft w-24 mr-1 mb-2" href="<?= base_url('uploads/sp/' . $pelanggaran['surat_peringatan']) ?>" download>

																			<i data-lucide="file-text" class="w-4 h-4 mr-2 text-primary"></i>Download
																		</a>
																	<?php else: ?>
																		<i data-lucide="x-square" class="w-4 h-4 mr-2 text-danger"></i>No File
																	<?php endif; ?>
																</div>
															</td>
															<td>
																<div class="flex justify-center items-center">
																	<?php
																	$jenisSp = $pelanggaran['jenis_sp'];
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer"> 
					<button type="button" data-tw-dismiss="modal" class="btn btn-primary-soft w-20 mr-1">Tutup</button> 
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<?= $this->endSection() ?>