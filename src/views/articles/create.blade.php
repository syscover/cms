@extends('pulsar::layouts.tab', ['tabs' => [['id' => 'box_tab1', 'name' => trans_choice('pulsar::pulsar.article', 1)], ['id' => 'box_tab2', 'name' => trans_choice('pulsar::pulsar.attachment', 2)]]])

@section('script')
    @parent
    <!-- cms::articles.index -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/contentbuilder/css/iframe.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/attachment/css/attachment-library.css') }}">

    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/js/i18n/' . config('app.locale') . '.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/froala_editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/tables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/colors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/media_manager.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/file_upload.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/font_family.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/block_styles.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/video.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/plugins/fullscreen.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/attachment/js/attachment-library.js') }}"></script>
    @if(config('app.locale') != 'en')
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/js/langs/' . config('app.locale') . '.js') }}"></script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            $('.tags-autocomplete').tagsInput({
                defaultText: '{{ trans('pulsar::pulsar.add_tag') }}',
                width: '100%',
                height: 'auto',
                autocomplete_url: [ { "id": "Netta rufina", "label": "Red-crested Pochard", "value": "Red-crested Pochard" }, { "id": "Sterna sandvicensis", "label": "Sandwich Tern", "value": "Sandwich Tern" }]
            });

            $('.wysiwyg').editable({
                language: '{{ config('app.locale') }}',
                inlineMode: false,
                toolbarFixed: false,
                tabSpaces: true,
                shortcuts: true,
                shortcutsAvailable: ['bold', 'italic'],
                buttons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'color', 'formatBlock', 'blockStyle', 'inlineStyle', 'align', 'insertOrderedList', 'insertUnorderedList', 'outdent', 'indent', 'selectAll', 'createLink', 'insertImage', 'insertVideo', 'table', 'undo', 'redo', 'html', 'insertHorizontalRule', 'uploadFile', 'removeFormat', 'fullscreen'],
                imagesLoadURL: '{{ route('loadCmsImages') }}',
                imageDeleteURL: '{{ route('deleteCmsImages') }}',
                imageDeleteParams: {_token: '{{ csrf_token() }}'},
                imageUploadURL: '{{ route('uploadCmsImages') }}',
                imageUploadParams: {_token: '{{ csrf_token() }}'},
                fileUploadURL: '{{ route('uploadCmsFiles') }}',
                fileUploadParams: {_token: '{{ csrf_token() }}'},
                minHeight: 250,
                paragraphy: false
            });


            $("[name=section]").on('change', function(){
                if($("[name=section]").val())
                {
                    var url = '{{ route('apiShowCmsSection', ['id' => 'id', 'api' => 1]) }}';

                    $.ajax({
                        dataType:   'json',
                        type:       'POST',
                        url:        url.replace('id', $("[name=section]").val()),
                        headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success:  function(data)
                        {
                            if(data.article_family_350 != null)
                            {
                                $("[name=family]").select2('val', data.article_family_350);
                            }
                            else
                            {
                                $("[name=family]").select2('val', '');
                            }
                        }
                    });
                }
            });

            $("[name=family]").on('change', function(){
                if($("[name=family]").val())
                {
                    var url = '{{ route('apiShowCmsArticleFamily', ['id' => 'id', 'api' => 1]) }}';

                    $.ajax({
                        dataType:   'json',
                        type:       'POST',
                        url:        url.replace('id', $("[name=family]").val()),
                        headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success:  function(data)
                        {
                            if(data.editor_type_351 == 1)
                            {
                                $('.contentbuilder-container').hide();
                                $('.wysiwyg-container').fadeIn();
                            }
                            else if(data.editor_type_351 == 2)
                            {
                                $('.wysiwyg-container').hide();
                                $('.contentbuilder-container').fadeIn();
                            }

                            var properties = jQuery.parseJSON(data.data_351);
                            var hasProperty = false;
                            if(properties.date){ $('#dateContent').fadeIn();hasProperty=true; } else { $('#dateContent').fadeOut(); }
                            if(properties.title){ $('#titleContent').fadeIn();hasProperty=true; } else { $('#titleContent').fadeOut(); }
                            if(properties.slug){ $('#slugContent').fadeIn();hasProperty=true; } else { $('#slugContent').fadeOut(); }
                            if(properties.sorting){ $('#sortingContent').fadeIn();hasProperty=true; } else { $('#sortingContent').fadeOut(); }
                            if(properties.tags){ $('#tagsContent').fadeIn();hasProperty=true; } else { $('#tagsContent').fadeOut(); }
                            if(properties.categories){ $('#categoriesContent').fadeIn();hasProperty=true; } else { $('#categoriesContent').fadeOut(); }
                            if(hasProperty){ $('#headerContent').fadeIn(); }
                        }
                    });
                }
                else
                {
                    $('.wysiwyg-container').fadeOut();
                    $('.contentbuilder-container').fadeOut();
                    $('#headerContent').fadeOut();
                    $('#dateContent').fadeOut();
                    $('#titleContent').fadeOut();
                    $('#slugContent').fadeOut();
                    $('#sortingContent').fadeOut();
                    $('#tagsContent').fadeOut();
                    $('#categoriesContent').fadeOut();
                }
            });

            // elements to hide
            $('.wysiwyg-container').hide();
            $('.contentbuilder-container').hide();
            $('#headerContent').hide();
            $('#dateContent').hide();
            $('#titleContent').hide();
            $('#slugContent').hide();
            $('#sortingContent').hide();
            $('#tagsContent').hide();
            $('#categoriesContent').hide();


            // set tab active
            @if($tab == 0)
            $('.tabbable li:eq(0) a').tab('show');
            @elseif($tab == 1)
            $('.tabbable li:eq(1) a').tab('show');
            @endif
        });
    </script>

    <style>
        .drop-zone {
            height: 100px;
            line-height: 25px;
            border: 2px dashed #bbb;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            padding: 20px;
            color: #bbb;
            text-align: center;
            font-size: 12px;
            margin: 19px;
        }
    </style>
    <!-- /cms::articles.index -->
@stop

@section('box_tab1')
    <!-- cms::articles.create -->
    @include('pulsar::includes.html.form_record_header', ['action' => 'create'])
        <div class="row">
            <div class="col-md-6">
                @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id',  'value' => Input::old('name', isset($object->id_355)? $object->id_355 : null), 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 4])
                @include('pulsar::includes.html.form_image_group', ['label' => trans_choice('pulsar::pulsar.language', 1), 'name' => 'lang', 'nameImage' => $lang->name_001, 'value' => $lang->id_001, 'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001), 'labelSize' => 4, 'fieldSize' => 8])
                @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.section', 1), 'id' => 'section', 'name' => 'section', 'value' => Input::old('section'), 'objects' => $sections, 'idSelect' => 'id_350', 'nameSelect' => 'name_350', 'class' => 'form-control select2', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-section-outer-container']])
                @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.family', 1), 'id' => 'family', 'name' => 'family', 'value' => Input::old('family'), 'objects' => $families, 'idSelect' => 'id_351', 'nameSelect' => 'name_351', 'class' => 'form-control select2', 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-family-outer-container']])
            </div>
            <div class="col-md-6">
                @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.author'), 'name' => 'author',  'value' => Input::old('author', isset($object->id_355)? $object->id_355 : Auth::user()->name_010 . ' ' . Auth::user()->surname_010), 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 8])
                @include('pulsar::includes.html.form_select_group', ['label' => trans('cms::pulsar.status'), 'name' => 'status', 'value' => Input::old('status'), 'objects' => $statuses, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true])
                @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('cms::pulsar.publish'), 'name' => 'publish', 'id' => 'idPublish', 'value' => Input::old('publish', isset($object->publish_355)? $object->publish_355 : null), 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['format' => 'DD/MM/YYYY HH:mm', 'locale' => config('app.locale')]])
            </div>
        </div>
        @include('pulsar::includes.html.form_section_header', ['label' => trans('cms::pulsar.content'), 'icon' => 'icon-inbox', 'containerId' => 'headerContent'])
        @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('pulsar::pulsar.date'), 'containerId' => 'dateContent', 'name' => 'date', 'id' => 'idDate', 'value' => Input::old('date', isset($object->date_355)? $object->date_355 : null), 'required' => true, 'fieldSize' => 4, 'data' => ['format' => 'DD/MM/YYYY', 'locale' => config('app.locale')]])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.title'), 'containerId' => 'titleContent', 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.slug'), 'containerId' => 'slugContent', 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
        @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.category', 1), 'containerId' => 'categoriesContent', 'name' => 'categories[]', 'value' => Input::old('categories'), 'objects' => $categories, 'idSelect' => 'id_352', 'nameSelect' => 'name_352', 'multiple' => true, 'class' => 'col-md-12 select2', 'fieldSize' => 10, 'data' => ['placeholder' => trans('cms::pulsar.select_category'), 'width' => '100%']])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'containerId' => 'sortingContent', 'name' => 'sorting', 'type' => 'number', 'value' => Input::old('sorting', isset($object->sorting_355)? $object->sorting_355 : null), 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.tags'), 'containerId' => 'tagsContent', 'name' => 'tags', 'value' => Input::old('tags', isset($object->tags_355)? $object->tags_355 : null), 'class' => 'tags-autocomplete'])
        @include('pulsar::includes.html.form_wysiwyg_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'wysiwyg', 'value' => Input::old('article', isset($object->article_355)? $object->article_355 : null), 'labelSize' => 2, 'fieldSize' => 10])
        @include('pulsar::includes.html.form_contentbuilder_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'contentbuilder', 'theme' => 'default', 'value' => Input::old('article', isset($object->article_355)? $object->article_355 : null), 'labelSize' => 2, 'fieldSize' => 10])
    @include('pulsar::includes.html.form_record_footer', ['action' => 'create'])
    <!-- /cms::articles.create -->
@stop

@section('box_tab2')
    <!-- cms::articles.create -->
    <div class="widget box">
        <div class="widget-content no-padding">
            <div class="row" id="attachment-wrapper">
                <ul class="sortable">
                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.enbolivia.com/files/imagen_corporativa.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="ui-state-default">
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                </div>
                                <div class="col-md-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered half"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 covered half">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option selected>No visible</option>
                                                <option>Familia 1</option>
                                                <option>Familia 2</option>
                                                <option>Familia 3</option>
                                                <option>Familia 4</option>
                                                <option>Familia 5</option>
                                                <option>Familia 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="open-ov form-control">NUEVA</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered half">
                                        <div class="form-group">
                                            <button type="button" class="close-ov full form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="col-md-12 covered full">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="familia_name" placeholder="Nombre Familia" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_width" placeholder="Ancho (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="familia_height" placeholder="Alto (px)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default close-ov">CANCELAR</button>
                                    </div>
                                    <div class="col-md-6 covered full">
                                        <button type="button" class="btn btn-default">AÑADIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans('cms::pulsar.content'), 'icon' => 'icon-inbox'])
    <div class="widget box">
        <div class="widget-content no-padding">
            <div class="row">
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone"></div>
                <div class="col-md-2 drop-zone">
                    <div class="col-md-12 text-drop-zone">
                        Pulse o arrastre aquí sus fotos
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /cms::articles.create -->
@stop