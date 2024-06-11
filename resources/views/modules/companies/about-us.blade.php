@extends('master')

@section('pageMetaTitle'){{ $activeCompany->title .' - '. $activeAbout -> metaTitle }}@endsection
@section('pageMetaDescription'){{ $activeAbout -> metaDescription }}@endsection
@section('pageMetaUrl'){{ $activeAbout -> metaUrl }}@endsection

@section('content')
	<div>
		<div class="row text-center py-md-5">
			<h1>{{ $activeAbout->title }}</h1>
		</div>

		<div class="container pb-5 px-xxl-0 px-xl-5">
			<div class="row py-5">
				<div class="col-md-6 d-flex align-items-center order-md-1 order-2">
					<div class="row">
						<div class="col-md-11">
							<div class="pe-md-5 home__head_text pb-4">{!! $activeAbout->section1text !!}</div>
							<a href="{{ $contactPage->fullUrl }}">
								<button class="about_us__contact border-0 py-2 p-4">{{ __('bsw.contact_us') }}</button>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-6 
							py-5 
							d-flex 
							align-items-center 
							justify-content-xxl-end 
							justify-content-center 
							pe-xxl-5
							order-md-2
							order-1">
					@if (file_exists(public_path('storage/images/modules/companies/80/' . $activeAbout->id . '.jpg')))	
						<div class="rounded-circle 
									home__about_us_img 
									d-block position-relative">
							<img class="rounded-circle" src="{{ asset('storage/images/modules/companies/80/' . $activeAbout->id . '.jpg') }}" alt="{{ $activeAbout->title }}">
							
							<div class="home__about_us_mini_circle 
										position-absolute 
										w-100 
										h-100 
										top-0 
										rounded-circle"></div>
						</div>
					@endif 
				</div>
			</div>
		</div>

		<div class="about_us__our_goal py-md-5 p-2">
			<div class="container text-center py-5 px-xxl-0 px-xl-5">
				<h2 class="py-2">{{ $activeAbout->section2title }}</h2>
				<div class="p-2 about_us__text">{!! $activeAbout->section2text !!}</div>
			</div>
		</div>
		
		<div class="container py-md-5 px-xxl-0 px-xl-5">
			<div class="row py-md-5">
				<div class="col-md-6 
							d-flex 
							justify-content-start
							home__partner_box
							pt-sm-0
							pt-4">
					<div class="position-relative h-100 w-75 p-2">
						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center 
									rounded-circle
									home__statistic
									position-absolute">
							<div>
								<div>
									<h2 class="fw-bolder fs-1">243<span class="home__plus">+</span></h2>
								</div>

								<div>ბრენდის პროდუქტი</div>
							</div>
						</div>
						
						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center
									rounded-circle
									home__statistic
									position-absolute">
							<div>
								<div>
									<h2 class="fw-bolder fs-1">14<span class="home__plus">+</span></h2>
								</div>

								<div>პარტნიორი</div>
							</div>
						</div>

						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center
									rounded-circle
									home__statistic
									position-absolute">
							<div>
								<div>
									<h2 class="fw-bolder fs-1">128<span class="home__plus">+</span></h2>
								</div>

								<div>მიწოდების ლოკაცია</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<h2 class="p-2">{{ $activeAbout->section3title }}</h2>
					<div class="home__text_partner p-2">{!! $activeAbout->section3text !!}</div>
				</div>
			</div>
		</div>
	</div>
@endsection