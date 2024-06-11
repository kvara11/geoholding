@extends('master')

@section('pageMetaTitle'){{ $activeCompany->title .' - '. $activeHome -> metaTitle }}@endsection
@section('pageMetaDescription'){{ $activeHome -> metaDescription }}@endsection
@section('pageMetaUrl'){{ $activeHome -> metaUrl }}@endsection

@section('content')
	<div class="">
		<div class="container p-2">
			<div class="row">
				<div class="col-lg-6 p-xl-5 d-flex align-items-center home__text_head">
					<div class="p-xl-5 pt-xl-0">
						<div class="p-xxl-5 text-sm-start text-center">
							<h1  class="home__title pb-4 ">{{ $activeHome->section1title }}</h1>
							<div class="home__head_text d-sm-block d-none">{!! $activeHome->section1text !!}</div>
							{{-- <button class="home__button 
											mt-4 
											border-0 
											p-2 
											px-3
											text-white 
											rounded
											d-sm-block 
											d-none">ღილაკი
							</button> --}}
						</div>
					</div>
				</div>

				<div class="col-lg-6 p-sm-5 p-0 pt-sm-0">
					<div class="p-xxl-5 pt-0">
						<div class="p-xl-5 p-2">
							@if (file_exists(public_path('storage/images/modules/companies/81/s1_' . $activeHome->id . '.jpg')))
								<div class="home__gradient">
									<img class="home__gradinet_div mb-2" src="{{ asset('storage/images/modules/companies/81/s1_' . $activeHome->id . '.jpg') }}" alt="{{ $activeHome->section1title }}">
								</div>							
							@endif

							<div class="home__head_text d-sm-none d-block py-2">{!! $activeHome->section1text !!}</div>
							<div class="d-sm-none 
										d-block
										d-flex
										justify-content-end">
								<button class="home__button
												border-0 
												p-2 
												px-3
												text-white 
												rounded
												mt-2">ღილაკიss
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="py-5 mb-5 container px-xxl-0 px-xl-5">
			<div class="row d-flex align-items-center home__partners px-xxl-0 px-xl-2">
				@if ($activeHome->partners->isNotEmpty())
					@foreach ($activeHome->partners as $item)
						<div class="col-lg-2 
									col-sm-3 
									col-6 
									py-3">
							@if (file_exists(public_path('storage/images/modules/companies/87/'.$item->id.'.png')))	
								@if (!empty($item->link))
									<a href="{{ $item->link }}" target="_blank">
								@endif
									<img src="{{ asset('storage/images/modules/companies/87/'.$item->id.'.png') }}" alt="{{ $item->title }}">
								@if (!empty($item->link))
									</a>
								@endif
							@endif
						</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="container pb-5 px-xxl-0 px-xl-5">
			<div class="p-2">
				<h2 class="p-2 d-md-none d-block">{{ $activeHome->section2title }}</h2>
			</div>

			<div class="row py-md-5 pt-5 px-xxl-0 px-xl-2">
				<div class="col-lg-6 mb-lg-0 mb-5 pb-md-5">
					<div class="home__about_us_box">
						@if (file_exists(public_path('storage/images/modules/companies/81/s2_' . $activeHome->id . '.jpg')))
							<div class="rounded-circle 
										home__about_us_img 
										d-block position-relative">
								<img class="rounded-circle" src="{{ asset('storage/images/modules/companies/81/s2_' . $activeHome->id . '.jpg') }}" alt="{{ $activeHome->section2title }}">
								
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

				<div class="col-lg-6 pe-sm-5 p-0">
					<div class="pe-sm-5 p-2">
						<h2 class="p-2 d-md-block d-none">{{ $activeHome->section2title }}</h2>
						<div class="p-2 home__about_us_text">{!! $activeHome->section2text !!}</div>
					</div>
				</div>
			</div>
		</div>

		<div class="home__banner_section my-md-5 py-md-5 py-0">
			<div class="container p-2 py-5">
				<div class="row px-xl-5">
					@if (!empty($activeHome->services))
						@foreach ($activeHome->services as $item)
							<div class="col-lg-3 col-sm-6 p-2">
								<div class="bg-white rounded-3 p-2 h-100 p-4">
									@if (file_exists(public_path('storage/images/modules/companies/82/' . $item->id . '.svg')))
										<img class="home__banner_icon p-2" src="{{ asset('storage/images/modules/companies/82/' . $item->id . '.svg') }}" alt="{{ $item->title }}">
									@endif
									<h1 class="p-2">{{ $item->title }}</h1>
									<div class="p-2">{!! $item->text !!}</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>

		<div class="container py-5 px-xxl-0 px-xl-5">
			<div class="p-2 pb-sm-5">
				<h2 class="p-2">{{ $activeHome->section3title }}</h2>
			</div>

			<div class="row">
				<div class="col-lg-6
							order-lg-1
							order-2">
					<div class="p-2 home__text_partner">{!! $activeHome->section3text !!}</div>
					<div class="p-2">
					<a href="{{ $brandsPage->fullUrl }}">
						<button class="home__button
									border-0 
									p-2 
									px-3
									text-white 
									rounded">{{ __('bsw.see_brands') }}
						</button>
					</a>
					</div>
				</div>

				<div class="col-lg-6 
							d-flex 
							justify-content-xl-end 
							justify-content-md-center
							justify-content-start
							home__partner_box
							pt-sm-0
							pt-4
							order-lg-2
							order-1
							position-relative">
					<div class="home__partner_shadow position-absolute"></div>

					<div class="position-relative h-100 w-75 p-2">
						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center 
									rounded-circle
									home__statistic
									position-absolute">
							<div class="home__statistic-circle home__statistic-circlef"></div>
							
							<div>
								<div>
									<h2 class="fw-bolder fs-1">243<span class="home__plus">+</span></h2>
								</div>

								<div>{{ __('bsw.brand_product') }}</div>
							</div>
						</div>
						
						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center
									rounded-circle
									home__statistic
									position-absolute">
							<div class="home__statistic-circle home__statistic-circles"></div>

							<div>
								<div>
									<h2 class="fw-bolder fs-1">14<span class="home__plus">+</span></h2>
								</div>

								<div>{{ __('bsw.partner') }}</div>
							</div>
						</div>

						<div class="text-center 
									d-flex 
									align-items-center 
									justify-content-center
									rounded-circle
									home__statistic
									position-absolute">
							<div class="home__statistic-circle home__statistic-circlet"></div>

							<div>
								<div>
									<h2 class="fw-bolder fs-1">128<span class="home__plus">+</span></h2>
								</div>

								<div>{{ __('bsw.delivery_location') }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="container py-lg-5 py-3 p-2">
			@if (!empty($activeHome->products))
					@foreach ($activeHome->products->images ?? [] as $index => $item)
						@if ($item)
							@php
								$imagePath = public_path('storage/images/modules/companies/84/' . $item->id . '.jpg');
							@endphp
							@if (file_exists($imagePath))
								@if ($index === 0)
									<!-- First photo goes into div1 -->
									<div class="row">
										<div class="col-lg-6 p-lg-5 order-lg-1 order-2">
											<img class="p-lg-5" src="{{ asset('storage/images/modules/companies/84/' . $item->id . '.jpg') }}" alt="{{ $item->title }}">
										</div>

										<div class="col-lg-6 p-2 pt-lg-5 order-lg-2 order-1">	
											<div class="pt-lg-5 pe-lg-5">
												<div class="pt-lg-5">
													<h1 class="pt-lg-5">{{ $activeHome->products->title }}</h1>
												</div>
												<div class="home__product_text pe-5">{!! $activeHome->products->text !!}</div>
											</div>
										</div>
									</div>
								@elseif ($index === 1)
									<!-- Second photo goes into div2 -->
									<div class="row">
										<div class="col-lg-6 p-2 p-lg-5">
											<img class="pt-0 p-lg-5" src="{{ asset('storage/images/modules/companies/84/' . $item->id . '.jpg') }}" alt="{{ $item->title }}">
										</div>
									@else
										<!-- Any other photos (if needed) -->
										<div class="col-lg-6 p-2 p-lg-5">
											<div class="position-relative">
												<img class="pt-0 p-lg-5 home__products_dif_img" src="{{ asset('storage/images/modules/companies/84/' . $item->id . '.jpg') }}" alt="{{ $item->title }}">
											</div>
										</div>
									</div>
								@endif
							@endif
						@endif
					@endforeach
				</div>
			@endif
		</div>

		<div class="container p-2 py-lg-5 px-xxl-0 px-xl-5">
			@if (!empty($activeHome->reason))
				<div class="py-4 p-sm-0 p-2">
					<h2 class="home__why_us_title p-2 pb-4 px-3">{{ $activeHome->reason->title }}</h2>
				</div>

				<div class="row p-sm-2">
					<div class="px-2">{!! $activeHome->reason->text !!}</div>
				</div>

				@php $id = 0; @endphp

				<div class="row p-sm-3 p-0 position-relative">
					{{-- <div class=" home__why_us_shadow position-absolute"></div>
					<div class=" home__why_us_shadow_small position-absolute"></div> --}}
					@foreach ($activeHome->reason->reasons as $item)
						<div class="col-md-6 p-0 py-lg-5 py-4 home__why_us p-0 pe-sm-5">
							<div class="home__about_us_number 
										d-flex 
										align-items-center 
										justify-content-center 
										rounded-circle">{{ ++$id }}</div>
							<h3 class="py-2 pt-3 home__about_us_box_title">{{ $item->title }}</h3>
							<div class="py-2 home__about_us_box_text pb-0">{!! $item->text !!}</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>

	</div>
@endsection