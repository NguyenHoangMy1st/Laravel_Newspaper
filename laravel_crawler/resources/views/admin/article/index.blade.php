@extends('admin.layouts.app_admin_master')
@section('content')
    <main role="main" class="container-fluid">
        <h1>Bài viết 
            <a href="{{ route('get_admin.article.create') }}" class="btn btn-sm btn-primary">Thêm bài viết mới</a></h1>
        <form action="" class="form-inline mb-3">
            <input type="text" name="n" class="form-control" placeholder="Tên bài viết" value="{{ Request::get('n') }}">
            <button type="submit" class="btn btn-primary ml-3">Lọc</button>
        </form>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th style="width: 50%">SEO</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($articles as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>
                        <div class="existed-seo-meta">
                        <a href="{{ route('get_blog.render',['slug' => $item->a_slug.'-a']) }}" target="_blank">
                            <span class="page-title-seo title_seo">{{ $item->a_name }}</span>
</a>
                            <div class="page-url-seo ws-nm">
                                <p><span class="slug">{{ $item->a_slug }}</span></p>
                            </div>
                            <div class="ws-nm">
                                <span style="color: #70757a;">{{ $item->created_at }} - </span>
                                <span class="page-description-seo description_seo">{{ $item->a_description }}</span>
                            </div>
                        </div>
                    </td>
                    
                    <td>{{ $item->created_at }}</td>
                    <td>
                        
                        <a href="{{ route('get_admin.article.delete', $item->id) }}" class="btn btn-sm js-delete btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @empty
                <p>Dữ liệu chưa cập nhật</p>
            @endforelse
            </tbody>
        </table>
        <div>
            {!! $articles->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </main>
@stop
