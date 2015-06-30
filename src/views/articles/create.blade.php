@extends('pulsar::layouts.tab', ['tabs' => [['id' => 'box_tab1', 'name' => trans_choice('pulsar::pulsar.article', 1)], ['id' => 'box_tab2', 'name' => trans_choice('pulsar::pulsar.attachment', 2)]]])

@section('script')
    @parent
    <!-- cms::articles.index -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/wysiwyg.froala/css/froala_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/js/custom/jquery.select2/js/select2.min.js') }}"></script>
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

            createWysiwyg();

            $("[name=family]").on('change', function(){
                if($("[name=family]").val())
                {
                    var url = '{{ route('apiShowCmsArticleFamilies', ['id' => 'id', 'api' => 1]) }}'

                    $.ajax({
                        dataType:   'json',
                        type:       'POST',
                        url:        url.replace('id', $("[name=family]").val()),
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success:  function(data)
                        {
                            if(data.editor_type_351 == 1)
                            {
                                $('.wysiwyg').editable('destroy');
                            }
                            else if(data.editor_type_351 == 2)
                            {
                                createWysiwyg();
                            }
                        }
                    });
                }
            });

            // set tab active
            @if($tab == 0)
            $('.tabbable li:eq(0) a').tab('show');
            @elseif($tab == 1)
            $('.tabbable li:eq(1) a').tab('show');
            @endif
        });

        function createWysiwyg()
        {
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
                fileUploadParams: {_token: '{{ csrf_token() }}'}
            });
        }
    </script>
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
        @include('pulsar::includes.html.form_section_header', ['label' => trans('cms::pulsar.content'), 'icon' => 'icon-inbox'])
        @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('pulsar::pulsar.date'), 'name' => 'date', 'id' => 'idDate', 'value' => Input::old('date', isset($object->date_355)? $object->date_355 : null), 'required' => true, 'fieldSize' => 4, 'data' => ['format' => 'DD/MM/YYYY', 'locale' => config('app.locale')]])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.slug'), 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'type' => 'number', 'value' => Input::old('sorting', isset($object->sorting_355)? $object->sorting_355 : null), 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
        @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => Input::old('tags', isset($object->tags_355)? $object->tags_355 : null), 'class' => 'tags-autocomplete'])
        @include('pulsar::includes.html.form_wysiwyg_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'article', 'value' => Input::old('article', isset($object->article_355)? $object->article_355 : null), 'labelSize' => 2, 'fieldSize' => 10])
    @include('pulsar::includes.html.form_record_footer', ['action' => 'create'])
    <!-- /cms::articles.create -->
@stop

@section('box_tab2')

@stop