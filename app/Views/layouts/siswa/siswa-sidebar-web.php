<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4">
		<img alt="Midone - HTML Admin Template" class="w-8" src="<?= base_url() ?>source/dist-css/images/smpn2sumber.png">
		<span class="hidden xl:block text-white text-lg ml-3"> SMPN 2 Sumber </span> 
	</a>
	<li class="side-nav__devider my-6"></li>
	<ul>
		<li>
			<a href="<?= base_url('siswa/dashboard') ?>" class="side-menu <?= ($active == 'dashboard') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="home"></i> </div>
				<div class="side-menu__title"> Home </div>
			</a>
		</li>
		<li class="side-nav__devider my-6"></li>
		<li>
			<a href="<?= base_url('siswa/prestasi-akademik') ?>" class="side-menu <?= ($active == 'prestasi') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="book"></i> </div>
				<div class="side-menu__title"> Prestasi </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('siswa/data-pelanggaran') ?>" class="side-menu <?= ($active == 'pelanggaran') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="user-x"></i> </div>
				<div class="side-menu__title"> Pelanggaran Siswa </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('siswa/rekap-monitoring') ?>" class="side-menu <?= ($active == 'rekap') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
				<div class="side-menu__title"> Rekap Monitoring </div>
			</a>
		</li>
		<li class="side-nav__devider my-6"></li>
		<li>
			<a href="<?= base_url('siswa/profile') ?>" class="side-menu <?= ($active == 'profile') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="lock"></i> </div>
				<div class="side-menu__title"> Profile </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('logout') ?>" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="log-out"></i> </div>
				<div class="side-menu__title"> Logout </div>
			</a>
		</li>
	</ul>
</nav>