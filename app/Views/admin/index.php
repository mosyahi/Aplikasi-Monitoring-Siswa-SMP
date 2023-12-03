<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="grid grid-cols-12 gap-6">
	<div class="col-span-12 2xl:col-span-9">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 mt-8">
				<?= $this->include('components/alert-login') ?>

				<div class="intro-y flex items-center h-10">
					<h2 class="text-lg font-medium truncate mr-5">
						General Report
					</h2>
					<a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
				</div>

				<div class="intro-y box px-5 pt-5 mt-5">
					<div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
						<div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
							<div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
								<?php
								$fotoUrl = session()->get('foto_url');
								$fotoDefault = base_url('source/dist-css/images/profile.png');
								if (!empty($fotoUrl)) {
									echo '<img alt="Foto" data-action="zoom" class="rounded-full" src="' . $fotoUrl . '">';
								} else {
									echo '<img alt="Foto" data-action="zoom" class="rounded-full" src="' . $fotoDefault . '">';
								}
								?>
							</div>
							<div class="ml-5">
								<div class="truncate sm:whitespace-normal font-medium text-lg">Selamat Datang,<br><?= session()->get('nama') ?></div>
								<div class="text-slate-500"><?= session()->get('role') ?></div>
							</div>
						</div>
						<div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
							<div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
							<div class="flex flex-col justify-center items-center lg:items-start mt-4">
								<div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> <?= session()->get('email') ?> </div>
								<!-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Twitter Denzel Washington </div> -->
								<div class="truncate sm:whitespace-normal flex items-center mt-3 text-success"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Status &nbsp; <strong><?= session()->get('status') ?></strong> </div>
							</div>
						</div>
					</div>
				</div>

				<div class="grid grid-cols-12 gap-6 mt-5">
					<a href="<?= base_url('admin/data-users') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="unlock" class="report-box__icon text-primary"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-primary tooltip cursor-pointer" title="<?= count($user) ?> Data User"> <?= count($user) ?> <i class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($user) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Users</div>
							</div>
						</div>
					</a>
					<a href="<?= base_url('admin/data-siswa') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="users" class="report-box__icon text-pending"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-pending tooltip cursor-pointer" title="<?= count($siswa) ?> Data Siswa"> <?= count($siswa) ?> <i class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($siswa) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Siswa</div>
							</div>
						</div>
					</a>
					<a href="<?= base_url('admin/data-guru') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="user" class="report-box__icon text-success"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-success tooltip cursor-pointer" title="<?= count($guru) ?> data guru"> <?= count($guru) ?> <i data-lucide="" class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($guru) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Guru</div>
							</div>
						</div>
					</a>
					<a href="<?= base_url('admin/data-kelas') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="archive" class="report-box__icon text-warning"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-warning tooltip cursor-pointer" title="<?= count($kelas) ?> Data Kelas"> <?= count($kelas) ?> <i class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($kelas) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Kelas</div>
							</div>
						</div>
					</a>
					<a href="<?= base_url('admin/prestasi-akademik') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="archive" class="report-box__icon text-danger"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-danger tooltip cursor-pointer" title="<?= count($prestasi) ?> Data Prestasi"> <?= count($prestasi) ?> <i class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($prestasi) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Prestasi</div>
							</div>
						</div>
					</a>
					<a href="<?= base_url('admin/data-pelanggaran') ?>" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
						<div class="report-box zoom-in">
							<div class="box p-5">
								<div class="flex">
									<i data-lucide="archive" class="report-box__icon text-pending"></i>
									<div class="ml-auto">
										<div class="report-box__indicator bg-pending tooltip cursor-pointer" title="<?= count($pelanggaran) ?> Data Pelanggaran"> <?= count($pelanggaran) ?> <i class="w-4 h-4 ml-0.5"></i> </div>
									</div>
								</div>
								<div class="text-3xl font-medium leading-8 mt-6"><?= count($pelanggaran) ?></div>
								<div class="text-base text-slate-500 mt-1">Data Pelangaran</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>