<div class="main">
	<div class="main__wrapper">
		@foreach ($companies as $item)
			<div class="main__box">
				<a href="{{ $item->fullUrl }}">
					@if (file_exists(public_path('storage/images/modules/companies/79/' . $item->id . '.jpg')))
						<img class="bg_image" src="{{ asset('storage/images/modules/companies/79/' . $item->id . '.jpg') }}" alt="{{ $item->title }}">
					@endif
				
					<div class="main__mini_info">
						@if (file_exists(public_path('storage/images/modules/companies/79/' . $item->id . '.svg')))
							<img class="w-25" src="{{ asset('storage/images/modules/companies/79/' . $item->id . '.svg') }}" alt="{{ $item->title }}">
						@endif
						<h1 class="main__company_name">{{ $item->title }}</h1>
					</div>
				</a>
			</div>
		@endforeach
	</div>
</div>

<script>
	var linkElement = document.createElement('link');

	linkElement.rel = 'shortcut icon';
	linkElement.href = "{{ asset('/storage/images/geo_holding.svg') }}";

	var headElement = document.head || document.getElementsByTagName('head')[0];

	headElement.appendChild(linkElement);
	console.log(headElement)
</script>

<style>
	.main{
		background-color:#5EC5F1;
	}

	.main__wrapper{
		font-family:'firago';
	}

	.bg_image{
		width:100%;
		height:100%;
	}
	
	*{
		box-sizing:border-box;
		margin:0;
		padding:0;
	}

	.main__company_name{
		color:#fff;
		padding-top:20px;
	}

	.main__box{
		position:relative;
		display:flex;
		align-items:center;
		justify-content:center;
		flex:1;
	}

	.main__box a{
		width:100%;
		height:100%;
	}

	.main__mini_info{
		position: absolute;
		text-align:center;
		top:50%;
		left:50%;
		transform:translate(-50%, -50%)
	}

	@font-face {
        font-family: 'firago';
        font-style: normal;
        font-weight: 400;
        src: url('/storage/fonts/FiraGO-Regular.woff');
    }

	.main{
		height:100%;
	}

@media only screen and (max-width: 576px) {
    .main__wrapper {
		display:block;
		width:100%;
	}

	.main__box{
		height:33.3333333%;
	}
}


@media only screen and (min-width: 576px) {
    .main__wrapper {
		display:block;
		width:100%;
	}

	.main__box{
		height:33.3333333%;
	}
}


@media only screen and (min-width: 768px) {
    .main__wrapper {
		display:block;
		width:100%;
	}

	.main__box{
		height:33.3333333%;
	}
}


@media only screen and (min-width: 1100px) {
    .main__wrapper {
		display:flex;
		width:100%;
	}

	.main__box{
		height:100%;
	}
}


@media only screen and (min-width: 1400px) {
    .main__wrapper {
		display:flex;
		width:100%;
	}

	.main__box{
		height:100%;
	}
}


@media only screen and (min-width: 1700px) {
	.main__wrapper {
		display:flex;
		width:100%;
		height:100% !important;
	}

	.main__box{
		height:100%;
	}
}


</style>