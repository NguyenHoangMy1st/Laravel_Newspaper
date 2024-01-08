<div class="box-hot-post">
    <div class="box-title">
        <h2>{{ $title }}</h2>
        <div class="line"></div>
    </div>
    <div class="list-hot-post">
        @foreach($articles ?? [] as $item)
            <div class="hot-post">
                <div class="hot-post_content">
                    <div class="hot-post_title">
                        <a href="{{ route('get_blog.render',['slug' => $item->a_slug.'-a']) }}" title="{{ $item->a_name }}">{{ $item->a_name }}</a> </div>
                    <div class="hot-post_time"> <span>{{ $item->created_at }} - {{ $item->a_view }} lượt xem</span> </div>
                </div>
                <div class="hot-post_image">
                    <a href="{{ route('get_blog.render',['slug' => $item->a_slug.'-a']) }}"
                       title="{{ $item->a_name }}"> <img class="" src="{{ pare_url_file($item->a_avatar) }}"
                                                         alt="{{ $item->a_name }}"
                                                         width="100%" data-was-processed="true"> </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
