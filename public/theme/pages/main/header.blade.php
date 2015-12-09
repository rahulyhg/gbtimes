    <!-- HEADER -->
    <div class="header">
        <div class="header-place">
            <div class="header-top">
                <ul>
                {!! get_nav_menu(get_pages(72),['route'=>'WelcomeController@showPage','list'=>[['url'=>'http://company.gbtimes.com/','name'=>'About Us']]]) !!}
                </ul>
            </div>
            <div class="header-bot">
                <div class="logo"><a href="/"></a></div>
                <div class="search-lang-login">
                    <div class="search">
                        <form method="post" name="search" action="">
                            <input type="text" name="s" value="Search..." onClick="inputPlaceholder(this,'Search...')"/>
                            <input type="submit" name="submit" class="hidden" id="search"/>
                            <a href="javascript:void('')" onClick="clickSubmit('search')"></a>
                        </form>
                    </div>
                    <div class="lang">
                        <form method="post" name="language" action="{{action('LanguageController@cookie')}}" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="hidden" name="locale" value="en"/>
                            <input type="submit" name="submit" class="hidden" id="lang"/>
                        </form>
                        <div class="active-language">
                            <?php $languages = get_languages();?>
                            <span>{{$languages[\App::getLocale()]}}</span>
                            <ul>
                                @foreach($languages as $key=>$lang)
                                    @if(\App::getLocale() <> $key)
                                        <li><a href="javascript:void('')" data-lang="{{$key}}" onClick="setLanguage($(this));clickSubmit('lang')">{{$lang}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <div class="rss">
                        <a target="_blank" href="{{action('WelcomeController@rss')}}"></a>
                    </div>
                    {{--<div class="login">--}}
                        {{--<a href="#">Log in</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>