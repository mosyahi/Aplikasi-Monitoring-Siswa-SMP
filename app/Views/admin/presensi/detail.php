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
                    <th class="text-center whitespace-nowrap">TANGGAL</th>
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
                                <div class="font-medium whitespace-nowrap">
                                    <?php foreach ($presensi as $pre) : ?>
                                        <?php if ($pre['id_siswa'] == $item['id_siswa']) : ?>
                                            <?php
                                            // Store unique dates for each student
                                            $uniqueDates[$item['id_siswa']][] = date('d-m-Y', strtotime($pre['tanggal']));
                                            ?>
                                        <?php endif ?>
                                    <?php endforeach ?>

                                    <?php if (!empty($uniqueDates[$item['id_siswa']])) : ?>
                                        <?php
                                        // Display unique dates for each student
                                        $uniqueDates[$item['id_siswa']] = array_unique($uniqueDates[$item['id_siswa']]);
                                        foreach ($uniqueDates[$item['id_siswa']] as $uniqueDate) :
                                        ?>
                                            <span class="badge badge-primary">
                                                <?= $uniqueDate ?>
                                            </span>
                                        <?php endforeach ?>
                                    <?php endif ?>

                                    <?php if (empty($presensi) || !in_array($item['id_siswa'], array_column($presensi, 'id_siswa'))) : ?>
                                    <?php endif ?>
                                </div>
                            </td>

                            <td class="table-report__action text-center">
                                <div class="font-medium whitespace-nowrap">
                                    <?php
                                    $currentDate = date('Y-m-d');
                                    $presensiExist = false;
                                    $status = ''; // Default status kosong

                                    foreach ($presensi as $pre) {
                                        if ($pre['id_siswa'] == $item['id_siswa'] && $pre['tanggal'] == $currentDate) {
                                            $status = $pre['status'];
                                            $presensiExist = true;
                                            break;
                                        }
                                    }

                                    if (!$presensiExist) {
                                        // Jika presensi belum ada, tampilkan status kosong atau ikon 'X'
                                        $status = '<i class="fas fa-times text-danger"></i>';
                                    }

                                    echo $status;
                                    ?>
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


<?= $this->endSection() ?>