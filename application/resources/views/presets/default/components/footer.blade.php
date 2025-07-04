@php
$links = getContent('policy_pages.element');
$importantLinks = getContent('footer_important_links.element', false, null, true);
$companyLinks = getContent('footer_company_links.element', false, null, true);
$subscribe = getContent('subscribe.content', true);
$contact = getContent('contact_us.content',true);
$socialIcons = getContent('social_icon.element',false);
$user = auth()->user();
$pages = App\Models\Page::where('tempname',$activeTemplate)->get();
@endphp

<footer class="footer-area pt-120">
    <div class="container">
        <div class="row justify-content-center g-5">
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <div class="footer-item__logo">
                        <a href="{{route('home')}}">
                            <img src="{{ getImage(getFilePath('logoIcon').'/logo.png', '?'.time()) }}" alt="{{config('app.name')}}">
                        </a>
                    </div>
                    <p class="footer-item__desc">
                        @if (strlen(__(@$contact->data_values->short_details)) >90)
                        {{ substr(__(@$contact->data_values->short_details), 0, 90) . '...' }}
                        @else
                        {{__(@$contact->data_values->short_details) }}
                        @endif
                    </p>
                    <ul class="social-list mt-3">
                        @foreach($socialIcons as $item)
                        <li class="social-list__item"><a href="{{$item->data_values->url}}" class="social-list__link">@php echo $item->data_values->social_icon; @endphp</a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Important Links')</h5>
                    <ul class="footer-menu">
                        @foreach($importantLinks as $key=>$item)
                            <li class="footer-menu__item"><a href="{{url('/').$item->data_values->url}}" class="footer-menu__link">{{__(@$item->data_values->title)}} </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Company Links')</h5>
                    <ul class="footer-menu">
                        @foreach($companyLinks as $key=>$item)
                        <li class="footer-menu__item"><a href="{{url('/').$item->data_values->url}}" class="footer-menu__link">{{__(@$item->data_values->title)}} </a></li>
                        @endforeach
                        @foreach($links as $link)
                        <li class="footer-menu__item"><a href="{{ route('policy.pages', [slug($link->data_values->title), $link->id]) }}" class="footer-menu__link">{{__(@$link->data_values->title)}}</a></li>
                        @endforeach
                        <li class="footer-menu__item"><a href="{{url('/cookie-policy')}}" class="footer-menu__link">@lang('Cookie Policy')</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Address')</h5>
                    <ul class="footer-menu">
                        <li class="footer-menu__item"><a href="tel:{{$contact->data_values->contact_number}}">{{@$contact->data_values->contact_number}}</a></li>
                        <li class="footer-menu__item"><a href="mailto:{{$contact->data_values->email_address}}">{{@$contact->data_values->email_address}}</a></li>
                        <li class="footer-menu__item">
                            {{__(@$contact->data_values->contact_details)}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h5 class="footer-item__title">@lang('Newsletter')</h5>
                    <p class="mb-2">@lang('Subscribe our latest update')</p>
                    <form action="{{route('subscribe')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form--control" name="email" placeholder="@lang('Email')">
                            <button type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        @php echo $contact->data_values->website_footer; @endphp
    </div>
</footer>
