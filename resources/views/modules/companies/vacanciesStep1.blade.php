@extends('master')

@section('pageMetaTitle'){{ $activeCompany->title .' - '. $active -> metaTitle }}@endsection
@section('pageMetaDescription'){{ $active -> metaDescription }}@endsection
@section('pageMetaUrl'){{ $active -> metaUrl }}@endsection

@section('content')
<div class="container d-flex flex-column">
	<div class="row">
		@isset($active)
		<div class="col-11 
					border 
					rounded-5 
					vacancies_step1__header_wrapper 
					p-0 
					vacancies_step1__box_shadow
					m-auto">
			<div class="row vacancies__list_bottom p-2">
				<span class="col-lg-3 col-sm-6">{{ __('bsw.position_name') }}:</span>
				<span class="col-lg-7 col-sm-6">{{ $active->title }}</span>
			</div>
			<div class="row vacancies__list_bottom p-2">
				<span class="col-lg-3 col-sm-6">{{ __('bsw.last_date') }} / {{ __('bsw.published') }}:</span>
				<span class="col-lg-7 col-sm-6">{{ date("d.m.Y", strtotime($active->last_date)) }} / {{ date_format($active->created_at,"d.m.Y") }}</span>
			</div>
			<div class="row vacancies__list_bottom p-2">
				<span class="col-lg-3 col-sm-6">{{ __('bsw.location') }}:</span>
				<span class="col-lg-7 col-sm-6">{{ __($active->location) }}</span>
			</div>
			<div class="row p-2">
				<span class="col-lg-3 col-sm-6">{{ __('bsw.send_resume') }}:</span>
				<span class="col-lg-7 col-sm-6">{{ $hr_email->hr_email }}</span>
			</div>
		</div>

		<div class="mt-4 col-11 m-auto">
			{!! $active->text !!}
		</div>
		@endisset
	</div>
</div>

@endsection