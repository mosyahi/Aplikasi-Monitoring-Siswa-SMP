<!-- BEGIN: Side Menu -->
<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4">
		<img alt="Midone - HTML Admin Template" class="w-6" src="<?= base_url() ?>source/dist-css/images/smpn2sumber.png">
		<span class="hidden xl:block text-white text-lg ml-3"> SMPN 2 Sumber </span>
	</a>
	<li class="side-nav__devider my-6"></li>
	<ul>
		<li>
			<a href="<?= base_url('guru/dashboard') ?>" class="side-menu <?= ($active == 'dashboard') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="home"></i> </div>
				<div class="side-menu__title"> Home </div>
			</a>
		</li>
		<li class="side-nav__devider my-6"></li>
		<li>
			<a href="<?= base_url('guru/data-anggota-kelas') ?>" class="side-menu <?= ($active == 'anggota') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="users"></i> </div>
				<div class="side-menu__title"> Data Siswa </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('guru/prestasi-akademik') ?>" class="side-menu <?= ($active == 'prestasi') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="book"></i> </div>
				<div class="side-menu__title"> Prestasi Siswa </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('guru/data-pelanggaran') ?>" class="side-menu <?= ($active == 'pelanggaran') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="user-x"></i> </div>
				<div class="side-menu__title"> Pelanggaran Siswa </div>
			</a>
		</li>
		<li>
			<a href="<?= base_url('guru/rekap-monitoring') ?>" class="side-menu <?= ($active == 'rekap') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
				<div class="side-menu__title"> Rekap Monitoring </div>
			</a>
		</li>
		<li class="side-nav__devider my-6"></li>
		<li>
			<a href="<?= base_url('guru/profile') ?>" class="side-menu <?= ($active == 'profile') ? 'side-menu--active' : '' ?>">
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
<!-- END: Side Menu -->