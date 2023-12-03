<!-- BEGIN: JS Assets-->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="<?= base_url() ?>source/dist-css/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		var $table = $('.table-report');
		var $tbody = $table.find('tbody');
		var $rows = $tbody.find('tr');
		var totalItems = $rows.length;
		var itemsPerPage = 10; 
		var currentPage = 1;

		function showPage(page) {
			$rows.hide();
			var startIndex = (page - 1) * itemsPerPage;
			var endIndex = startIndex + itemsPerPage;
			$rows.slice(startIndex, endIndex).show();
		}
		showPage(currentPage);

		$('#items-per-page').on('change', function() {
			itemsPerPage = parseInt($(this).val());
			currentPage = 1; 
			showPage(currentPage);
			createPaginationItems();
		});

		function calculateTotalPages() {
			return Math.ceil(totalItems / itemsPerPage);
		}
		
		function createPaginationItems() {
			var totalPages = calculateTotalPages();
			var $pagination = $('.pagination');
			$pagination.empty(); 

			$pagination.append('<li class="page-item"><a class="page-link prev" href="#"> <i class="w-4 h-4 fas fa-chevron-left"></i> </a></li>');

			for (var i = 1; i <= totalPages; i++) {
				var pageClass = (i === currentPage) ? 'active' : '';
				$pagination.append('<li class="page-item page ' + pageClass + '"><a class="page-link" href="#">' + i + '</a></li>');
			}

			$pagination.append('<li class="page-item"><a class="page-link next" href="#"> <i class="w-4 h-4 fas fa-chevron-right"></i> </a></li>');
		}
		createPaginationItems();

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