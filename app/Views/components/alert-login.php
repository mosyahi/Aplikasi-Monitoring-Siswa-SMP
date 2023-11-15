<?php if (session()->has('error')): ?>
<div class="alert alert-danger-soft show flex items-center mb-2" role="alert">
	<i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
	<?= session('error') ?> 
	<button type="button" class="btn-close text-danger" data-tw-dismiss="alert" aria-label="Close"> 
		<i data-lucide="x" class="w-4 h-4"></i> 
	</button>
</div>
<!-- <script>
	setTimeout(function() {
		$('.alert').fadeOut('slow');
	}, 6000);
</script> -->
<?php endif; ?>

<?php if (session()->has('error-2')): ?>
<div class="alert alert-dark-soft show flex items-center mb-2" role="alert">
	<i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
	<?= session('error-2') ?>
</div>
<!-- <script>
	setTimeout(function() {
		$('.alert').fadeOut('slow');
	}, 6000);
</script> -->
<?php endif; ?>

<?php if (session()->has('success')): ?>
<div class="alert alert-dark-soft show flex items-center mb-2" role="alert">
	<i data-lucide="check-circle" class="w-6 h-6 mr-2"></i>
	<?= session('success') ?>
	<button type="button" class="btn-close text-dark" data-tw-dismiss="alert" aria-label="Close"> 
		<i data-lucide="x" class="w-4 h-4"></i> 
	</button>
</div>
<!-- <script>
	setTimeout(function() {
		$('.alert').fadeOut('slow');
	}, 6000);
</script> -->
<?php endif; ?>

<?php if (session()->has('errors')): ?>
<div class="alert alert-danger-soft show flex items-center mb-2" role="alert">
    <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
    <?php foreach (session('errors') as $error): ?>
        <?= esc($error) ?><br>
    <?php endforeach ?>
    <button type="button" class="btn-close text-danger" data-tw-dismiss="alert" aria-label="Close"> 
        <i data-lucide="x" class="w-4 h-4"></i> 
    </button>
</div>
<?php endif; ?>


