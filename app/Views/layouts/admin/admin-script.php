<!-- BEGIN: JS Assets-->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="<?= base_url() ?>source/dist/js/app.js"></script>
<?= $this->include('layouts/admin/script') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		var $table = $('.table-report');
		var $tbody = $table.find('tbody');
		var $rows = $tbody.find('tr');
		var totalItems = $rows.length;
		// Jumlah item per halaman default
		var itemsPerPage = 10; 
		var currentPage = 1;

    	// Fungsi untuk menampilkan halaman tertentu
		function showPage(page) {
			$rows.hide();
			var startIndex = (page - 1) * itemsPerPage;
			var endIndex = startIndex + itemsPerPage;
			$rows.slice(startIndex, endIndex).show();
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

    	// CEVRON MUNCUL SAAT ADA LEBIH DARI 1 HALAMANNNN
		// function createPaginationItems() {
		// 	var totalPages = calculateTotalPages();
		// 	var $pagination = $('.pagination');
		// 	// Menghapus item-item pagination yang ada
		// 	$pagination.empty(); 

        // 	// Tambahkan tombol "Previous"
		// 	if (currentPage > 1) {
		// 		$pagination.append('<li class="page-item"><a class="page-link prev" href="#"> <i class="w-4 h-4 fas fa-chevron-left"></i> </a></li>');
		// 	}

        // 	// Tambahkan tombol-tombol halaman
		// 	for (var i = 1; i <= totalPages; i++) {
		// 		var pageClass = (i === currentPage) ? 'active' : '';
		// 		$pagination.append('<li class="page-item page ' + pageClass + '"><a class="page-link" href="#">' + i + '</a></li>');
		// 	}

        // 	// Tambahkan tombol "Next"
		// 	if (currentPage < totalPages) {
		// 		$pagination.append('<li class="page-item"><a class="page-link next" href="#"> <i class="w-4 h-4 fas fa-chevron-right"></i> </a></li>');
		// 	}
		// }
		
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

<!-- END: JS Assets-->

<!-- <div id="dark" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10 hidden">
	<div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
	<i class="dark-mode-icon-sun fas fa-sun hidden"></i>
	<i class="dark-mode-icon-moon fas fa-moon"></i>
</div>

<div id="light" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
	<div class="mr-4 text-slate-600 dark:text-slate-200">Light Mode</div>
	<i class="dark-mode-icon-sun fas fa-sun"></i>
	<i class="dark-mode-icon-moon fas fa-moon hidden"></i>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const lightModeSwitcher = document.getElementById('light'); 
		const darkModeSwitcher = document.getElementById('dark'); 
		const themeSwitcher = document.querySelector('html'); 

		function enableDarkMode() {
			themeSwitcher.classList.add('dark');
			lightModeSwitcher.querySelector('.dark-mode-icon-moon').classList.remove('hidden');
			lightModeSwitcher.querySelector('.dark-mode-icon-sun').classList.add('hidden');
			localStorage.setItem('darkMode', 'enabled');
		}

		function disableDarkMode() {
			themeSwitcher.classList.remove('dark');
			lightModeSwitcher.querySelector('.dark-mode-icon-sun').classList.remove('hidden');
			lightModeSwitcher.querySelector('.dark-mode-icon-moon').classList.add('hidden');
			localStorage.setItem('darkMode', 'disabled');
		}

		const savedDarkMode = localStorage.getItem('darkMode');
		if (savedDarkMode === 'enabled') {
			enableDarkMode();
		} else {
			disableDarkMode();
		}

		lightModeSwitcher.addEventListener('click', function() {
			enableDarkMode();
		});

		darkModeSwitcher.addEventListener('click', function() {
			disableDarkMode();
		});
	});
</script> -->
