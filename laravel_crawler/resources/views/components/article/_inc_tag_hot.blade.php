<div class="box-hot-post">
    <div class="box-title">
        <h2>{{ $title }}</h2>
        <div class="line"></div>
    </div>
    <div class="list-hot-tags">
        @foreach($tags as $item)
            <a href="{{ route('get_blog.render',['slug' => $item->t_slug.'-t']) }}"
               class="btn btn-sm" title="{{ $item->t_name }}">{{ $item->t_name }}</a>
        @endforeach
    </div>
</div>
