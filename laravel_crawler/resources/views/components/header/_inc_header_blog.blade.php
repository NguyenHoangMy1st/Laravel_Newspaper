<header class="header-v2" id="header-v2">
    <div class="container">
        <div class="flex-between">
            <div class="flex-center">
                <div class="logo">
                    <a href="/" title="">
                        <img src="{{ asset('images/logo.jpg') }}"
                             alt=""> </a> </div>
                <div class="page-title">
                    <a class="fs-14" href="" title="{{ $title ?? '' }}">{{ $title ?? '' }}</a>
                </div>
            </div>
            <div class="flex-center">
                <form action="{{ route('get.search') }}" class="flex" style="margin-right: 10px">
                    <input type="text" style="margin-right: 10px" name="k" value="{{ Request::get('k') }}" class="" placeholder="Tìm kiếm ">
                    <button type="submit" class="btn">Tìm kiếm</button>
                </form>
{{--                <div class="header-v2__link">--}}
{{--                    @foreach($menusGlobal as $item)--}}
{{--                    <a href="{{ route('get_blog.render',['slug' => $item->m_slug.'-m']) }}" class="header-v2__item fs-14"--}}
{{--                       style="position:relative" title="{{ $item->m_name }}">{{ $item->m_name }}</a>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
            </div>
        </div>

    </div>
</header>
