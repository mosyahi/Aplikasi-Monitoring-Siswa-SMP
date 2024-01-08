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
                    <th class="text-center whitespace-nowrap">KELAS</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kelas)) : ?>
                    <tr>
                        <td colspan="4" class="text-center whitespace-nowrap">-- Belum ada data --</td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($kelas as $item) : ?>
                        <tr class="intro-x">
                            <td><?= $i++ ?></td>
                            <td>
                                <div class="flex items-center justify-center text-pending mr-5"> <i class="w-4 h-4 mr-2"></i>
                                    <?= $item['tingkat'] ?> <?= $item['tipe_kelas'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center items-center">
                                    <a tuype="button" href="<?= base_url('guru/presensi/detail/' . $item['id_kelas']) ?>" class="flex items-center mr-3"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Input Presensi </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
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