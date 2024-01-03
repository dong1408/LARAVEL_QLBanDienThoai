@extends('layouts.admin')

@section('integration_file_manage')
    <script type="text/javascript"
        src='https://cdn.tiny.cloud/1/qbw7rset86a37udw8sv86njuneptk0ctw88a570llag2w9od/tinymce/5/tinymce.min.js'
        referrerpolicy="origin"></script>
    <script type="text/javascript">
        var editor_config = {
            path_absolute: "http://localhost/unitop.vn/Laravel/Project/LaravelProject/public/",
            selector: '#detailDesc',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa sản phẩm
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['admin.product.update', $product->id], 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('code', 'Code') !!}
                    {!! Form::text('code', $product->codeProduct, ['id' => 'code', 'class' => 'form-control']) !!}
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Tên sản phẩm') !!}
                    {!! Form::text('name', $product->name, ['id' => 'name', 'class' => 'form-control']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Giá') !!}
                    {!! Form::text('price', $product->price, ['id' => 'price', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('shortDesc', 'Mô tả sản phẩm') !!}
                    {!! Form::textarea('shortDesc', $product->shortDesc, [
                        'id' => 'shortDesc',
                        'class' => 'form-control',
                        'cols' => 30,
                        'rows' => 5,
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('detailDesc', 'Chi tiết sản phẩm') !!}
                    {!! Form::textarea('detailDesc', $product->detailDesc, ['id' => 'detailDesc', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::file('file', ['id' => 'imageInput', 'style' => 'display:none']) !!}
                    {!! Form::label('imageInput', 'Chọn ảnh', ['id' => 'imageInputLabel', 'class' => 'image-input-label']) !!}<br>
                    <img src="{{ $product->imageUrl != null ? url($product->imageUrl) : '' }}" alt="Ảnh sản phẩm"
                        id="productImage" width="200px">
                </div>

                <div class="form-group">                    
                    {!! Form::label('category', 'Danh mục') !!}
                    {!! Form::select('category', $categorys->pluck('name', 'id'), $product->category_id, [
                        'id' => 'category',
                        'class' => 'form-control',
                    ]) !!}
                </div>

                {{-- <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div> --}}
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
