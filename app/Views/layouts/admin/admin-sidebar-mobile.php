<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
	<div class="mobile-menu-bar">
		<a href="" class="flex mr-auto">
			<img alt="Logo" class="w-6" src="<?= base_url() ?>source/dist/images/logo.svg">
		</a>
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
	</div>
	<div class="scrollable">
		<a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
		<ul class="scrollable__content py-2">
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
				<a href="javascript:;" class="menu <?= ($active == 'kelas' || $active == 'jurusan' || $active == 'anggota' || $active == 'walikelas') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="inbox"></i> </div>
					<div class="menu__title">
						Kelas
						<div class="menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
					</div>
				</a>
				<ul class="<?= ($active == 'kelas' || $active == 'jurusan' || $active == 'anggota' || $active == 'walikelas') ? 'menu__sub-open' : '' ?>">
					<li>
						<a href="<?= base_url('admin/data-jurusan') ?>" class="menu <?= ($active == 'jurusan') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> <i data-lucide="git-commit"></i> </div>
							<div class="menu__title"> Set Jurusan </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-kelas') ?>" class="menu <?= ($active == 'kelas') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Set Kelas </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-walikelas') ?>" class="menu <?= ($active == 'walikelas') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> <i data-lucide="git-commit"></i> </div>
							<div class="menu__title"> Set Wali Kelas </div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('admin/data-anggota-kelas') ?>" class="menu <?= ($active == 'anggota') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> 
								<i data-lucide="git-commit"></i> 
							</div>
							<div class="menu__title"> Set Anggota Kelas </div>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?= base_url('admin/data-tapel') ?>" class="menu <?= ($active == 'tapel') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="pen-tool"></i> </div>
					<div class="menu__title"> Tahun Pelajaran </div>
				</a>
			</li>
			<li>
				<a href="javascript:;" class="menu <?= ($active == 'ranking' || $active == 'keaktifan-siswa' || $active == 'ekstrakurikuler' || $active == 'prestasi' || $active == 'sp') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="book-open"></i> </div>
					<div class="menu__title">
						Pembelajaran
						<div class="menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
					</div>
				</a>
				<ul class="<?= ($active == 'ranking' || $active == 'keaktifan-siswa' || $active == 'ekstrakurikuler' || $active == 'prestasi-akademik' || $active == 'prestasi-nonakademik' || $active == 'sp') ? 'menu__sub-open' : '' ?>">
					<li>
						<a href="javascript:;" class="menu <?= ($active == 'ranking' || $active == 'keaktifan-siswa') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> <i data-lucide="git-commit"></i> </div>
							<div class="menu__title">
								Akademik 
								<div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
							</div>
						</a>
						<ul class="<?= ($active == 'ranking' || $active == 'keaktifan-siswa' || $active == 'prestasi-akademik') ? 'menu__sub-open' : '' ?>">
							<li>
								<a href="<?= base_url('admin/data-ranking') ?>" class="menu <?= ($active == 'ranking') ? 'menu--active' : '' ?>">
									<div class="menu__icon"> <i data-lucide="minus"></i> </div>
									<div class="menu__title">Ranking</div>
								</a>
							</li>
							<li>
								<a href="<?= base_url('admin/keaktifan-siswa') ?>" class="menu <?= ($active == 'keaktifan-siswa') ? 'menu--active' : '' ?>">
									<div class="menu__icon"> <i data-lucide="minus"></i> </div>
									<div class="menu__title">Keaktifan Siswa</div>
								</a>
							</li>
							<li>
								<a href="<?= base_url('admin/prestasi-akademik') ?>" class="menu <?= ($active == 'prestasi-akademik') ? 'menu--active' : '' ?>">
									<div class="menu__icon"> <i data-lucide="minus"></i> </div>
									<div class="menu__title">Prestasi Akademik</div>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;" class="menu <?= ($active == 'ekstrakurikuler' || $active == 'prestasi' || $active == 'sp') ? 'menu--active' : '' ?>">
							<div class="menu__icon"> <i data-lucide="git-commit"></i> </div>
							<div class="menu__title">
								Non-Akademik 
								<div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
							</div>
						</a>
						<ul class="<?= ($active == 'ekstrakurikuler' || $active == 'setekstra' || $active == 'prestasi' || $active == 'pelanggaran' || $active == 'sp') ? 'menu__sub-open' : '' ?>">
							<li>
								<a href="<?= base_url('admin/ekstrakurikuler') ?>" class="menu <?= ($active == 'ekstrakurikuler') ? 'menu--active' : '' ?>">
									<div class="menu__icon"> <i data-lucide="minus"></i> </div>
									<div class="menu__title">Ekstrakurikuler</div>
								</a>
							</li>
							<li>
								<a href="<?= base_url('admin/prestasi-nonakademik') ?>" class="menu <?= ($active == 'prestasi-nonakademik') ? 'menu--active' : '' ?>">
									<div class="menu__icon"> <i data-lucide="minus"></i> </div>
									<div class="menu__title">Prestasi Non-Akademik</div>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?= base_url('admin/data-pelanggaran') ?>" class="menu <?= ($active == 'pelanggaran') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="user-x"></i> </div>
					<div class="menu__title"> Pelanggaran Siswa </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/evaluasi-guru') ?>" class="menu <?= ($active == 'evaluasi-guru') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="edit-3"></i> </div>
					<div class="menu__title"> Evaluasi Guru </div>
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
				<a href="<?= base_url('admin/profile') ?>" class="menu <?= ($active == 'profile') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="airplay"></i> </div>
					<div class="menu__title"> Profile </div>
				</a>
			</li>
			<li>
				<a href="<?= base_url('admin/data-pengumuman') ?>" class="menu <?= ($active == 'pengumuman') ? 'menu--active' : '' ?>">
					<div class="menu__icon"> <i data-lucide="volume-2"></i> </div>
					<div class="menu__title"> Pengumuman </div>
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