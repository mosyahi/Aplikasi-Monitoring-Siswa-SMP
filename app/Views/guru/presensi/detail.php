<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
    <?= $this->include('components/alert-login') ?>
</div>

<!-- <div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Anggota Kelas
    </h2>
</div> -->

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <h2 class="text-lg font-medium truncate mr-5">
            Data Presensi
        </h2>
        <div class="hidden md:block mx-auto text-slate-500">
            <a href="<?= current_url() ?>" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-100 relative text-slate-500">
                <a type="button" href="<?= base_url('guru/absensi') ?>" class="btn btn-primary-soft btn-sm"><i class="fas fa-chevron-left mr-2"></i> Kembali</a>
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
                        <td colspan="7" class="text-center whitespace-nowrap">-- Belum ada data --</td>
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

<?= $this->endSection() ?>