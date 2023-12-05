<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
    <?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Guru
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a type="button" href="<?= base_url('admin/data-guru/new') ?>" class="btn btn-primary shadow-md mr-2">Tambah Guru</a>
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
                    <th class="text-center whitespace-nowrap">NAMA</th>
                    <th class="text-center whitespace-nowrap">JK</th>
                    <th class="text-center whitespace-nowrap">EMAIL</th>
                    <th class="text-center whitespace-nowrap">TGL LAHIR</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
               <?php if (empty($guru)) : ?>
                <tr>
                    <td colspan="7" class="text-center whitespace-nowrap">-- Belum ada data --</td>
                </tr>
            <?php else : ?>
                <?php $i =1; ?>
                <?php foreach ($guru as $item) : ?>
                    <tr class="intro-x">
                        <td><?= $i++ ?></td>
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img src="<?= base_url('uploads/guru/' . $item['foto']) ?>" data-action="zoom" class="tooltip rounded-full" alt="<?= $item['nama'] ?>" title="Uploaded at <?= $item['created_at'] ?>">
                                </div>
                            </div>
                        </td>
                        <td class="table-report__action">
                            <div class="font-medium whitespace-nowrap flex items-center justify-center"><?= $item['nama'] ?></div>                      
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5 flex items-center justify-center">NIP : <?= $item['nip'] ?></div>
                        </td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <div class="font-medium whitespace-nowrap">
                                    <?= $item['jk'] ?>
                                </div>
                            </div>
                        </td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <div class="font-medium whitespace-nowrap">
                                    <?= $item['email'] ?>
                                </div>
                            </div>
                        </td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <div class="font-medium whitespace-nowrap">
                                    <?= $item['tanggal_lahir'] ?>
                                </div>
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a href="javascript:;" type="button" data-tw-toggle="modal" data-tw-target="#view-<?= $item['id_guru'] ?>" class="flex items-center mr-3 text-primary"> <i data-lucide="toggle-right" class="w-4 h-4 mr-1"></i> View </a>
                                <a class="flex items-center mr-3" href="<?= base_url('admin/data-guru/edit/' . $item['id_guru'] . '/' . str_replace(' ', '-', urldecode($item['nama']))) ?>"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_guru'] ?>" data-delete-url="<?= base_url('admin/data-guru/delete/' . $item['id_guru']) ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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

<?php foreach ($guru as $key => $item) : ?>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-<?= $item['id_guru'] ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
                        <div class="text-slate-500 mt-2">
                            Apakah anda yakin ingin menghapus guru ( <?= $item['nama'] ?>) 
                            <br>
                            Penghapusan ini bersifat permanen.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <a type="button" href="<?= base_url('admin/data-guru/delete/' . $item['id_guru']) ?>" class="btn btn-danger w-24">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->

    <!-- Modal View -->
    <div id="view-<?= $item['id_guru'] ?>" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
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
                        <label for="regular-form-1" class="form-label">Nomor Induk</label>
                        <input id="regular-form-1" name="nip" type="text" class="form-control" value="<?= $item['nip'] ?>" disabled>
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
                        <label for="regular-form-1" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tgl_lahir" class="form-control block mx-auto" value="<?= $item['tempat_lahir'] ?>" disabled>
                    </div>
                </div>
                <div class="preview">
                    <div class="mt-3">
                        <label for="regular-form-1" class="form-label">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" class="datepicker form-control block mx-auto" data-single-mode="true" value="<?= $item['tanggal_lahir'] ?>" disabled>
                    </div>
                </div>
                <div class="preview">
                    <div class="mt-3">
                        <label for="regular-form-1" class="form-label">Jenis Kelamin</label>
                        <input type="text" name="jk" class="form-control block mx-auto" value="<?= $item['jk'] ?>" disabled>
                    </div>
                </div>
                <div class="preview">
                    <label for="regular-form-1" class="form-label mt-3">Foto</label>
                    <div>
                        <div class="fallback"> 
                            <div id="fotoPreview" class="mt-3">
                                <img id="previewImage" src="<?= base_url('uploads/guru/' . $item['foto']) ?>" alt="Foto Guru" style="max-width: 150px;">
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
    <!-- End Modal View -->
<?php endforeach ?>

<?= $this->endSection() ?>