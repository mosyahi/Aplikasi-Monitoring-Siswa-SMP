
<?php if (session()->has('success')): ?>
<div id="button-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x" class="w-8 h-8 text-slate-400"></i> </a>
			<div class="modal-body p-0">
				<div class="p-5 text-center"> <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
					<div class="text-3xl mt-5">Pemberitahuan</div>
					<div class="text-slate-500 mt-2"><?= session('success') ?></div>
				</div>
				<div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Ok</button> </div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
