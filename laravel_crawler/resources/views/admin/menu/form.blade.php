<form class="form-horizontal" autocomplete="off" method="POST" action="">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card  box-shadow-0">
                <div class="card-body pt-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Name <span>(*)</span></label>
                        <input type="text" class="form-control keypress-count" data-title-seo=".title_seo" value="{{ old('c_name', $menu->m_name ?? '') }}" data-slug=".slug" name="m_name" >
                        @if($errors->first('m_name'))
                            <span class="text-danger">{{ $errors->first('m_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Slug <span>(*)</span></label>
                        <input type="text"  class="form-control slug"   name="m_slug" value="{{ old('c_slug', $menu->m_slug ?? '') }}">
                        @if($errors->first('m_slug'))
                            <span class="text-danger">{{ $errors->first('m_slug') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="required">Description <span>(*)</span></label>
                        <textarea name="m_description" class="form-control" id="" cols="30" rows="3">{{ $menu->m_description ?? '' }}</textarea>
                        @if($errors->first('m_description'))
                            <span class="text-danger">{{ $errors->first('m_description') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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

           
        </div>
    </div>
</form>
