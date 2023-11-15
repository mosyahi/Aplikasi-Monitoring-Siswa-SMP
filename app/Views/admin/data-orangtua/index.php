<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="mt-4">
    <?= $this->include('components/alert-login') ?>
</div>

<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Orang Tua
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a type="button" href="<?= base_url('admin/data-orangtua/new') ?>" class="btn btn-primary shadow-md mr-2">Tambah Data</a>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </button>
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
                    <th class="text-center whitespace-nowrap">NAMA ORTU</th>
                    <th class="text-center whitespace-nowrap">NAMA SISWA</th>
                    <th class="text-center whitespace-nowrap">POSISI</th>
                    <th class="text-center whitespace-nowrap">PEKERJAAN</th>
                    <th class="text-center whitespace-nowrap">ALAMAT</th>
                    <th class="text-center whitespace-nowrap">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orangtua)) : ?>
                    <tr>
                        <td colspan="8" class="text-center whitespace-nowrap">-- Belum ada data --</td>
                    </tr>
                <?php else : ?>
                    <?php $i =1; ?>
                    <?php foreach ($orangtua as $item) : ?>
                        <tr class="intro-x">
                            <td><?= $i++ ?></td>
                            <td class="w-25">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img src="<?= base_url('uploads/orangtua/' . $item['foto']) ?>" data-action="zoom" class="tooltip rounded-full" alt="<?= $item['nama'] ?>" title="Uploaded at <?= $item['created_at'] ?>">
                                    </div>
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="font-medium whitespace-nowrap"><?= $item['nama'] ?></div> 
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?= $item['email'] ?></div>
                            </td>
                            <td class="table-report__action">
                                <?php foreach ($siswa as $oi) : ?>
                                    <?php if ($oi['id_siswa'] == $item['id_siswa']) : ?>
                                        <div class="font-medium whitespace-nowrap"><?= $oi['nama'] ?></div> 
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"><?= $oi['nis'] ?></div>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="" class="font-medium whitespace-nowrap"><?= $item['sbg'] ?></a>
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="" class="font-medium whitespace-nowrap"><?= $item['pekerjaan'] ?></a>
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="javascript:;" data-theme="light" data-tooltip-content="#custom-content-tooltip" data-trigger="click" class="tooltip btn btn-primary-soft w-12 mr-1 btn-sm btn-rounded"><i class="fas fa-eye"></i></a>
                                    <div class="tooltip-content">
                                     <div id="custom-content-tooltip" class="relative flex items-center py-1">
                                         <div class="w-12 h-12 image-fit"> 
                                            <div class="w-10 h-10 image-fit zoom-in">
                                                <img src="<?= base_url('uploads/orangtua/' . $item['foto']) ?>" class="tooltip rounded-full" alt="<?= $item['nama'] ?>" title="Uploaded at <?= $item['created_at'] ?>"> 
                                            </div>
                                        </div>
                                        <div class="ml-4 mr-auto">
                                         <div class="font-medium dark:text-slate-200 leading-relaxed"><?= $item['nama'] ?></div>
                                         <div class="text-slate-500 dark:text-slate-400"><?= $item['alamat'] ?></div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </td>
                     <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="<?= base_url('admin/data-orangtua/edit/' . $item['id_ortu']) ?>"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_ortu'] ?>" data-delete-url="<?= base_url('admin/data-orangtua/delete/' . $item['id_ortu']) ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
</div>

<?php foreach ($orangtua as $key => $item) : ?>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-<?= $item['id_ortu'] ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
                        <div class="text-slate-500 mt-2">
                            Apakah anda yakin ingin menghapus ( <?= $item['nama'] ?>) 
                            <br>
                            Penghapusan ini bersifat permanen.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <a type="button" href="<?= base_url('admin/data-orangtua/delete/' . $item['id_ortu']) ?>" class="btn btn-danger w-24">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
<?php endforeach ?>

<?= $this->endSection() ?>