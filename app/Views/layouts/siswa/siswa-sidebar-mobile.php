<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
	<div class="mobile-menu-bar">
		<a href="" class="flex mr-auto">
			<img alt="Logo" class="w-6" src="<?= base_url() ?>source/dist-css/images/smpn2sumber.png">
		</a>
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
	</div>
	<div class="scrollable">
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
		<ul>
		<li>
			<a href="<?= base_url('siswa/dashboard') ?>" class="menu <?= ($active == 'dashboard') ? 'menu--active' : '' ?>">
				<div class="menu__icon"> <i data-lucide="home"></i> </div>
				<div class="menu__title"> Home </div>
			</a>
		</li>
		<li class="nav__devider my-6"></li>
		<li>
			<a href="<?= base_url('siswa/prestasi-akademik') ?>" class="menu <?= ($active == 'prestasi') ? 'menu--active' : '' ?>">
				<div class="menu__icon"> <i data-lucide="book"></i> </div>
				<div class="menu__title"> Prestasi </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('siswa/data-pelanggaran') ?>" class="menu <?= ($active == 'pelanggaran') ? 'menu--active' : '' ?>">
				<div class="menu__icon"> <i data-lucide="user-x"></i> </div>
				<div class="menu__title"> Pelanggaran Siswa </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('siswa/rekap-monitoring') ?>" class="menu <?= ($active == 'rekap') ? 'menu--active' : '' ?>">
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