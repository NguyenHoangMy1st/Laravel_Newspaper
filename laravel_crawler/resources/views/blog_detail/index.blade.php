@extends('layouts.app_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@stop
@section('content')
    <section>
        <div class="container">
            <div class="box-content">
                <div class="box-left">
                    <div class="breadcrumb">
                        <ul class="breadcrumb-menu" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            @if(isset($article->menu))
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a href="{{ route('get_blog.render',['slug' => $article->menu->m_slug.'-m']) }}" title="{{ $article->menu->m_name }}" itemprop="item">
                                    <span itemprop="name">{{ $article->menu->m_name }}</span>
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                            @endif
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a href="" itemprop="item">
                                    <span itemprop="name" style="color: #666;font-size: 13px;">{{ $article->a_name }}</span>
                                    <meta itemprop="position" content="2">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="post-detail">
                        <div class="post-detail_top">
                            <div class="post-detail_info">
                                <h1 class="post-detail_info__title">{{ $article->a_name }}</h1>
                                <div class="post-detail_info_author">
                                    <div>
                                        @if(isset($article->menu))
                                        {{ $article->menu->m_name }} : <a href="{{ route('get_blog.render',['slug' => $article->menu->m_slug.'-m']) }}"
                                                                          title="{{ $article->menu->m_name }} "> {{ $article->menu->m_name }}  </a> -
                                        @endif
                                        - {{ $article->created_at }}
                                    </div>
                                    <div> {{ $article->a_view }} lượt xem </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-detail__content">
                            <div class="main-content" id="blog-detail">
                                <p class="semi-bold"> {{ $article->a_description }}</p>
                                {!! $article->a_content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-right">
                    @include('components.article._inc_article_hot',['articles' => $articlesHot ?? [],'title' => 'Bài viết nổi bật'])
                </div>
            </div>
        </div>
    </section>

@stop
@section('js')
    <script src="{{ asset('js/blog.js') }}"></script>
@stop
