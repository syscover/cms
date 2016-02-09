<script type="text/javascript">
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
        })@if(isset($selectTags)).tokenfield('setTokens', {!! json_encode($selectTags) !!})@endif

        $('[name=tags]').on('tokenfield:createtoken', function (event) {
            var existingTokens = $(this).tokenfield('getTokens')
            var autocomplete = $(this).tokenfield('getAutocomplete')

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

        /*TODO: revisar funcionalidades froala */
        $('.wysiwyg').froalaEditor({
            language: '{{ config('app.locale') }}',
            placeholderText: '{{ trans('pulsar::pulsar.type_something') }}',
            toolbarInline: false,
            toolbarSticky: true,
            tabSpaces: true,
            shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink'],
            toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', 'insertHR', '-', 'insertLink', 'insertImage', 'insertVideo', 'insertFile', 'insertTable', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
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
            })

        });

        // on change section show families
        $("[name=section]").on('change', function(){
            if($("[name=section]").val())
            {
                var url = '{{ route('apiShowCmsSection', ['id' => '%id%', 'api' => 1]) }}';

                $.ajax({
                    dataType:   'json',
                    type:       'POST',
                    url:        url.replace('%id%', $("[name=section]").val()),
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

        // on change family show fields and custom fields
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
                            contentArticle = 'wysiwyg';
                        }
                        else if(data.editor_type_351 == 2)
                        {
                            $('.wysiwyg-container').hide();
                            $('.contentbuilder-container').fadeIn();
                            contentArticle = 'contentbuilder';
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
                                customFieldGroup: data.custom_field_group_351,
                                lang:   '{{ $lang->id_001 }}',
                                object: '{{ $id }}',
                                resource: 'cms-article-family',
                                action: '{{ $action }}'
                            }
                        @else
                            var request =  {
                                customFieldGroup: data.custom_field_group_351,
                                lang: '{{ $lang->id_001 }}'
                            }
                        @endif

                        if(data.custom_field_group_351 != null){
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

                                    if(data.html != '')
                                    {
                                        $(".uniform").uniform();
                                        $('#headerCustomFields').fadeIn();
                                        $('#wrapperCustomFields').fadeIn();
                                    }
                               }
                            });
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
                $('#linkContent').fadeOut()
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
            else
            {
                $("[name=article]").val('');
            }
        });

        // hide every elements
        $('.wysiwyg-container').hide()
        $('.contentbuilder-container').hide()
        $('#headerContent').hide()
        $('#dateContent').hide()
        $('#titleContent').hide()
        $('#slugContent').hide()
        $('#sortingContent').hide()
        $('#linkContent').hide()
        $('#tagsContent').hide()
        $('#categoriesContent').hide()

        $('#headerCustomFields').hide()
        $('#wrapperCustomFields').hide()


        // set tab active
        @if($tab == 0)
        $('.tabbable li:eq(0) a').tab('show');
        @elseif($tab == 1)
        $('.tabbable li:eq(1) a').tab('show');
        @endif

        // if we have family value, throw event to show or hide elements
        if($("[name=family]").val())
        {
            $("[name=family]").trigger('change');
        }

        @if(isset($object->editor_type_351) && $object->editor_type_351 == 1)
        // set HTML wysiwyg component
        $('.wysiwyg').froalaEditor('html.set', $('[name=article]').val());
        @endif

        @if(isset($object->editor_type_351) && $object->editor_type_351 == 2)
        // set HTML contentbuilder component
        $('.iframe-contentbuilder').load(function() {
            $(this).get(0).contentWindow.getParentHtml('article');
        });
        @endif
    });

    <!-- Check slug -->
    $.checkSlug = function() {
        $.ajax({
            dataType:   'json',
            type:       'POST',
            url:        '{{ route('apiCheckSlugCmsArticle') }}',
            data:       {
                lang:   '{{ $lang->id_001 }}',
                slug:   $('[name=slug]').val(),
                id:     $('[name=id]').val()
            },
            headers:  {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:  function(data)
            {
                $("[name=slug]").val(data.slug);
            }
        });
    }
</script>