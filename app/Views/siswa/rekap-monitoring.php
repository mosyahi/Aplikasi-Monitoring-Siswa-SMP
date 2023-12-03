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
		<div id="faq-accordion-2" class="accordion accordion-boxed">
			<div class="accordion-item bg-white">
				<div id="faq-accordion-content-5" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-5" aria-expanded="true" aria-controls="faq-accordion-collapse-5"> Rekap Biodata <i data-lucide="chevron-down" style="float: right;"></i> </button> </div>
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
										<td><?= $siswa['nama'] ?></td>
									</tr>	
									<tr class="intro-x">
										<th>Email</th>
										<td><?= $siswa['email'] ?></td>
									</tr>
									<tr class="intro-x">
										<th>No HP</th>
										<td><?= $siswa['no_hp'] ?></td>
									</tr>
									<tr class="intro-x">
										<th>No HP Orangtua</th>
										<td><?= $siswa['no_hp_orangtua'] ?></td>
									</tr>
									<tr class="intro-x">
										<th>Nis</th>
										<td><?= $siswa['nis'] ?></td>
									</tr>
									<tr class="intro-x">
										<th>Kelas</th>
										<td>
											<?= $kelasSiswa[$siswa['id_siswa']] ?? ''; ?>
										</td>
									</tr>
									<tr class="intro-x">
										<th>Tgl Lahir</th>
										<td><?= $siswa['tgl_lahir'] ?></td>
									</tr>
									<tr class="intro-x">
										<th>Alamat</th>
										<td><?= $siswa['alamat'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="accordion-item bg-white">
				<div id="faq-accordion-content-9" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-9" aria-expanded="false" aria-controls="faq-accordion-collapse-9"> Rekap Prestasi Akademik <i data-lucide="chevron-down" style="float: right;"></i></button> </div>
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
									<?php if (empty($prestasiAkademik)) : ?>
										<tr>
											<td colspan="3" class="text-center whitespace-nowrap">-- Belum ada data --</td>
										</tr>
									<?php else : ?>
										<?php $i = 1; ?>
										<?php foreach ($prestasiAkademik as $akademik) : ?>
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
			<div class="accordion-item bg-white">
				<div id="faq-accordion-content-10" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-10" aria-expanded="false" aria-controls="faq-accordion-collapse-10"> Rekap Pelanggaran <i data-lucide="chevron-down" style="float: right;"></i></button> </div>
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
									<?php if (empty($pelanggaranData)) : ?>
										<tr>
											<td colspan="5" class="text-center whitespace-nowrap">-- Belum ada data --</td>
										</tr>
									<?php else : ?>
										<?php $i =1; ?>
										<?php foreach ($pelanggaranData as $pelanggaran) : ?>
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
</div>

<?= $this->endSection() ?>