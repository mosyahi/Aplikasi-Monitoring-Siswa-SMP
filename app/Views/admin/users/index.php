<?= $this->extend('layouts/admin/admin-main') ?>
<?= $this->section('content') ?>

<div class="intro-y col-span-12 md:col-span-12 mt-4">
    <?= $this->include('components/alert-login') ?>
</div>
<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">
        Data Users
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
        <a type="button" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" class="btn btn-primary shadow-md mr-2">Tambah User</a>
        <div class="dropdown">
            <a type="button" class="btn px-2 box" href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </a>
        </div>
        <div class="hidden md:block mx-auto text-slate-500"><a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
            </div>
        </div>
    </div>
    <!-- BEGIN: Users Layout -->
    <?php foreach ($dataUser as $item) : ?>
       <div class="intro-y col-span-12 md:col-span-6 aa">
        <div class="box bb">
            <div class="flex flex-col lg:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400 cc">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">

                    <?php if (!empty($item['gambar_url']['gambar_siswa_url'])): ?>
                        <img title="Akun: <?= $item['status'] ?>" data-action="zoom" class="tooltip rounded-full" src="<?= $item['gambar_url']['gambar_siswa_url']; ?>">
                    <?php elseif (!empty($item['gambar_url']['gambar_ortu_url'])): ?>
                        <img title="Akun: <?= $item['status'] ?>" data-action="zoom" class="tooltip rounded-full" src="<?= $item['gambar_url']['gambar_ortu_url']; ?>">
                    <?php elseif (!empty($item['gambar_url']['gambar_guru_url'])): ?>
                        <img title="Akun: <?= $item['status'] ?>" data-action="zoom" class="tooltip rounded-full" src="<?= $item['gambar_url']['gambar_guru_url']; ?>">
                    <?php else: ?>
                        <img alt="Foto" src="<?= base_url('source/dist/images/profile.png'); ?>">
                    <?php endif; ?>                    

                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <a href="" class="font-medium"><?= $item['nama'] ?></a> 
                    <div class="text-slate-500 text-xs mt-0.5"><?= $item['email'] ?></div>
                </div>
                <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                    <div class="btn btn-sm btn-secondary-soft mt-0.5">
                        <strong><?= $item['role'] ?></strong>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                    <div class="flex text-slate-500 text-xs">
                        <div class="mr-auto">
                            <a class="<?= ($item['status'] == 'Active') ? 'text-success' : 'text-danger' ?>">
                                <?= $item['status'] ?>
                            </a>
                        </div>
                        <div><?= ($item['status'] == 'Active') ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></div>
                    </div>
                    <div class="progress h-1 mt-2">
                        <div class="progress-bar w-<?= ($item['status'] == 'Active') ? '100' : '0' ?> bg-primary" role="progressbar" aria-valuenow="<?= ($item['status'] == 'Active') ? '100' : '0' ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <button class="btn btn-primary-soft py-1 px-2 mr-2" data-tw-toggle="modal" data-tw-target="#update-<?= $item['id_user'] ?>">Edit</button>
                <button class="btn btn-danger-soft py-1 px-2" data-tw-toggle="modal" data-tw-target="#delete-<?= $item['id_user'] ?>" data-delete-url="<?= base_url('admin/data-users/delete/' . $item['id_user']) ?>">Hapus</button>
            </div>
        </div>
    </div>
<?php endforeach ?>
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
    <nav class="w-full sm:w-auto sm:mr-auto">
        <ul class="pagination">
            <!-- Item-item pagination akan ditempatkan di sini -->
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

<script>
    $(document).ready(function() {
        var dataUser = <?php echo json_encode($dataUser); ?>; 
        var totalItems = dataUser.length;
        var itemsPerPage = 5;
        var currentPage = 1;

        // Fungsi untuk menampilkan halaman tertentu
        function showPage(page) {
            $cc.hide();
            var startIndex = (page - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            $cc.slice(startIndex, endIndex).show();
        }

        // Inisialisasi tampilan awal
        showPage(currentPage);

        // Fungsi untuk mengubah jumlah item per halaman
        $('#items-per-page').on('change', function() {
            itemsPerPage = parseInt($(this).val());
            // Reset halaman ke 1 ketika mengubah jumlah item per halaman
            currentPage = 1; 
            showPage(currentPage);
            createPaginationItems();
        });

        // Fungsi untuk menghitung jumlah halaman yang diperlukan
        function calculateTotalPages() {
            return Math.ceil(totalItems / itemsPerPage);
        }
        
        function createPaginationItems() {
            var totalPages = calculateTotalPages();
            var $pagination = $('.pagination');
            // Menghapus item-item pagination yang ada
            $pagination.empty(); 

            // Tambahkan tombol "Previous"
            $pagination.append('<li class="page-item"><a class="page-link prev" href="#"> <i class="w-4 h-4 fas fa-chevron-left"></i> </a></li>');

            // Tambahkan tombol-tombol halaman
            for (var i = 1; i <= totalPages; i++) {
                var pageClass = (i === currentPage) ? 'active' : '';
                $pagination.append('<li class="page-item page ' + pageClass + '"><a class="page-link" href="#">' + i + '</a></li>');
            }

            // Tambahkan tombol "Next"
            $pagination.append('<li class="page-item"><a class="page-link next" href="#"> <i class="w-4 h-4 fas fa-chevron-right"></i> </a></li>');
        }

        // Inisialisasi pagination item
        createPaginationItems();

        // Fungsi untuk mengubah halaman saat tombol "Previous" atau "Next" diklik
        $('.pagination').on('click', 'a', function(e) {
            e.preventDefault();
            var $this = $(this);
            if ($this.hasClass('prev')) {
                if (currentPage > 1) {
                    currentPage--;
                }
            } else if ($this.hasClass('next')) {
                if (currentPage < calculateTotalPages()) {
                    currentPage++;
                }
            } else {
                currentPage = parseInt($this.text());
            }
            showPage(currentPage);
            createPaginationItems();
        });
    });

</script>

<!-- BEGIN: Modal Content -->
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
            <h2 class="font-medium text-base mr-auto">Tambah Data Users</h2> 
        </div>
        <form action="<?= base_url('admin/data-users/add') ?>" method="POST">
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-12"> 
                    <label for="modal-form-1" class="form-label">Nama Lengkap</label> 
                    <input id="modal-form-1" type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" required> 
                </div>
                <div class="col-span-12 sm:col-span-12"> 
                    <label for="modal-form-1" class="form-label">Email</label> 
                    <input id="modal-form-1" name="email" type="email" class="form-control" placeholder="Email Aktif" required> 
                </div>
                <div class="col-span-12 sm:col-span-12"> 
                    <label for="modal-form-1" class="form-label">Password</label> 
                    <input id="modal-form-1" name="password" type="password" class="form-control" placeholder="**********" required> 
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label for="modal-form-1" class="form-label">Status</label> 
                    <select data-placeholder="Pilih Status" name="status" class="tom-select w-full" required>
                        <option selected disabled>-- Pilih Status --</option>
                        <option value="Active">Aktif</option>
                        <option value="Inactive">Tidak Aktif</option>
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

<?php foreach ($dataUser as $key => $item) : ?>
    <div id="update-<?= $item['id_user'] ?>" class="modal" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Edit Data <?= $item['nama'] ?></h2> 
            </div>
            <form action="<?= base_url('admin/data-users/update/' . $item['id_user']) ?>" method="POST">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Nama Lengkap</label> 
                        <input id="modal-form-1" type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" value="<?= $item['nama'] ?>" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Email</label> 
                        <input id="modal-form-1" name="email" type="email" class="form-control" placeholder="Email Aktif" value="<?= $item['email'] ?>" required> 
                    </div>
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Password</label> 
                        <input id="modal-form-1" name="password" type="password" class="form-control" placeholder="**********" value="<?= $item['password'] ?>" required disabled> 
                    </div>
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Role</label> 
                        <input id="modal-form-1" name="role" type="text" class="form-control" value="<?= $item['role'] ?>" required disabled> 
                    </div>
                    <div class="col-span-12 sm:col-span-12"> 
                        <label for="modal-form-1" class="form-label">Status</label> 
                        <select data-placeholder="Pilih Status" name="status" class="tom-select w-full" required>
                            <option value="Active" <?= ($item['status'] == 'Active') ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= ($item['status'] == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
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

<div id="delete-<?= $item['id_user'] ?>" class="modal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
         <div class="modal-body p-0">
             <div class="p-5 text-center"> 
                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Konfirmasi Penghapusan</div>
                <div class="text-slate-500 mt-2">Apakah anda yakin ingin menghapus data users ( <?= $item['nama'] ?> )?</div>
            </div>
            <div class="px-5 pb-8 text-center"> 
                <a type="button" href="<?= base_url('admin/data-users/delete/' . $item['id_user']) ?>" type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Ok</a> 
            </div>
        </div>
    </div>
</div>
</div>
<?php endforeach ?>

<?= $this->endSection() ?>