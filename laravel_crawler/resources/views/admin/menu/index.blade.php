@extends('admin.layouts.app_admin_master')
@section('content')
    <main role="main" class="container-fluid">
        <h1> Menu bài viết <a href="{{ route('get_admin.menu.create') }}" class="btn btn-sm btn-primary">Thêm mới</a></h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th style="width: 40%">SEO</th>
                <th>Status</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($menus as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->m_name }}</td>
                    <td>
                        <div class="existed-seo-meta">
                                                <span class="page-title-seo title_seo">
                                                    <a href="{{ route('get_blog.render', ['slug' => $item->m_slug.'-m']) }}" target="_blank">{{ $item->m_title_seo }}</a>
                                                </span>
                            <div class="page-url-seo ws-nm">
                                <p><span class="slug">{{ $item->m_slug }}</span></p>
                            </div>
                            <div class="ws-nm">
                                <span style="color: #70757a;">{{ $item->created_at }} - </span>
                                <span class="page-description-seo description_seo">{{ $item->m_description_seo }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $item->getStatus($item->m_status)['class']  }}">{{ $item->getStatus($item->m_status)['name']  }}</span>
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ route('get_admin.menu.update', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('get_admin.menu.delete', $item->id) }}" class="btn btn-sm js-delete btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @empty

            @endforelse
            </tbody>
        </table>
        <div>
            {!! $menus->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </main>
@stop
