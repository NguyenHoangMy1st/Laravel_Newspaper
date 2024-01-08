@extends('layouts.app_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@stop
@section('content')
    <section>
        <div class="container">
            <div class="box-content">
                <div class="box-left">
                    <div class="section-title flex justify-between align-center">
                        <h1>Bài viết mới nhất</h1>
                    </div>
                    <div class="lists-post">
                        @foreach($articles ?? [] as $item)
                            <div class="post-list">
                                <div class="post-list_content">
                                    @if(isset($item->menu))
                                    <div class="post-list_category">
                                        <a href="{{ route('get_blog.render',['slug' => $item->menu->m_slug.'-m']) }}" title="">{{ $item->menu->m_name }} </a>
                                    </div>
                                    @endif
                                    <h3 class="post-list_title">
                                        <a href="{{ route('get_blog.render',['slug' => $item->a_slug.'-a']) }}"
                                           title="{{ $item->a_name }}">
                                            {{ $item->a_name }}</a>
                                    </h3>
                                    <h4 class="post-list_desc">{{ $item->a_description }}</h4>
                                    <div class="post-list_time">
                                        <span>{{ $item->created_at }} - {{ $item->a_view }} lượt xem</span>
                                    </div>
                                </div>
                                <a href="{{ route('get_blog.render',['slug' => $item->a_slug.'-a']) }}"
                                   class="post-list_image" title="{{ $item->a_name }}">
                                    <!-- <img class=""
                                         src="{{ pare_url_file($item->a_avatar) }}"
                                         alt="{{ $item->a_name }}" > </a> -->
                            </div>
                        @endforeach
                        {!! $articles->appends($query ?? [])->links('vendor.pagination.default') !!}
                    </div>
                </div>
                <div class="box-right">
                    <!-- <div class="seo-page">
                        <h1 class="seo-page_title">{{ $title ?? "" }}</h1>
                        <h4 class="seo-page_desc">{{ $description ?? "" }}</h4>
                    </div> -->
                    <div class="box-hot-post">
                        <div class="box-title">
                            <h2>Danh mục</h2>
                            <div class="line"></div>
                        </div>
                        <div class="list-hot-tags">
                            @foreach($menusGlobal ?? [] as $item)
                                <a href="{{ route('get_blog.render',['slug' => $item->m_slug.'-m']) }}"
                                   class="btn btn-sm" title="{{ $item->m_name }}">{{ $item->m_name }}</a>
                            @endforeach
                        </div>
                    </div>

                    @include('components.article._inc_article_hot',['articles' => $articlesHot ?? [],'title' => 'Bài viết nổi bật'])
                    
                </div>
            </div>
        </div>
    </section>

@stop
@section('js')
    <script src="{{ asset('js/blog.js') }}"></script>
@stop
