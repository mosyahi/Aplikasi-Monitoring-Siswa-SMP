<div class="top-bar">
	<!-- BEGIN: Breadcrumb -->
	<nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- END: Breadcrumb -->
	<!-- BEGIN: Search -->
	<div class="intro-x relative mr-3 sm:mr-6">
		<div class="search hidden sm:block">
			<input type="text" class="search__input form-control border-transparent" placeholder="Search...">
			<i data-lucide="search" class="search__icon dark:text-slate-500"></i> 
		</div>
		<a class="notification sm:hidden" href=""> <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> </a>
		<div class="search-result">
			<div class="search-result__content">
				<div class="search-result__content__title">Pages</div>
				<div class="mb-5">
					<a href="<?= base_url('admin/data-users') ?>" class="flex items-center">
						<div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="inbox"></i> </div>
						<div class="ml-3">Data Users</div>
					</a>
					<a href="<?= base_url('admin/data-siswa') ?>" class="flex items-center mt-2">
						<div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="users"></i> </div>
						<div class="ml-3">Data Siswa</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="credit-card"></i> </div>
						<div class="ml-3">Transactions Report</div>
					</a>
				</div>
				<div class="search-result__content__title">Users</div>
				<div class="mb-5">
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 image-fit">
							<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/profile-7.jpg">
						</div>
						<div class="ml-3">Kevin Spacey</div>
						<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">kevinspacey@left4code.com</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 image-fit">
							<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/profile-2.jpg">
						</div>
						<div class="ml-3">Johnny Depp</div>
						<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 image-fit">
							<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/profile-5.jpg">
						</div>
						<div class="ml-3">Johnny Depp</div>
						<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
					</a>
					<a href="" class="flex items-center mt-2">
						<div class="w-8 h-8 image-fit">
							<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/profile-9.jpg">
						</div>
						<div class="ml-3">Morgan Freeman</div>
						<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">morganfreeman@left4code.com</div>
					</a>
				</div>
				<div class="search-result__content__title">Products</div>
				<a href="" class="flex items-center mt-2">
					<div class="w-8 h-8 image-fit">
						<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/preview-9.jpg">
					</div>
					<div class="ml-3">Oppo Find X2 Pro</div>
					<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Smartphone &amp; Tablet</div>
				</a>
				<a href="" class="flex items-center mt-2">
					<div class="w-8 h-8 image-fit">
						<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/preview-1.jpg">
					</div>
					<div class="ml-3">Nikon Z6</div>
					<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Photography</div>
				</a>
				<a href="" class="flex items-center mt-2">
					<div class="w-8 h-8 image-fit">
						<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/preview-2.jpg">
					</div>
					<div class="ml-3">Sony Master Series A9G</div>
					<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Electronic</div>
				</a>
				<a href="" class="flex items-center mt-2">
					<div class="w-8 h-8 image-fit">
						<img alt="Midone - HTML Admin Template" class="rounded-full" src="<?= base_url() ?>source/dist-css/images/preview-8.jpg">
					</div>
					<div class="ml-3">Dell XPS 13</div>
					<div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">PC &amp; Laptop</div>
				</a>
			</div>
		</div>
	</div>
	<!-- END: Search -->
	<!-- BEGIN: Account Menu -->
	<div class="intro-x dropdown w-8 h-8">
		<div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
			<?php
			$fotoUrl = session()->get('foto_url');
			$fotoDefault = base_url('source/dist-css/images/profile.png');
			if (!empty($fotoUrl)) {
				echo '<img alt="Foto" src="' . $fotoUrl . '">';
			} else {
				echo '<img alt="Foto" src="' . $fotoDefault . '">';
			}
			?>
		</div>
		<div class="dropdown-menu w-56">
			<ul class="dropdown-content bg-primary text-white">
				<li class="p-2">
					<div class="font-medium"><?= session()->get('nama') ?></div>
					<div class="text-xs text-white/70 mt-0.5 dark:text-slate-500"><?= session()->get('email') ?></div>
				</li>
				<li>
					<hr class="dropdown-divider border-white/[0.08]">
				</li>
				<li>
					<a href="<?= base_url('admin/profile') ?>" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
				</li>
				<li>
					<a href="#" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
				</li>
				<li>
					<hr class="dropdown-divider border-white/[0.08]">
				</li>
				<li>
					<a href="<?= base_url('logout') ?>" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
				</li>
			</ul>
		</div>
	</div>
	<!-- END: Account Menu -->
</div>