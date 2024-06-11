@if($widgetGetVisibility['footer'])
    <footer class="footer @switch(config('activeCompany')->const) 
        @case('ice-land')footer-ice @break @case('bd-comp')footer-comp @break @case('bd-plus')footer-plus @break @default @endswitch">
        <div class="container 
                    py-sm-5 
                    pt-3 
                    pb-5 
                    px-xxl-0 
                    px-xl-5 
                    px-sm-3">
            <div class="row px-xxl-0 px-xl-2">
                <div class="col-lg-3
                            col-sm-6
                            col-12
                            py-sm-4
                            d-sm-block
                            d-flex
                            flex-column
                            align-items-center">
                    <div class="mb-sm-4 mb-md-5" >
                        @switch(config('activeCompany')->const)
                                @case('ice-land')
                                    <img  class="w-auto" src="{{ asset('/storage/images/logo.svg') }}">
                                @break

                                @case('bd-comp')
                                    <img  class="w-auto" src="{{ asset('/storage/images/logo_comp.svg') }}">
                                @break

                                @case('bd-plus')
                                    <img  class="w-auto" src="{{ asset('/storage/images/logo_plus.svg') }}">
                                @break
                            @default
                        @endswitch
                    </div>

                    <div class="d-sm-flex d-none gap-2">
                        <div>
                            <a href="{{ $contacts->facebook_link }}"
                                target="_blank"
                                class="ba_fb
                                        footer__media_icon
                                        footer__media_icon--fb

                                        rounded"></a>
                        </div>
                        
                        <div>
                            <a href="{{ $contacts->instagram_link }}"
                                target="_blank"
                                class="ba_inst
                                        footer__media_icon
                                        footer__media_icon--instagram

                                        rounded"></a>
                        </div>

                        <div>
                            <a href="{{ $contacts->linkedin_link }}"
                                target="_blank"
                                class="ba_in
                                        footer__media_icon
                                        footer__media_icon--linkedin

                                        rounded"></a>
                        </div>
                    </div>
                </div>

                <div class="footer__horizontal_line d-sm-none my-3"></div>

                <div class="col-lg-3
                            col-sm-6
                            col-12
                            py-4">
                    <h3 class="mb-4 d-none d-sm-block">{{ __('bsw.companies') }}</h3>

                    <div class="d-flex
                                flex-wrap
                                flex-sm-column
                                justify-content-center
                                gap-3
                                footer__companies">
                        @if ($companies->isNotEmpty())
                            @foreach ($companies as $company)
                                <div>
                                    <a href="{{ $company->fullUrl }}" class=" py-2">{{ $company->title }}</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 
                            col-sm-6 
                            col-12
                            py-4">
                    <h3 class="mb-4 d-none d-sm-block">{{ __('bsw.menu') }}</h3>
                    <div class="d-flex
                                flex-sm-column
                                flex-wrap
                                justify-content-center
                                gap-3">
                        @foreach($menuButtons as $data)
                            <div class="nav-item
                                        menu_buttons__item
                                        position-relative
                                        js_menu_buttons__item">
                                @php
                                    $activeCssClass = '';
    
                                    if($data -> active) {
                                        $activeCssClass = 'menu_buttons__active_item_block';
                                    }
                                @endphp
                                
                                <div class="d-block
                                            {{ $activeCssClass }}"> 
                                    @if($data -> url)
                                        <a href="{{ $data -> url }}" target="{{ $data -> urlTarget }}">
                                    @endif
    
                                    <span>
                                        {{ $data -> title }}
                                    </span>
                                    
                                    @if($data -> url)
                                        </a>
                                    @endif
    
                                    @if(count($data -> menuButtonStep1))
                                        <div class="js_arrow_div
                                                    d-inline-block
                                                    menu_buttons__arrow_block">
                                            <span class="ba_thin_arrow_right"></span>
                                        </div>
                                    @endif
                                </div>
                                
                                @if(count($data -> menuButtonStep1))
                                    <div class="menu_buttons__slide_down_block mt-3">
                                        @foreach($data -> menuButtonStep1 as $dataInside)
                                            @php
                                                $activeCssClass = '';
    
                                                if($dataInside -> active) {
                                                    $activeCssClass = 'menu_buttons__sub_menu_item--active';
                                                }
                                            @endphp
                                            
                                            <div class="menu_buttons__sub_menu_item {{ $activeCssClass }}">
                                                @if($dataInside -> url)
                                                    <a href="{{ $dataInside -> url }}" target="{{ $dataInside -> urlTarget }}">
                                                        <span>
                                                            {{ $dataInside -> title }}
                                                        </span>
                                                    </a>
                                                @else
                                                    <span>
                                                        {{ $dataInside -> title }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
    
    
                                    <div class="menu_buttons__slide_down_block_in_burger mt-1">
                                        @foreach($data -> menuButtonStep1 as $dataInside)
                                            @php
                                                $activeCssClass = '';
    
                                                if($dataInside -> active) {
                                                    $activeCssClass = 'menu_buttons__sub_menu_item--active';
                                                }
                                            @endphp
                                            
                                            <div class="menu_buttons__sub_menu_item {{ $activeCssClass }}">
                                                @if($dataInside -> url)
                                                    <a href="{{ $dataInside -> url }}" target="{{ $dataInside -> urlTarget }}">
                                                        <span>
                                                            {{ $dataInside -> title }}
                                                        </span>
                                                    </a>
                                                @else
                                                    <span>
                                                        {{ $dataInside -> title }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-3
                            col-sm-6
                            col-12
                            py-4
                            d-sm-block
                            d-flex
                            flex-column
                            align-items-center">
                    <h3 class="mb-4  d-sm-block d-none">{{ __('bsw.contacts') }}</h3>

                    <div class="d-flex
                                flex-sm-column
                                flex-wrap
                                justify-content-center
                                gap-3
                                footer__contact_info">
                        
                        <div>
                            <a href="mailto:{{ $contacts->email }}">{{ $contacts->email }}</a>
                        </div>

                        <div>
                            <a href="tel:{{ $contacts->phone_number }}">{{ $contacts->phone_number }}</a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="d-sm-none pt-4">
                <div class="d-flex
                            justify-content-center
                            gap-2">
                    <div>
                        <a href="{{ config('bsc.facebook_link') }}"
                            target="_blank"
                            class="ba_fb
                                    footer__media_icon
                                    footer__media_icon--fb
                                    rounded"></a>
                    </div>
                    
                    <div>
                        <a href="{{ config('bsc.instagram_link') }}"
                            target="_blank"
                            class="ba_inst
                                    footer__media_icon
                                    footer__media_icon--instagram
                                    rounded"></a>
                    </div>
                    
                    <div>
                        <a href="{{ config('bsc.twitter_link') }}"
                            target="_blank"
                            class="ba_tw
                                    footer__media_icon
                                    footer__media_icon--twitter
                                    rounded"></a>
                    </div>

                    <div>
                        <a href="#"
                            target="_blank"
                            class="ba_in
                                    footer__media_icon
                                    footer__media_icon--linkedin
                                    rounded"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__horizontal_line d-sm-block d-none"></div>

        <div class="container 
                    p-2 
                    d-sm-block 
                    d-none 
                    px-xxl-0 
                    px-xl-5">
            <div class="row">
                <div class="col-lg-8
                            col-12
                            p-2
                            text-lg-start
                            text-center">
                    {{--  {{ config('constants.year_of_site_creation') }}  --}}
                    © {{ __('bsw.copyright') }} 
                </div>

                <div class="col-lg-4
                            col-12
                            p-2
                            text-lg-end
                            text-center">
                    Created by <a href="http://hobbystudio.ge/" target="_blank" class="text-secondary">HobbyStudio</a>
                </div>
            </div>
        </div>

        <a href="/admin" target="_blank">
            <div class="footer__admin_button"></div>
        </a>
    </footer>
@endif