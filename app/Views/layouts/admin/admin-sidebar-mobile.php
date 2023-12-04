<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
	<div class="mobile-menu-bar">
		<a href="" class="flex mr-auto">
			<img alt="Logo" class="w-8" src="<?= base_url() ?>source/dist-css/images/smpn2sumber.png">
			<span class="xl:block text-white text-lg ml-3"> SMPN 2 Sumber </span> 
		</a>
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
	</div>
	<div class="scrollable">
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
		<ul>
			<li>
				<a href="<?= base_url('admin/dashboard') ?>" class="menu <?= ($active == 'dashboard') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="home"></i> </div>
					<div class="menu__title"> Home </div>
				</a>
			</li>
			<li class="nav__devider my-6"></li>
			<li>
				<a href="<?= base_url('admin/data-users') ?>" class="menu <?= ($active == 'users') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="unlock"></i> </div>
					<div class="menu__title"> Users </div>
				</a>
			</li>
			<li>
				<a href="javascript:;" class="menu <?= ($active == 'kelas' || $active == 'anggota') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="inbox"></i> </div>
					<div class="menu__title">
						Kelas
						<div class="menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
					</div>
				</a>
				<ul class="<?= ($active == 'kelas' || $active == 'anggota') ? 'menu__sub-open' : '' ?>">
					<li>
						<a href="<?= base_url('admin/data-kelas') ?>" class="menu <?= ($active == 'kelas') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Set Kelas </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-anggota-kelas') ?>" class="menu <?= ($active == 'anggota') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Anggota Kelas </div>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="javascript:;" class="menu <?= ($active == 'siswa' || $active == 'guru' || $active == 'orangtua') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="users"></i> </div>
					<div class="menu__title">
						Biodata
						<div class="menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
					</div>
				</a>
				<ul class="<?= ($active == 'siswa' || $active == 'guru' || $active == 'orangtua') ? 'menu__sub-open' : '' ?>">
					<li>
						<a href="<?= base_url('admin/data-guru') ?>" class="menu <?= ($active == 'guru') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> <i data-lucide="git-commit"></i> </div>
							<div class="menu__title"> Data Guru </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-siswa') ?>" class="menu <?= ($active == 'siswa') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Data Siswa </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-orangtua') ?>" class="menu <?= ($active == 'orangtua') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Data Orangtua </div>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav__devider my-6"></li>
			<li>
				<a href="<?= base_url('admin/prestasi-akademik') ?>" class="menu <?= ($active == 'prestasi') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="book"></i> </div>
					<div class="menu__title"> Prestasi </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/data-pelanggaran') ?>" class="menu <?= ($active == 'pelanggaran') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="user-x"></i> </div>
					<div class="menu__title"> Pelanggaran Siswa </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/rekap-monitoring') ?>" class="menu <?= ($active == 'rekap') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="monitor"></i> </div>
					<div class="menu__title"> Rekap Monitoring </div>
				</a>
			</li>
			<li class="nav__devider my-6"></li>
			<li>
				<a href="<?= base_url('logout') ?>" class="menu">
					<div class="menu__icon"> <i data-lucide="log-out"></i> </div>
					<div class="menu__title"> Logout </div>
				</a>
			</li>
		</ul>
	</div>
</div>
	<!-- END: Mobile Menu -->