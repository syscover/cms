@extends('pulsar::layouts.tab', ['tabs' => [
        ['id' => 'box_tab1', 'name' => trans_choice('pulsar::pulsar.article', 1)],
        ['id' => 'box_tab2', 'name' => trans_choice('pulsar::pulsar.attachment', 2)]
    ]])

@section('head')
    @parent
    <!-- cms::articles.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/contentbuilder/css/iframe.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/attachment/css/attachment-library.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/getfile/css/getfile.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/tokenfield/css/bootstrap-tokenfield.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/tokenfield/css/tokenfield-typeahead.css') }}">

    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.loadTemplate/jquery.loadTemplate-1.5.0.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cropper/cropper.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/cssloader/js/jquery.cssloader.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/mobiledetect/mdetect.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/libs/filedrop/filedrop.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/getfile/js/jquery.getfile.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/tokenfield/bootstrap-tokenfield.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/speakingurl/speakingurl.min.js') }}"></script>

    <script src="{{ asset('packages/syscover/pulsar/vendor/attachment/js/attachment-library.js') }}"></script>
    @include('pulsar::includes.js.attachment', [
        'resource'          => 'cms-article',
        'routesConfigFile'  => 'cms',
        'objectId'          => isset($object->id_355)? $object->id_355 : null])

    @include('pulsar::includes.html.froala_references')

    @include('pulsar::includes.js.delete_translation_record')

    <script>
        $(document).ready(function() {

            // type editor to article
            var contentArticle = null;

            // tags element, on edit we load values across javascript
            $('[name=tags]').tokenfield({
                autocomplete: {
                    source: {!! json_encode($tags) !!},
                    delay: 100
                },
                showAutocompleteOnFocus: true
            })@if(isset($selectTags)).tokenfield('setTokens', {!! json_encode($selectTags) !!});@else; @endif

            // rutine to avoid introduce a repeat token
            $('[name=tags]').on('tokenfield:createtoken', function (event) {
                var existingTokens  = $(this).tokenfield('getTokens');
                var autocomplete    = $(this).tokenfield('getAutocomplete');

                // search if there is a object with the same label
                if(event.attrs.value === 'null')
                {
                    $.each(autocomplete.source, function (index, object) {
                        if(object.label === event.attrs.label)
                        {
                            event.preventDefault();
                            $('[name=tags]').tokenfield('createToken', object);
                        }
                    });
                }

                $.each(existingTokens, function(index, token)
                {
                    if (event.attrs.value === 'null' && token.label === event.attrs.label)
                    {
                        event.preventDefault();
                    }
                    else if(event.attrs.value !== 'null' && token.value === event.attrs.value)
                    {
                        event.preventDefault();
                    }
                });
            });

            $('.wysiwyg').froalaEditor({
                language: '{{ config('app.locale') }}',
                placeholderText: '{{ trans('pulsar::pulsar.type_something') }}',
                toolbarInline: false,
                toolbarSticky: true,
                tabSpaces: true,
                shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                toolbarButtonsMD: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                heightMin: 250,
                enter: $.FroalaEditor.ENTER_BR,
                key: '{{ config('pulsar.froalaEditorKey') }}',
                imageUploadURL: '{{ route('froalaUploadImage') }}',
                imageUploadParams: {
                    package: 'cms',
                    _token: '{{ csrf_token() }}'
                },
                imageManagerLoadURL: '{{ route('froalaLoadImages', ['package' => 'cms']) }}',
                imageManagerDeleteURL: '{{ route('froalaDeleteImage') }}',
                imageManagerDeleteParams: {
                    package: 'cms',
                    _token: '{{ csrf_token() }}'
                },
                fileUploadURL: '{{ route('froalaUploadFile') }}',
                fileUploadParams: {
                    package: 'cms',
                    _token: '{{ csrf_token() }}'
                }
            }).on('froalaEditor.image.removed', function (e, editor, $img) {

                $.ajax({
                    method: "POST",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('froalaDeleteImage') }}',
                    data: {
                        package: 'cms',
                        src: $img.attr('src')
                    }
                })
                .done (function (data) {
                    console.log ('image was deleted');
                })
                .fail (function () {
                    console.log ('image delete problem');
                });
            });

            // on change section show families
            $("[name=section]").on('change', function(){
                if($("[name=section]").val())
                {
                    var url = '{{ route('apiShowCmsSection', ['id' => '%id%', 'api' => 1]) }}'

                    $.ajax({
                        dataType:   'json',
                        type:       'POST',
                        url:        url.replace('%id%', $("[name=section]").val()),
                        headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success:  function(data)
                        {
                            if(data.article_family_id_350 != null)
                            {
                                $("[name=family]").select2('val', data.article_family_id_350);
                            }
                            else
                            {
                                $("[name=family]").select2('val', '');
                            }
                        }
                    });
                }
            });

            // on change family show fields and custom fields
            $("[name=family]").on('change', function(){
                if($("[name=family]").val())
                {
                    var url = '{{ route('apiShowCmsArticleFamily', ['id' => '%id%', 'api' => 1]) }}';

                    $.ajax({
                        dataType:   'json',
                        type:       'POST',
                        headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        url:        url.replace('%id%', $("[name=family]").val()),

                        success:  function(data)
                        {
                            if(data.editor_id_351 == 1)
                            {
                                $('.contentbuilder-container, .textarea-container').hide();
                                $('.wysiwyg-container').fadeIn();
                                contentArticle = 'wysiwyg';
                            }
                            else if(data.editor_id_351 == 2)
                            {
                                $('.wysiwyg-container, .textarea-container').hide();
                                $('.contentbuilder-container').fadeIn();
                                contentArticle = 'contentbuilder';
                            }
                            else if(data.editor_id_351 == 3)
                            {
                                $('.wysiwyg-container, .contentbuilder-container').hide();
                                $('.textarea-container').fadeIn();
                                contentArticle = 'textarea';
                            }
                            else
                            {
                                $('.wysiwyg-container, .contentbuilder-container, .textarea-container').hide();
                            }

                            var properties = jQuery.parseJSON(data.data_351);
                            var hasProperty = false;
                            if(properties.date){ $('#dateContent').fadeIn();hasProperty=true; } else { $('#dateContent').fadeOut(); }
                            if(properties.title){ $('#titleContent').fadeIn();hasProperty=true; } else { $('#titleContent').fadeOut(); }
                            if(properties.slug){ $('#slugContent').fadeIn();hasProperty=true; } else { $('#slugContent').fadeOut(); }
                            if(properties.sorting){ $('#sortingContent').fadeIn();hasProperty=true; } else { $('#sortingContent').fadeOut(); }
                            if(properties.link){ $('#linkContent').fadeIn();hasProperty=true; } else { $('#linkContent').fadeOut(); }
                            if(properties.tags){ $('#tagsContent').fadeIn();hasProperty=true; } else { $('#tagsContent').fadeOut(); }
                            if(properties.categories){ $('#categoriesContent').fadeIn();hasProperty=true; } else { $('#categoriesContent').fadeOut(); }
                            if(hasProperty){ $('#headerContent').fadeIn(); }

                            // get html doing a request to controller to render the views
                            @if($action == 'edit' || isset($id))
                                var request =  {
                                    customFieldGroup: data.field_group_id_351,
                                    lang:   '{{ $lang->id_001 }}',
                                    object: '{{ $id }}',
                                    resource: 'cms-article-family',
                                    action: '{{ $action }}'
                                };
                            @else
                                var request =  {
                                    customFieldGroup: data.field_group_id_351,
                                    lang: '{{ $lang->id_001 }}'
                                };
                            @endif

                            if(data.field_group_id_351 != null){
                                $.ajax({
                                    dataType:   'json',
                                    type:       'POST',
                                    headers:    { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    url:        '{{ route('apiGetCustomFields') }}',
                                    data:       request,
                                    success:  function(data)
                                    {
                                        // set html custom fields section
                                        $('#wrapperCustomFields').html(data.html);

                                        if ($.fn.select2)
                                            $('.select2').each(function() {
                                                var self = $(this);
                                                $(self).select2(self.data());
                                            });

                                        if($.fn.froalaEditor)
                                            $('.wysiwyg').froalaEditor({
                                                language: '{{ config('app.locale') }}',
                                                toolbarInline: false,
                                                toolbarSticky: true,
                                                tabSpaces: true,
                                                shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
                                                toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', 'insertLink', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                                                toolbarButtonsMD: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'insertHR', 'insertLink', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
                                                heightMin: 130,
                                                enter: $.FroalaEditor.ENTER_BR,
                                                key: '{{ config('pulsar.froalaEditorKey') }}'
                                            });

                                        if(data.html != '')
                                        {
                                            $(".uniform").uniform();
                                            $('#headerCustomFields').fadeIn();
                                            $('#wrapperCustomFields').fadeIn();
                                        }
                                    }
                                })
                            }
                            else
                            {
                                $('#headerCustomFields').fadeOut();
                                $('#wrapperCustomFields').fadeOut();
                                $('#wrapperCustomFields').html('');
                            }
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
                    $('#linkContent').fadeOut();
                    $('#sortingContent').fadeOut();
                    $('#tagsContent').fadeOut();
                    $('#categoriesContent').fadeOut();

                    $('#headerCustomFields').fadeOut();
                    $('#wrapperCustomFields').fadeOut();
                    $('#wrapperCustomFields').html('');
                }
            });

            // launch slug function when change title and slug
            $("[name=title], [name=slug]").on('change', function(){
                $("[name=slug]").val(getSlug($(this).val(),{
                    separator: '-',
                    lang: '{{ $lang->id_001 }}'
                }));
                $.checkSlug();
            });

            // on submit, get content from article, wysiwyg content builder or textarea
            $("#recordForm").on('submit', function(event) {

                $("[name=jsonTags]").val(JSON.stringify($('[name=tags]').tokenfield('getTokens')));

                if(contentArticle == 'wysiwyg')
                {
                    $("[name=article]").val($('[name=wysiwyg]').froalaEditor('html.get'));
                }
                else if(contentArticle == 'contentbuilder')
                {
                    $("[name=article]").val($('.iframe-contentbuilder').get(0).contentWindow.getContentBuilderHtml().replace(/(\r\n|\n|\r)/gm,""));
                }
                else if(contentArticle == 'textarea')
                {
                    $("[name=article]").val($('[name=textarea]').val());
                }
                else
                {
                    $("[name=article]").val('');
                }
            });

            // hide every elements
            $('.wysiwyg-container, .contentbuilder-container, .textarea-container').hide()
            $('#headerContent, #dateContent, #titleContent, #slugContent, #sortingContent, #linkContent, #tagsContent, #categoriesContent').hide();

            $('#headerCustomFields, #wrapperCustomFields').hide();

            // set tab active
            @if($tab == 0)
                $('.tabbable li:eq(0) a').tab('show')
            @elseif($tab == 1)
                $('.tabbable li:eq(1) a').tab('show')
            @endif

            // if we have family value, throw event to show or hide elements
            if($("[name=family]").val())
            {
                $("[name=family]").trigger('change')
            }

            @if(isset($object->editor_id_351) && $object->editor_id_351 == 1)
                // set HTML wysiwyg component
                $('.wysiwyg').froalaEditor('html.set', $('[name=article]').val())
            @endif

            @if(isset($object->editor_id_351) && $object->editor_id_351 == 2)
                // set HTML contentbuilder component
                $('.iframe-contentbuilder').load(function() {
                    $(this).get(0).contentWindow.getParentHtml('article')
                });
            @endif

            @if(isset($object->editor_id_351) && $object->editor_id_351 == 3)
                // set textarea component
                $('[name=textarea]').val($('[name=article]').val());
            @endif
        })

        $.checkSlug = function() {
            $.ajax({
                dataType:   'json',
                type:       'POST',
                headers:  {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url:        '{{ route('apiCheckSlugCmsArticle') }}',
                data:       {
                    lang:   '{{ $lang->id_001 }}',
                    slug:   $('[name=slug]').val(),
                    id:     $('[name=id]').val()
                },
                success:  function(data)
                {
                    $("[name=slug]").val(data.slug)
                }
            })
        }
    </script>
    <!-- /cms::articles.create -->
@stop

@section('layoutTabHeader')
    @include('pulsar::includes.html.form_record_header')
@stop

@section('layoutTabFooter')
    @include('pulsar::includes.html.form_record_footer')
@stop

@section('box_tab1')
    <!-- cms::articles.create -->
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'label' => 'ID',
                'name' => 'id',
                'value' => old('name', isset($object->id_355)? $object->id_355 : null),
                'readOnly' => true,
                'labelSize' => 4,
                'fieldSize' => 4
            ])
            @include('pulsar::includes.html.form_image_group', [
                'label' => trans_choice('pulsar::pulsar.language', 1),
                'name' => 'lang',
                'nameImage' => $lang->name_001,
                'value' => $lang->id_001,
                'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001),
                'labelSize' => 4,
                'fieldSize' => 8
            ])
            @include('pulsar::includes.html.form_select_group', [
                'label' => trans_choice('pulsar::pulsar.section', 1),
                'id' => 'section',
                'name' => 'section',
                'value' => old('section', isset($object->section_id_355)? $object->section_id_355 : null),
                'objects' => $sections,
                'idSelect' => 'id_350',
                'nameSelect' => 'name_350',
                'class' => 'select2',
                'labelSize' => 4,
                'fieldSize' => 8,
                'required' => true,
                'data' => [
                    'language' => config('app.locale'),
                    'width' => '100%',
                    'error-placement' => 'select2-section-outer-container'
                ]
            ])
            @include('pulsar::includes.html.form_select_group', [
                'label' => trans_choice('pulsar::pulsar.family', 1),
                'id' => 'family',
                'name' => 'family',
                'value' => old('family', isset($object->family_id_355)? $object->family_id_355 : null),
                'objects' => $families,
                'idSelect' => 'id_351',
                'nameSelect' => 'name_351',
                'class' => 'select2',
                'labelSize' => 4,
                'fieldSize' => 8,
                'data' => [
                    'language' => config('app.locale'),
                    'width' => '100%',
                    'error-placement' => 'select2-family-outer-container'
                ]
            ])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', [
                'label' => trans('cms::pulsar.author'),
                'name' => 'authorName',
                'value' =>  auth()->guard('pulsar')->user()->name_010 . ' ' . auth()->guard('pulsar')->user()->surname_010,
                'readOnly' => true,
                'labelSize' => 4,
                'fieldSize' => 8
            ])
            <input type="hidden" name="author" value="{{ auth()->guard('pulsar')->user()->id_010 }}">
            @include('pulsar::includes.html.form_select_group', [
                'label' => trans('cms::pulsar.status'),
                'name' => 'status',
                'value' => old('status', isset($object->status_id_355)? $object->status_id_355 : null),
                'objects' => $statuses,
                'idSelect' => 'id',
                'nameSelect' => 'name',
                'labelSize' => 4,
                'fieldSize' => 8,
                'required' => true
            ])
            @include('pulsar::includes.html.form_datetimepicker_group', [
                'labelSize' => 4,
                'fieldSize' => 8,
                'label' => trans('cms::pulsar.publish'),
                'name' => 'publish',
                'id' => 'idPublish',
                'value' => old('publish', isset($object->publish_355)? date(config('pulsar.datePattern') . ' H:i', $object->publish_355) : null),
                'data' => [
                    'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm',
                    'locale' => config('app.locale')
                ]
            ])
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', [
        'label' => trans('cms::pulsar.content'),
        'icon' => 'fa fa-inbox',
        'containerId' => 'headerContent'
    ])
    @include('pulsar::includes.html.form_datetimepicker_group', [
        'label' => trans_choice('pulsar::pulsar.date', 1),
        'containerId' => 'dateContent',
        'name' => 'date',
        'id' => 'idDate',
        'value' => old('date', isset($object->date_355)? date(config('pulsar.datePattern'), $object->date_355) : date(config('pulsar.datePattern'))),
        'required' => true,
        'fieldSize' => 4,
        'data' => [
            'format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')),
            'locale' => config('app.locale')
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.title'),
        'containerId' => 'titleContent',
        'name' => 'title',
        'value' => old('title', isset($object->title_355)? $object->title_355 : null),
        'maxLength' => '510',
        'rangeLength' => '2,510',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.slug'),
        'containerId' => 'slugContent',
        'name' => 'slug',
        'value' => old('slug', isset($object->slug_355)? $object->slug_355 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 10,
        'label' => trans_choice('pulsar::pulsar.category', 2),
        'containerId' => 'categoriesContent',
        'name' => 'categories[]',
        'value' => old('categories', isset($object)? $object->getCategories : null),
        'objects' => $categories,
        'idSelect' => 'id_352',
        'nameSelect' => 'name_352',
        'multiple' => true,
        'class' => 'col-md-12 select2',
        'data' => [
            'placeholder' => trans('pulsar::pulsar.select_category'),
            'width' => '100%'
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 6,
        'label' => trans('pulsar::pulsar.link'),
        'containerId' => 'linkContent',
        'name' => 'link',
        'value' => old('link', isset($object->link_355)? $object->link_355 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'inputs' => [
            [
                'fieldSize' => 2,
                'class' => 'uniform',
                'type' => 'checkbox' ,
                'label' => trans('pulsar::pulsar.new_window'),
                'name' => 'blank',
                'value' => 1,
                'checked' => old('blank', isset($object->blank_355)? $object->blank_355 : false)
            ]
        ]
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.sorting'),
        'containerId' => 'sortingContent',
        'name' => 'sorting',
        'type' => 'number',
        'value' => old('sorting', isset($object->sorting_355)? $object->sorting_355 : null),
        'maxLength' => '3',
        'rangeLength' => '1,3',
        'min' => '0',
        'fieldSize' => 2
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('cms::pulsar.tags'),
        'containerId' => 'tagsContent',
        'name' => 'tags',
        'placeholder' => trans('cms::pulsar.write_tag')
    ])
    @include('pulsar::includes.html.form_wysiwyg_group', [
        'label' => trans_choice('pulsar::pulsar.article', 1),
        'name' => 'wysiwyg',
        'labelSize' => 2,
        'fieldSize' => 10
    ])
    @include('pulsar::includes.html.form_contentbuilder_group', [
        'label' => trans_choice('pulsar::pulsar.article', 1),
        'name' => 'contentbuilder',
        'package' => 'cms',
        'theme' => 'default',
        'value' => old('article', isset($object->article_355)? $object->article_355 : null),
        'labelSize' => 2,
        'fieldSize' => 10
    ])
    @include('pulsar::includes.html.form_textarea_group', [
        'label' => trans_choice('pulsar::pulsar.article', 1),
        'name' => 'textarea',
        'labelSize' => 2,
        'fieldSize' => 10
    ])
    <textarea name="article" class="hidden">{{ old('article', isset($object->article_355)? $object->article_355 : null) }}</textarea>

    @include('pulsar::includes.html.form_section_header', [
        'label' => trans_choice('pulsar::pulsar.custom_field', 2),
        'icon' => 'fa fa-align-left',
        'containerId' => 'headerCustomFields'
    ])
    <div id="wrapperCustomFields"></div>

    @include('pulsar::includes.html.form_hidden', [
        'name' => 'dataObject',
        'value' => isset($object->data_355)? $object->data_355 : null
    ])
    @include('pulsar::includes.html.form_hidden', [
        'name' => 'jsonTags'
    ])
    @include('pulsar::includes.html.form_hidden', [
        'name' => 'attachments',
        'value' => $attachmentsInput
    ])
    <!-- /cms::articles.create -->
@stop

@section('box_tab2')
    @include('pulsar::includes.html.attachment', [
        'action'            => 'create',
        'routesConfigFile'  => 'cms'])
@stop

@section('endBody')
    <!--TODO: Implementar botón para añadir fotografías desde la librería-->
    <div id="attachment-library-mask">
        <div id="attachment-library-content">
            {{ trans('pulsar::pulsar.drag_files') }}
        </div>
    </div>
    <div id="attachment-library-progress-bar">
        <div class="valign-wrapper">
            <div class="container valign">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <div class="progress">
                            <div id="upload-progress-bar" class="progress-bar progress-bar-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
