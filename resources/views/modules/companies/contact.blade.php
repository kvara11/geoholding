@extends('master')

@section('pageMetaTitle'){{ $page -> metaTitle }}@endsection
@section('pageMetaDescription'){{ $page -> metaDescription }}@endsection
@section('pageMetaUrl'){{ $page -> metaUrl }}@endsection

@section('content')

<div class="d-flex flex-column align-items-center contact_page">
	<img class="position-absolute contact_page__bg_image h-75" src="{{ asset('storage/images/contact-bg.svg') }}"
		alt="contact-bg">

	<div class="row col-11 py-5">
		<div class="col-sm-9 mx-auto">
			<h1 class="mb-4">{{ $activeContact->title }}</h1>

			<div class="lh-lg col-12 col-lg-8">{!! $activeContact->text !!}</div>
		</div>
	</div>

	<div class="row col-10 col-xl-8 p-0 rounded contact_page__form_wrapper rounded overflow-hidden">
		<div class="col-12 col-lg-7 p-sm-5 contact_page__send_message_wrapper">
			{{ Form::open(array('route' => 'sendContact', 'method' => 'POST', 'id' => 'send_form', 'class' => 'row')) }}

			<h3 class="text-dark offset-md-1 p-2 mb-3">{{ __('bsw.send_us_msg') }}</h3>

			<div class="row gap-3 p-2">
				<label class="contact_page__input_wrapper contact_page__required overflow-hidden
					my-2 my-xl-0 border rounded-3 flex-grow-1 col-md-5 col-12">
					{{ Form::text('fullname', old('fullname'), array('required' => 'required', 'placeholder' =>
					__('bsw.your_name'),'class' => 'border border-0 p-0 w-100'))
					}}
				</label>

				<label
					class="contact_page__input_wrapper overflow-hidden my-2 my-xl-0 border rounded-3 flex-grow-1 col-md-5 col-12">
					{{ Form::text('company_name', old('company_name'), array('placeholder' => __('bsw.company_name'),
					'class' => 'border border-0 p-0 w-100')) }}
				</label>

			</div>

			<div class="row gap-3 p-2 ">
				<label
					class="contact_page__input_wrapper contact_page__required overflow-hidden my-2 my-xl-0 border rounded-3 flex-grow-1 col-md-5 col-12">
					{{ Form::email('email_address', old('email_address'), array('required' => 'required', 'placeholder'
					=>
					__('bsw.your_email'),'class' => 'border border-0 p-0 w-100')) }}
				</label>

				<label
					class="contact_page__input_wrapper contact_page__required overflow-hidden my-2 my-xl-0 border rounded-3 flex-grow-1 col-md-5 col-12">
					{{ Form::tel('phone_number', old('phone_number'), array('required' => 'required', 'placeholder' =>
					__('bsw.your_phone'), 'maxlength' => '15', 'class' => 'border border-0 p-0 w-100')) }}
				</label>

			</div>

			<div class="row col-12 ">
				{{ Form::textarea('message', old('message'), array('placeholder' => __('bsw.write_your_text'), 'class'
				=>
				'border p-2 rounded-3 col-12')) }}
			</div>

			<div class="col-12 
						d-flex 
						justify-content-between
						align-items-center">
				{{ Form::submit(__('bsw.send'), ['class' => 'contact_page__button border-0 text-white px-3 py-2 rounded-3']) }}

				@if(Session::has('contact-success'))
					<div class="alert alert-success m-0" role="alert">
						{{ Session::get('contact-success') }}
					</div>
				@endif

				@if(Session::has('contact-error'))
					<div class="alert bg-danger m-0" role="alert">
						{{ Session::get('contact-error') }}
					</div>
				@endif
			</div>

			{{ Form::hidden('active', config('activeCompany')->id) }}

			{{ Form::close() }}
		</div>

		<div class="col-12 col-lg-5 p-sm-5 p-2 contact_page__info_wrapper d-flex flex-column justify-content-around">
			<h3 class="p-2">{{ __('bsw.contact_info') }}</h3>

			<div class="d-flex flex-column py-2 gap-4">
				<div class="row align-items-center">
					<div class="col-2 col-sm-1 col-lg-2 col-xl-2">
						<img class="col-8 col-sm-11 col-md-8 col-lg-8 col-xl-9 p-0"
							src="{{ asset('storage/images/phone.svg') }}" alt="phone">
					</div>

					<div class="col">
						<a class="col ps-xl-3 text-white" href="tel:{{ $activeContact->phone_number }}">
							{{$activeContact->phone_number }}
						</a>
					</div>
				</div>

				<div class="row align-items-center">
					<div class="col-2 col-sm-1 col-lg-2 col-xl-2">
						<img class="col-8 col-sm-11 col-md-8 col-lg-8 col-xl-9 p-0"
							src="{{ asset('storage/images/mail.svg') }}" alt="mail">
					</div>

					<a class="col ps-xl-3 text-white" href="mailto:{{ $activeContact->email }}">{{ $activeContact->email }}</a>
				</div>

				<div class="row align-items-center">
					<div class="col-2 col-sm-1 col-lg-2 col-xl-2">
						<img class="col-8 col-sm-11 col-md-8 col-lg-8 col-xl-9 p-0"
							src="{{ asset('storage/images/point.svg') }}" alt="point">
					</div>

					<a class="col ps-xl-3 text-white" href="{{ $activeContact->address_link }}" target="_blank">{{
						$activeContact->address
						}}</a>
				</div>
			</div>

			<div class="d-flex gap-2 p-2 align-items-center">
				<a href="{{ $activeContact->facebook_link }}" target="_blank">
					<img src="{{ asset('storage/images/facebook.svg') }}" alt="facebook">
				</a>

				<a href="{{ $activeContact->instagram_link }}" target="_blank">
					<img src="{{ asset('storage/images/instagram.svg') }}" alt="instagram">
				</a>

				<a href="{{ $activeContact->linkedin_link }}" target="_blank">
					<img src="{{ asset('storage/images/linkedin.svg') }}" alt="linkedin">
				</a>
			</div>
		</div>
	</div>
</div>

@endsection