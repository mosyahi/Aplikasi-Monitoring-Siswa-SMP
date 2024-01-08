<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
    <?= $this->include('components/alert-login') ?>
</div>

<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Anggota Kelas
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <select data-placeholder="Pilih Kelas" class="tom-select w-full" id="kelasSelect" name="tingkat">
                <option value="Semua Kelas">-- Semua Kelas --</option>
                <?php foreach ($kelas as $kelasItem) : ?>
                    <option value="<?= $kelasItem['tingkat'] ?> <?= $kelasItem['tipe_kelas'] ?>">
                        <?= $kelasItem['tingkat'] ?> <?= $kelasItem['tipe_kelas'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NO</th>
                    <th class="whitespace-nowrap">FOTO</th>
                    <th class="text-center whitespace-nowrap">NAMA</th>
                    <th class="text-center whitespace-nowrap">KELAS</th>
                    <th class="text-center whitespace-nowrap">PRESENSI</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="mangBoleh">
                <?php if (empty($siswa)) : ?>
                    <tr>
                        <td colspan="6" class="text-center whitespace-nowrap">-- Belum ada data --</td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1; ?>
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
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <div class="font-medium whitespace-nowrap">
                                        <?= $item['nama'] ?>
                                    </div>
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <div class="font-medium whitespace-nowrap">
                                        <?php foreach ($kelas as $key => $kel) : ?>
                                            <?php if ($kel['id_kelas'] == $item['id_kelas']) : ?>
                                                <?= $kel['tingkat'] ?> <?= $kel['tipe_kelas'] ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </td>
                            <td class="table-report__action text-center">
                                <!-- <div class="flex justify-center items-center"> -->
                                <div class="font-medium whitespace-nowrap">
                                    <div class="dropdown ml-auto">
                                        <a class="dropdown-toggle block text-primary" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fas fa-user-check w-5 h-5 text-slate-500 text-primary"></i> Presensi</a>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a onclick="markPresensi('<?= $item['id_siswa'] ?>', 'hadir')" class="dropdown-item">Hadir</a>
                                                </li>
                                                <li>
                                                    <a onclick="markPresensi('<?= $item['id_siswa'] ?>', 'alfa')" class="dropdown-item">Alfa</a>
                                                </li>
                                                <li>
                                                    <a onclick="markPresensi('<?= $item['id_siswa'] ?>', 'sakit')" class="dropdown-item">Sakit</a>
                                                </li>
                                                <li>
                                                    <a onclick="markPresensi('<?= $item['id_siswa'] ?>', 'izin')" class="dropdown-item">Izin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </td>
                            <td class="table-report__action text-center">
                                <div class="flex justify-center items-center">
                                    <div class="font-medium whitespace-nowrap">
                                        <?php foreach ($presensi as $pre) : ?>
                                            <?php if ($pre['id_siswa'] == $item['id_siswa']) : ?>
                                                <?= $pre['status'] ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="javascript:;" type="button" data-tw-toggle="modal" data-tw-target="#view-<?= $item['id_siswa'] ?>" class="flex items-center mr-3 text-primary"> <i data-lucide="toggle-right" class="w-4 h-4 mr-1"></i> View </a>
                                    <a class="flex items-center mr-3" href="<?= base_url('admin/data-siswa/edit/' . $item['id_siswa']) ?>"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_siswa'] ?>" data-delete-url="<?= base_url('admin/data-siswa/delete/' . $item['id_siswa']) ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif; ?>
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
    <!-- END: Data List -->
</div>

<?php foreach ($siswa as $key => $item) : ?>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-<?= $item['id_siswa'] ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
                        <div class="text-slate-500 mt-2">
                            Apakah anda yakin ingin menghapus siswa ( <?= $item['nama'] ?>)
                            <br>
                            Penghapusan ini bersifat permanen beserta dengan biodata keseluruhan.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <a type="button" href="<?= base_url('admin/data-siswa/delete/' . $item['id_siswa']) ?>" class="btn btn-danger w-24">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->

    <div id="view-<?= $item['id_siswa'] ?>" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-5">
                    <h2 class="font-medium text-base mr-auto">Data View <?= $item['nama'] ?></h2>
                </div>
                <div class="modal-body">
                    <div class="preview">
                        <div>
                            <label for="regular-form-1" class="form-label">Nama</label>
                            <input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $item['nama'] ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Nomor Induk Siswa</label>
                            <input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $item['nis'] ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Email</label>
                            <input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $item['email'] ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Jenis Kelamin</label>
                            <input type="text" name="jk" class="form-control block mx-auto" data-single-mode="true" value="<?= $item['jk'] ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Tanggal Lahir</label>
                            <input type="text" name="tgl_lahir" class="datepicker form-control block mx-auto" data-single-mode="true" value="<?= $item['tgl_lahir'] ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Kelas</label>
                            <input id="regular-form-1" name="nama" type="text" class="form-control" value="<?= $kelasSiswa[$item['id_siswa']] ?? ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Alamat</label>
                            <textarea id="regular-form-1" name="nama" type="text" class="form-control" disabled><?= $item['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="preview">
                        <label for="regular-form-1" class="form-label mt-3">Foto</label>
                        <div>
                            <div class="fallback">
                                <div id="fotoPreview" class="mt-3">
                                    <img id="previewImage" src="<?= base_url('uploads/siswa/' . $item['foto']) ?>" alt="Foto Siswa" style="max-width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-pending-soft w-26 mr-2 mb-2" data-tw-dismiss="modal"> <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i> Kembali </button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>

    <script>
        function markPresensi(idSiswa, status) {
            $.ajax({
                url: '<?= base_url('guru/absen/mark-presensi/') ?>' + idSiswa + '/' + status,
                type: 'POST',
                success: function(response) {
                    if (response.status === 'success') {
                        // Show SweetAlert2 success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Yeaaa!! <br><br>Presensi berhasil ditandai.',
                            showConfirmButton: false,
                            timer: 1500, // Time in milliseconds
                        }).then(function() {
                            // Reload the page after success message
                            location.reload();
                        });
                    } else {
                        // Show SweetAlert2 error notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menandai presensi.',
                        });
                    }
                },
                error: function() {
                    // Show SweetAlert2 error notification
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan.',
                    });
                }
            });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function filterSiswaByKelas(selectedKelas) {
                const mangBoleh = document.getElementById('mangBoleh');
                const rows = mangBoleh.getElementsByTagName('tr');

                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const kelasCell = row.cells[3];

                    if (selectedKelas === 'Semua Kelas' || kelasCell.textContent.includes(selectedKelas)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }

            const kelasSelect = document.getElementById('kelasSelect');
            kelasSelect.addEventListener('change', function() {
                const selectedKelas = kelasSelect.value;
                filterSiswaByKelas(selectedKelas);
            });
        });
    </script>

    <?= $this->endSection() ?>