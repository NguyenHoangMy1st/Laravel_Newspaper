<form class="form-horizontal" enctype="multipart/form-data"
      autocomplete="off" method="POST" action="">
    @csrf
    <style>
        .tab-content .tab-pane {
            display: none;
        }

        .tab-content .tab-pane.active {
            display: block;
        }
    </style>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Thông tin cơ bản</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Nội dung bài viết</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content mt-2">
        <div class="row">
            <div class="col-sm-8">
                <div id="home" class="tab-pane active"><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Name <span>(*)</span></label>
                        <input type="text" class="form-control keypress-count"
                               value="{{ old('a_name',$article->a_name ?? '') }}"
                               data-title-seo=".title_seo" data-slug=".slug" name="a_name">
                        @if($errors->first('a_name'))
                            <span class="text-danger">{{ $errors->first('a_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Slug <span>(*)</span></label>
                        <input type="text" class="form-control slug" name="a_slug"
                               value="{{ old('c_slug',$article->a_slug ?? '') }}">
                        @if($errors->first('a_slug'))
                            <span class="text-danger">{{ $errors->first('a_slug') }}</span>
                        @endif
                    </div>

                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Menu <span>(*)</span></label>
                                <select class="form-control" name="a_menu_id" id="exampleFormControlSelect1">
                                    <option value="">__Chọn danh mục__</option>
                                    @foreach($menus as $menu)
                                        <option title="{{ $menu->m_name }}"
                                                {{ ($article->a_menu_id ?? 0) == $menu->id ? "selected" : "" }} value="{{ $menu->id }}">{{ $menu->m_name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->first('a_menu_id'))
                                    <span class="text-danger">{{ $errors->first('a_menu_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Description <span>(*)</span></label>
                        <textarea name="a_description" class="form-control" id="" cols="30"
                                  rows="3">{{ old('a_description',$article->a_description ?? '') }}</textarea>
                        @if($errors->first('a_description'))
                            <span class="text-danger">{{ $errors->first('a_description') }}</span>
                        @endif
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="form-group">
                        <textarea name="a_content" class="form-control" id="content" cols="30"
                                  rows="5">{{ old('a_content',$article->a_content ?? '') }}</textarea>
                        @if($errors->first('a_content'))
                            <span class="text-danger">{{ $errors->first('a_content') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card  box-shadow-0 ">
                    <div class="card-body pt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Action <span>(*)</span></label>
                            <div>
                                <button class="btn btn-success"><i class="la la-check-circle"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="exampleFormControlSelect1">Nổi bật</label>
                    <select name="a_hot" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" {{ ($article->a_hot  ?? 0) == 0 ? "selected" : "" }}> Mặc định</option>
                        <option value="1" {{ ($article->a_hot  ?? 1) == 1 ? "selected" : "" }}> Nổi bật</option>
                    </select>
                </div>
                
            </div>
        </div>
    </div>
</form>

@section('script')
@stop
