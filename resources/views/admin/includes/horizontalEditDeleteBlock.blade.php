<div class="p-2 blockWithRang" data-id="{{ $id }}">
	<div class="d-flex align-items-center edit-block">
		<div class="col-10">
			<div class="row">
				<div class="col-4 p-2">
					<div class="p-2 d-flex align-items-center">
						<a href="{{ $editLink }}">
							<span class="line_max_1">
								{{ $title }}
							</span>
						</a>
					</div>
				</div>

				<div class="col-4 p-2 d-flex align-items-center">
					<div class="p-2 d-flex align-items-center">
						<span class="line_max_1">
							@if(isset($text))
								{{ $text }}
							@endif
						</span>
					</div>
				</div>

				<div class="col-4 d-flex align-items-center">
					<div class="p-2 d-flex align-items-center">
						<span class="line_max_1">
							@if(isset($text1))
								{{ $text1 }}
							@endif
						</span>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-2">
			<div class="d-flex justify-content-end">
				<div class="edit-block__edit-delete-block p-2">
					<a href="{{ $editLink }}">
						<div class="p-2">
							<img src="{{ asset('/storage/images/admin/edit.svg') }}" alt="edit" class="bar-tag-bigger-img">
						</div>
					</a>
				</div>
				@if(isset($possibilityToDelete))
					@if($possibilityToDelete !== 0)
						<div class="edit-block__edit-delete-block p-2 delete-block" data-delete-link="{{ $deleteLink }}">
							<div class="p-2">
								<img src="{{ asset('/storage/images/admin/close.svg') }}" alt="close" class="bar-tag-bigger-img">
							</div>
						</div>
					@endif
				@endif
				<div class="edit-block__edit-delete-block p-2 edit-block__edit-delete-block--move rangButton">
					<div class="p-2">
						<img src="{{ asset('/storage/images/admin/bars.svg') }}" alt="Move" class="bar-tag-bigger-img">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>