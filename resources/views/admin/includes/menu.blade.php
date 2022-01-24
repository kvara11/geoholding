<div class="menu">
	@foreach($modulesForMenu as $data)
		<style>
			.menu__link {
				transition: 0.2s all ease-in-out;
				background-color: transparent;
			}

			.menu__link--{{$data -> alias}} {
				border: 1px solid {{ $data -> icon_bg_color }};
				border-left-width: 7px;
				border-top: none;
				border-right: none;
			}

			.menu__link--{{$data -> alias}} svg {
				width: 100%;
			}

			.menu__link--{{$data -> alias}} svg *{
				fill: {{ $data -> icon_bg_color }};
			}

			.menu__link--{{$data -> alias}}:hover svg * {
				fill: #fff;
			}

			.menu__link--{{$data -> alias}}:hover {
				background-color: {{ $data -> icon_bg_color }};
				color: #fff;
			}

			.menu__link--{{$data -> alias}}_active {
				background-color: {{ $data -> icon_bg_color }};
				border: 1px solid {{ $data -> icon_bg_color }};
				border-left-width: 7px;
				color: #fff;
			}	
		</style>

		@if(isset($module) && $module -> alias === $data -> alias)
			<a href="/admin/{{ $data -> alias }}">
				<div class="row align-items-center p-2 menu__link--{{$data -> alias}}_active">
					<div class="col-3 p-2">
						<img src="{{ asset('/storage/images/modules/modules/'.$data -> id.'_icon.svg') }}" alt="menu_icon" width="30" height="30" class="svg_img">
					</div>

					<div class="col-9 p-2">
						<span>{{ $data -> title }}</span>
					</div>
				</div>
			</a>
		@else
			<a href="/admin/{{ $data -> alias }}">
				<div class="row align-items-center p-2 menu__link menu__link--{{ $data -> alias }}">
					<div class="col-3 p-2">
						<img src="{{ asset('/storage/images/modules/modules/'.$data -> id.'_icon.svg') }}" alt="menu_icon" width="30" height="30" class="svg_img">
					</div>

					<div class="col-9 p-2">
						<span>{{ $data -> title }}</span>
					</div>
				</div>
			</a>
		@endif
	@endforeach

	<div class="p-3"></div>

	<div class="p-2">
		<a href="/admin/modules">
			<div class="d-flex align-items-center px-2">
				<div class="p-2">
					<span>Modules</span>
				</div>
			</div>
		</a>

		<a href="/admin/bsw">
			<div class="d-flex align-items-center px-2">
				<div class="p-2">
					<span>BSW</span>
				</div>
			</div>
		</a>

		<a href="/admin/bsc">
			<div class="d-flex align-items-center px-2">
				<div class="p-2">
					<span>BSC</span>
				</div>
			</div>
		</a>

		<a href="/admin/languages">
			<div class="d-flex align-items-center px-2">
				<div class="p-2">
					<span>Languages</span>
				</div>
			</div>
		</a>

		{{--<a href="{{ route('adminStartPoint') }}">
			<div class="d-flex align-items-center px-2">
				<div class="p-2">
					<span>Admins</span>
				</div>
			</div>
		</a>--}}
	</div>
</div>