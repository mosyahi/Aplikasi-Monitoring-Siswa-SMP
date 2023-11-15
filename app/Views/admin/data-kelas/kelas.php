<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
    <?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Kelas
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
        <a type="button" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">Tambah Kelas</a>
        <div class="dropdown">
            <a type="button" class="btn px-2 box" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </a>
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
    <!-- BEGIN: Kelas Layout -->
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
                    <?php $i =1; ?>
                    <?php foreach ($kelas as $item) : ?>
                        <tr class="intro-x">
                            <td><?= $i++ ?></td>
                            <td class="table-report__action">
                                <div class="flex items-center justify-center text-pending"> <i class="w-4 h-4 mr-2"></i>
                                    <?= $item['tingkat'] ?> <?= $item['tipe_kelas'] ?>
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <button class="flex items-center mr-3" data-tw-toggle="modal" data-tw-target="#update-<?= $item['id_kelas'] ?>"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </button>
                                    <button class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_kelas'] ?>" data-delete-url="<?= base_url('admin/data-kelas/delete/' . $item['id_kelas']) ?>"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </button>
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
    <!-- BEGIN: Kelas Layout -->
</div>

<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
            <h2 class="font-medium text-base mr-auto">Tambah Data Kelas</h2> 
        </div>
        <form action="<?= base_url('admin/data-kelas/add') ?>" method="POST">
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-1" class="form-label">Tingkat</label> 
                    <select data-placeholder="Pilih Kelas" name="tingkat" class="tom-select w-full" required>
                        <option selected disabled>-- Pilih Tingkat --</option>
                        <option>VII</option>
                        <option>VIII</option>
                        <option>IX</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label for="modal-form-1" class="form-label">Kelas</label> 
                    <select data-placeholder="Pilih Kelas" name="tipe_kelas" class="tom-select w-full" required>
                        <option selected disabled>-- Pilih Kelas --</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                        <option>F</option>
                        <option>G</option>
                        <option>H</option>
                    </select>
                </div>  
            </div>
            <div class="modal-footer"> 
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button> 
                <button type="submit" class="btn btn-primary w-20">Simpan</button> 
            </div>
        </form>
    </div>
</div>
</div> 

<?php foreach ($kelas as $key => $item) : ?>
    <div id="update-<?= $item['id_kelas'] ?>" class="modal" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Tambah Data Kelas</h2> 
            </div>
            <form action="<?= base_url('admin/data-kelas/update/' . $item['id_kelas']) ?>" method="POST">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6"> 
                        <label for="modal-form-1" class="form-label">Tingkat</label>
                        <select data-placeholder="Pilih Kelas" name="tingkat" class="tom-select w-full" required>
                            <option value="VII" <?= ($item['tingkat'] == 'VII') ? 'selected' : '' ?>>VII</option>
                            <option value="VIII" <?= ($item['tingkat'] == 'VIII') ? 'selected' : '' ?>>VIII</option>
                            <option value="IX" <?= ($item['tingkat'] == 'IX') ? 'selected' : '' ?>>IX</option>
                        </select> 
                    </div>
                    <div class="col-span-12 sm:col-span-6"> 
                        <label for="modal-form-1" class="form-label">Kelas</label>
                        <select data-placeholder="Pilih Kelas" name="tipe_kelas" class="tom-select w-full" required>
                            <option value="A" <?= ($item['tipe_kelas'] == 'A') ? 'selected' : '' ?>>A</option>
                            <option value="B" <?= ($item['tipe_kelas'] == 'B') ? 'selected' : '' ?>>B</option>
                            <option value="C" <?= ($item['tipe_kelas'] == 'C') ? 'selected' : '' ?>>C</option>
                            <option value="D" <?= ($item['tipe_kelas'] == 'D') ? 'selected' : '' ?>>D</option>
                            <option value="E" <?= ($item['tipe_kelas'] == 'E') ? 'selected' : '' ?>>E</option>
                            <option value="F" <?= ($item['tipe_kelas'] == 'F') ? 'selected' : '' ?>>F</option>
                            <option value="G" <?= ($item['tipe_kelas'] == 'G') ? 'selected' : '' ?>>G</option>
                            <option value="H" <?= ($item['tipe_kelas'] == 'H') ? 'selected' : '' ?>>H</option>
                        </select> 
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button> 
                    <button type="submit" class="btn btn-primary w-20">Simpan</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete-<?= $item['id_kelas'] ?>" class="modal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
         <div class="modal-body p-0">
             <div class="p-5 text-center"> 
                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
                <div class="text-slate-500 mt-2">Apakah anda yakin ingin menghapus data Kelas ( <?= $item['tingkat'] ?> <?= $item['tipe_kelas'] ?> )?</div>
            </div>
            <div class="px-5 pb-8 text-center"> 
                <a type="button" href="<?= base_url('admin/data-kelas/delete/' . $item['id_kelas']) ?>" type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Hapus</a> 
            </div>
        </div>
    </div>
</div>
</div>
<?php endforeach ?>

<?= $this->endSection() ?>