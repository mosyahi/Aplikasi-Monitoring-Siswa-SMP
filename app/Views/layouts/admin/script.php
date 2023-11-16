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

    	// CEVRON MUNCUL SAAT ADA LEBIH DARI 1 HALAMANNNNNNN
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