@extends('admin.layouts.master')


@section('pageMetaTitle')
    Modules
@endsection


@section('content')
	@include('admin.includes.tags', ['tag0Text' => 'Modules', 'tag0Url' => route('moduleStartPoint'), 'tag1Text' => $module -> alias, 'tag1Url' => route('moduleEdit', $module -> id), 'tag2Text' => $moduleStep -> title])
	


	<div class="col-2">
		<a href="{{ route('moduleStepAdd', $module -> id) }}">
			Add Step
		</a>
	</div>

    <div class="col-2">
		<a href="{{ route('moduleStepDelete', array($module -> id, $moduleStep -> id)) }}">
			Delete
		</a>
	</div>


	<div class="p-2">
		@if($prev)
			<a href="{{ route('moduleStepEdit', array($module -> id, $prev -> id)) }}">
				Prev
			</a>
		@else
			Prev
		@endif

		@if($next)
			<a href="{{ route('moduleStepEdit', array($module -> id, $next -> id)) }}">
				Next
			</a>
		@else
			Next
		@endif
	</div>


	{{ Form :: model($moduleStep, array('route' => array('moduleStepUpdate', $module -> id, $moduleStep -> id))) }}
		<div class="p-2">
			title
			<br>
			{{ Form :: text('title') }}
		</div>

		<div class="p-2">
			db_table
			<br>
			{{ Form :: text('db_table') }}
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('images', '1') }}

				images?
			</label>
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('possibility_to_add', '1') }}

				possibility_to_add?
			</label>
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('possibility_to_delete', '1') }}

				possibility_to_delete?
			</label>
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('possibility_to_rang', '1') }}

				possibility_to_rang?
			</label>
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('possibility_to_edit', '1') }}

				possibility_to_edit?
			</label>
		</div>

		<div class="p-2">
			<label>
				{{ Form :: checkbox('use_existing_step', '1') }}

				use_existing_step?
			</label>
		</div>

		<div class="p-2">
			<label>
				blocks_max_number:

				{{ Form :: number('blocks_max_number') }}
			</label>
		</div>

		{{ Form :: submit('Submit') }}
	{{ Form :: close() }}


	@include('admin.includes.addButton', ['text' => 'Block', 'url' => route('moduleBlockAdd', array($module -> id, $moduleStep -> id))])


	<div>
		@foreach($moduleBlocks as $data)
			@include('admin.includes.horizontalEditDeleteBlock', [
				'title' => $data -> db_column,
				'editLink' => route('moduleBlockEdit', array($module -> id, $moduleStep -> id, $data -> id)),
				'deleteLink' => route('moduleBlockDelete', array($module -> id, $moduleStep -> id, $data -> id))
			])
		@endforeach
    </div>
@endsection