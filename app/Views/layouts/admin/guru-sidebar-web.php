<!-- BEGIN: Side Menu -->
<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4">
		<img alt="Midone - HTML Admin Template" class="w-6" src="<?= base_url() ?>source/dist/images/logo.svg">
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
			<a href="javascript:;" class="side-menu <?= ($active == 'kelas' || $active == 'anggota') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
				<div class="side-menu__title">
					Kelas
					<div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
				</div>
			</a>
			<ul class="<?= ($active == 'kelas' || $active == 'anggota') ? 'side-menu__sub-open' : '' ?>">
				<li>
					<a href="<?= base_url('guru/data-kelas') ?>" class="side-menu <?= ($active == 'kelas') ? 'side-menu--active' : '' ?>">
						<div class="side-menu__icon">
							<i data-lucide="git-commit"></i>
						</div>
						<div class="side-menu__title"> Set Kelas </div>
					</a>
				</li>
				<li>
					<a href="<?= base_url('guru/data-anggota-kelas') ?>" class="side-menu <?= ($active == 'anggota') ? 'side-menu--active' : '' ?>">
						<div class="side-menu__icon">
							<i data-lucide="git-commit"></i>
						</div>
						<div class="side-menu__title"> Anggota Kelas </div>
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="<?= base_url('guru/prestasi-akademik') ?>" class="side-menu <?= ($active == 'prestasi') ? 'side-menu--active' : '' ?>">
				<div class="side-menu__icon"> <i data-lucide="book"></i> </div>
				<div class="side-menu__title"> Prestasi </div>
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
			<a href="<?= base_url('logout') ?>" class="side-menu">
				<div class="side-menu__icon"> <i data-lucide="log-out"></i> </div>
				<div class="side-menu__title"> Logout </div>
			</a>
		</li>
	</ul>
</nav>
<!-- END: Side Menu -->