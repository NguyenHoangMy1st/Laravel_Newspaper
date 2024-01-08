<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    {!! SEO::generate() !!}
    @yield('css')
    <style>
    .header-v2 {
        border-bottom: 2px solid #f1e8e8f5;
        box-shadow: 5px 5px 20px #aaaaaaa1;
        background: #70809085;
    }
    .header-v2 .logo {
    padding: 4px;
    }
    .header-v2 .logo img {
    width: 200px;
    height: 70px;
    }
    
    .lists-post .post-list{
        width: 100%;
        padding: 30px;
        display:flex;
        flex-direction: column;
        border: 2px solid red;
        background: #f5deb361;
        margin-bottom: 30px;
        box-shadow: 5px 5px 20px #aaaaaaa1;
    }
    .lists-post .post-list:hover{
        border: 2px solid blue;
        transition: all 0.25s ease-in-out;
    }
    .lists-post .post-list_title a{
        color:#d90404;
    }
    .lists-post .post-list_title a:hover {
        color:green;
    }
    .lists-post .post-list_image{
        flex: 0 0 0;
    }
    .box-hot-post {
        padding: 25px;
        display:flex;
        flex-direction: column;
        border: 1.5px solid black;
        background: #d1d1d133;
        margin-bottom: 30px;
        margin-top: 69px;
        box-shadow: 5px 5px 20px #aaaaaaa1;
    }
    .text-primary {
    color: red!important;
    }
    footer{
        border-top: 2px solid #f1e8e8f5;
        background: #70809085;
    }
    

    </style>
</head>
<body>
@if(\Request::segment(1) == 'bai-viet')
    @include('components.header._inc_header_blog')
@else
    @include('components._inc_header')
@endif
@yield('content')
@include('components._inc_footer')
@yield('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
