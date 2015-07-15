@extends('pulsar::layouts.tab', ['tabs' => [['id' => 'box_tab1', 'name' => trans_choice('pulsar::pulsar.article', 1)], ['id' => 'box_tab2', 'name' => trans_choice('pulsar::pulsar.attachment', 2)]]])

@section('script')
    @parent
    <!-- cms::articles.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/contentbuilder/css/iframe.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/css/select2.css') }}">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/attachment/css/attachment-library.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/css/getfile.css') }}">


    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.loadTemplate/jquery.loadTemplate-1.4.5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cssloader/js/jquery.cssloader.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/mobiledetect/mdetect.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/getfile/js/jquery.getfile.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2.custom/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/js/i18n/' . config('app.locale') . '.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/speakingurl/speakingurl.min.js') }}"></script>
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

    @include('cms::article.includes.common_script')

    <script>
        $(document).ready(function() {
            $('#upload-file').getFile(
                {
                    urlPlugin:          '/packages/syscover/pulsar/vendor',
                    folder:             '/packages/syscover/cms/storage/library',
                    tmpFolder:          '/packages/syscover/cms/storage/library',
                    multiple:           true,
                    activateTmpDelete:  false,
                    copies: [
                        {
                            folder: '/packages/syscover/cms/storage/attachment',
                            quality: 100
                        }
                    ]
                },
                function(data)
                {
                    if(data.success && Array.isArray(data.files))
                    {
                        var files = [];
                        for(var i = 0; data.files.length > i; i++)
                        {
                            files.push(data.files[i]);
                        }

                        $.ajax({
                            url:        '{{ route('storeCmsFile') }}',
                            data:       {
                                files: files
                            },
                            headers:  {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            type:		'POST',
                            dataType:	'json',
                            success: function(data)
                            {
                                console.log(data);
                                for(var i = 0; i < data.files.length; i++)
                                {
                                    if(data.files[i].is_image_354){
                                        $('.sortable').loadTemplate('#file', {
                                            image:      '/packages/syscover/cms/storage/attachment/' + data.files[i].file_354,
                                            fileName:   data.files[i].file_354
                                        }, { prepend:true });
                                    }
                                }
                            }
                        });
                    }
                }
            );
/*
            $('body').on('dragenter', function(e){
                $('.uploader-window').css('display', 'block');
                $('.uploader-window').css('opacity', 1);
            });
            $('body').on('dragleave', function(e){

                console.log(e);
                //$('.uploader-window').css('display', 'none');
                //$('.uploader-window').css('opacity', 0);
            });

            $('.uploader-window h3').on('dragleave', function(e){

            });
            */
        });
    </script>

    <script type="text/html" id="file">
        <li>
            <div class="attachment-item">
                <div class="attachment-img">
                    <img data-src="image" />
                </div>
                <div class="attachment-over">
                    <div class="col-md-10 col-sm-10 col-xs-10 uncovered">
                        <h4 class="attachment-title">Familia Imagen</h4>
                        <p class="attachment-sub" data-content="fileName">Nombre del archivo</p>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 uncovered">
                        <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                    </div>
                    <form>
                        <div class="close-icon covered"><span class="glyphicon glyphicon-remove"></span></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 covered">
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
                        <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6 covered">
                            <div class="form-group">
                                <button type="button" class="close-ov form-control">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </li>
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

        }
    </style>
    <!-- /cms::articles.create -->
@stop

@section('box_tab1')
    <!-- cms::articles.create -->
    @include('pulsar::includes.html.form_record_header', ['action' => 'store'])
        <div class="row">
            <div class="col-md-6">
                @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id',  'value' => Input::old('name', isset($object->id_355)? $object->id_355 : null), 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 4])
                @include('pulsar::includes.html.form_image_group', ['label' => trans_choice('pulsar::pulsar.language', 1), 'name' => 'lang', 'nameImage' => $lang->name_001, 'value' => $lang->id_001, 'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001), 'labelSize' => 4, 'fieldSize' => 8])
                @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.section', 1), 'id' => 'section', 'name' => 'section', 'value' => Input::old('section', isset($object->section_355)? $object->section_355 : null), 'objects' => $sections, 'idSelect' => 'id_350', 'nameSelect' => 'name_350', 'class' => 'form-control select2', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-section-outer-container']])
                @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.family', 1), 'id' => 'family', 'name' => 'family', 'value' => Input::old('family', isset($object->family_355)? $object->family_355 : null), 'objects' => $families, 'idSelect' => 'id_351', 'nameSelect' => 'name_351', 'class' => 'form-control select2', 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-family-outer-container']])
            </div>
            <div class="col-md-6">
                @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.author'), 'name' => 'authorName',  'value' => Input::old('authorName', isset($authorName)? $authorName : Auth::user()->name_010 . ' ' . Auth::user()->surname_010), 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 8])
                <input type="hidden" name="author" value="{{ Input::old('author', isset($object->id_355)? $object->id_355 : Auth::user()->id_010) }}">
                @include('pulsar::includes.html.form_select_group', ['label' => trans('cms::pulsar.status'), 'name' => 'status', 'value' => Input::old('status', isset($object->status_355)? $object->status_355 : null), 'objects' => $statuses, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true])
                @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('cms::pulsar.publish'), 'name' => 'publish', 'id' => 'idPublish', 'value' => Input::old('publish', isset($object->publish_355)? date(config('pulsar.datePattern') . ' H:i', $object->publish_355) : null), 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')]])
            </div>
        </div>
        @include('pulsar::includes.html.form_section_header', ['label' => trans('cms::pulsar.content'), 'icon' => 'icon-inbox', 'containerId' => 'headerContent'])
        @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('pulsar::pulsar.date'), 'containerId' => 'dateContent', 'name' => 'date', 'id' => 'idDate', 'value' => Input::old('date', isset($object->date_355)? date(config('pulsar.datePattern'), $object->date_355) : date(config('pulsar.datePattern'))), 'required' => true, 'fieldSize' => 4, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')), 'locale' => config('app.locale')]])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.title'), 'containerId' => 'titleContent', 'name' => 'title', 'value' => Input::old('title', isset($object->title_355)? $object->title_355 : null), 'maxLength' => '510', 'rangeLength' => '2,510', 'required' => true])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.slug'), 'containerId' => 'slugContent', 'name' => 'slug', 'value' => Input::old('slug', isset($object->slug_355)? $object->slug_355 : null), 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
        @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.category', 1), 'containerId' => 'categoriesContent', 'name' => 'categories[]', 'value' => Input::old('categories', isset($object)? $object->categories : null), 'objects' => $categories, 'idSelect' => 'id_352', 'nameSelect' => 'name_352', 'multiple' => true, 'class' => 'col-md-12 select2', 'fieldSize' => 10, 'data' => ['placeholder' => trans('cms::pulsar.select_category'), 'width' => '100%']])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'containerId' => 'sortingContent', 'name' => 'sorting', 'type' => 'number', 'value' => Input::old('sorting', isset($object->sorting_355)? $object->sorting_355 : null), 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.tags'), 'containerId' => 'tagsContent', 'name' => 'tags', 'value' => Input::old('tags', isset($object->tags_355)? $object->tags_355 : null), 'class' => 'tags-autocomplete'])
        @include('pulsar::includes.html.form_wysiwyg_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'wysiwyg', 'labelSize' => 2, 'fieldSize' => 10])
        @include('pulsar::includes.html.form_contentbuilder_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'contentbuilder', 'theme' => 'default', 'value' => Input::old('article', isset($object->article_355)? $object->article_355 : null), 'labelSize' => 2, 'fieldSize' => 10])
        <textarea name="article" class="hidden">{{ Input::old('article', isset($object->article_355)? $object->article_355 : null) }}</textarea>
    @include('pulsar::includes.html.form_record_footer', ['action' => 'store'])
    <!-- /cms::articles.create -->
@stop

@section('box_tab2')



    <style>
        .uploader-window {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 86, 132, .9);
            z-index: 250000;
            display: none;
            text-align: center;
            opacity: 0;
            -webkit-transition: opacity 250ms;
            transition: opacity 250ms
        }
        .uploader-window-content {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px dashed #fff
        }
        .uploader-window h3 {
            margin: -.5em 0 0;
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            font-size: 40px;
            color: #fff;
            padding: 0
        }

        .uploader-window .media-progress-bar {
            margin-top: 20px;
            max-width: 300px;
            background: 0 0;
            border-color: #fff;
            display: none
        }

        .uploader-window .media-progress-bar div {
            background: #fff
        }

        .uploading .uploader-window .media-progress-bar {
            display: block
        }

    </style>

    <div class="uploader-window">
        <div class="uploader-window-content">
            <h3>Arrastra archivos aquí para subirlos</h3>
        </div>
    </div>

    <!-- cms::articles.create -->
    <div class="widget box">
        <div class="widget-content no-padding">

            <div class="row">
                <div id="upload-file" class="col-md-12 drop-zone">
                    <div class="col-md-12 text-drop-zone">
                        Pulse o arrastre aquí sus archivos
                    </div>
                </div>
            </div>

            <div class="row" id="attachment-wrapper">
                <ul class="sortable">

                    <li>
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 col-sm-10 col-xs-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                    <p class="attachment-sub">Nombre del archivo</p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 covered">
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
                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6 covered">
                                        <div class="form-group">
                                            <button type="button" class="close-ov form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="attachment-item">
                            <div class="attachment-img">
                                <img src="http://www.astroandalucia.es/wp-content/uploads/2015/03/homepage-5.jpg">
                            </div>
                            <div class="attachment-over">
                                <div class="col-md-10 col-sm-10 col-xs-10 uncovered">
                                    <h4 class="attachment-title">Familia Imagen</h4>
                                    <p class="attachment-sub">Nombre del archivo</p>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2 uncovered">
                                    <h4 class="attachment-action"><span class="glyphicon glyphicon-pencil"></span></h4>
                                </div>
                                <form>
                                    <div class="close-icon covered"><span class="glyphicon glyphicon-remove"></span></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 covered">
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
                                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6 covered">
                                        <div class="form-group">
                                            <button type="button" class="close-ov form-control">GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </div>
    <!-- /cms::articles.create -->
@stop