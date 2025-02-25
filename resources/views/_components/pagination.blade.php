
<div class="pagination">
	<a href="?page=1" class="fa fa-backward-fast"></a>
	@if ($paginator->currentPage() == 1)
		<span class="fa fa-backward-step"></span>
	@else
		<a href="?page={{$paginator->currentPage() - 1}}" class="fa fa-backward-step"></a>
	@endif

	<span class="cursorPosition">
		<span class="numbers">
			{{( $paginator->currentPage() - 1) * $paginator->perPage() + 1}} - {{min($paginator->total(), $paginator->currentPage() * $paginator->perPage()) }}
		</span>
		of
		<span class="numbers">{{ $paginator->total() }}</span>
	</span>


	@if ($paginator->currentPage() == $paginator->lastPage())
		<span class="fa fa-forward-step"></span>
	@else
		<a href="?page={{$paginator->currentPage() + 1 }}" class="fa fa-forward-step"></a>
	@endif
	<a href="?page={{$paginator->lastPage()}}" class="fa fa-forward-fast"></a>
</div>
