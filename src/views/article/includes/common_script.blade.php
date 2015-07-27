<script type="text/javascript">
    $(document).ready(function() {

        var contentArticle = null;

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
            imagesLoadURL: '{{ route('apiWysiwygCmsFile', ['type' => 'images']) }}',

            imageDeleteURL: '{{ route('apiWysiwygDeleteCmsFile') }}',
            imageDeleteParams: {_token: '{{ csrf_token() }}'},
            imageUploadURL: '{{ route('apiWysiwygUploadCmsFile', ['type' => 'images']) }}',
            imageUploadParams: {_token: '{{ csrf_token() }}'},
            fileUploadURL: '{{ route('apiWysiwygUploadCmsFile', ['type' => 'files']) }}',
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

        $("[name=title]").on('change', function(){
            $("[name=slug]").val(getSlug($("[name=title]").val(),{
                separator: '-',
                lang: '{{ $lang->id_001 }}'
            }));
            $.checkSlug();
        });

        $("[name=slug]").on('change', function(){
            $("[name=slug]").val(getSlug($("[name=slug]").val(),{
                separator: '-',
                lang: '{{ $lang->id_001 }}'
            }));
            $.checkSlug();
        });

        $("#recordForm").on('submit', function(event){
            //event.preventDefault();
            if(contentArticle == 'wysiwyg')
            {
                $("[name=article]").val($('[name=wysiwyg]').val());
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

        // if we have family value, throw event
        if($("[name=family]").val())
        {
            $("[name=family]").trigger('change');
        }

        @if(isset($object->editor_type_351) && $object->editor_type_351 == 1)
        // set HTML wysiwyg component
        $('.wysiwyg').editable('setHTML', $('[name=article]').val());
        @endif

        @if(isset($object->editor_type_351) && $object->editor_type_351 == 2)
        // set HTML contentbuilder component
        $('.iframe-contentbuilder').load(function() {
            $(this).get(0).contentWindow.getParentHtml('article');
        });
        @endif

        // Licencia froala
        $('.froala-box').children('div:eq(2)').hide();


        //==========================
        // Start attachment scripts
        //==========================
        @if(isset($attachments) && count($attachments) > 0)
            $('#library-placeholder').hide();
            $.setAttachmentActions();
            $.setEventSaveAttachmentProperties();
        @endif
        $.dragDropEffects();

        $('#attachment-library-content').getFile(
            {
                urlPlugin:          '/packages/syscover/pulsar/vendor',
                folder:             '{{ config('cms.libraryFolder') }}',
                tmpFolder:          '{{ config('cms.libraryFolder') }}',
                multiple:           true,
                activateTmpDelete:  false
            },
            function(dataUploaded)
            {
                if(dataUploaded.success && Array.isArray(dataUploaded.files))
                {
                    $.storeLibrary(dataUploaded.files);
                }
            }
        );
    });

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

    // store files in library database
    $.storeLibrary = function(files) {
        $.ajax({
            url: '{{ route('storeCmsLibrary') }}',
            data:       {
                files: files
            },
            headers:  {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type:		'POST',
            dataType:	'json',
            success: function(libraryDataStored)
            {
                // Variable $action defined in edit.blade.php with a include
                @if(isset($action) && $action == 'edit')
                    var toStoreAttachmentDB = true;
                @else
                    var toStoreAttachmentDB = false;
                @endif

                // stored function
                if(toStoreAttachmentDB)
                {
                    $.storeAttachment(libraryDataStored.files);
                }
                else
                {
                    if($('.sortable li').length == 0 && libraryDataStored.files.length > 0) $('#library-placeholder').hide();

                    libraryDataStored.files.forEach(function(file, index, array){
                        $('.sortable').loadTemplate('#file', {
                            image:              file.type.id == 1? '{{ config('cms.tmpFolder') }}/' + file.fileName : '{{ config('cms.iconsFolder') }}/' + file.type.icon,
                            fileName:           file.fileName,
                            isImage:            file.type.id == 1? 'is-image' : 'no-image'
                        }, { prepend:true });
                    });

                    // set input hidden with attachment data
                    var attachments = JSON.parse($('[name=attachments]').val());
                    $('[name=attachments]').val(JSON.stringify(attachments.concat(libraryDataStored.files)));

                    $.shortingElements();
                    $.setAttachmentActions();
                    $.setEventSaveAttachmentProperties();
                }
            }
        });
    };

    $.storeAttachment = function(files) {
        $.ajax({
            url: '{{ route('storeCmsAttachment', ['article'=> isset($object->id_355)? $object->id_355 : null , 'lang'=> $lang->id_001]) }}',
            data:       {
                attachments:    files,
                lang:           $('[name=lang]').val(),
                article:        $('[name=id]').val()
            },
            headers:  {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type:		'POST',
            dataType:	'json',
            success: function(attachmentDataStored)
            {
                if(attachmentDataStored.success)
                {
                    var newAttachments = [];
                    if($('.sortable li').length == 0 && attachmentDataStored.attachments.length > 0) $('#library-placeholder').hide();

                    attachmentDataStored.attachments.forEach(function(attachment, index, array){

                        // parse data atributtes to json
                        var attachmentData = JSON.parse(attachment.data_357);

                        newAttachments.push({
                            id:                 attachment.id_357,
                            type:               {id: attachment.type_357, name: attachment.type_text_357},
                            mime:               attachment.mime_357,
                            family:             null,
                            folder:             '{{ config('cms.attachmentFolder') }}/' + attachment.article_357 + '/' + attachment.lang_357,
                            fileName:           attachment.file_name_357,
                            library:            attachment.library_357,
                            libraryFileName:    attachment.library_file_name_357,
                            name:               null
                        });

                        $('.sortable').loadTemplate('#file', {
                            id:                 attachment.id_357,
                            image:              attachment.type_357 == 1? '{{ config('cms.attachmentFolder') }}/' + attachment.article_357 + '/' + attachment.lang_357 + '/' + attachment.file_name_357 : '{{ config('cms.iconsFolder') }}/' + attachmentData.icon,
                            fileName:           attachment.file_name_357,
                            isImage:            attachment.type_357 == 1? 'is-image' : 'no-image'
                        }, { prepend:true });

                        // put id across loadTemple and replace id data-id for id attribute, to detect script is a stored database element
                        $('#' + attachment.id_357).data('id', attachment.id_357).removeAttr('id');
                    });

                    // set input hidden with attachment data
                    var attachments = JSON.parse($('[name=attachments]').val());
                    $('[name=attachments]').val(JSON.stringify(attachments.concat(newAttachments)));

                    $.shortingElements();
                    $.setAttachmentActions();
                    $.setEventSaveAttachmentProperties();
                }
            }
        });
    };

    // set save event attachment element
    $.setEventSaveAttachmentProperties = function() {
        $('.attachment-family, .image-name').off('focus').on('focus', function () {
            // get previous value from select
            $(this).data('previous', $(this).val());
        }).off('change').on('change', function(){
            $(this).addClass('changed');
        });

        $('.save-attachment').off('click').on('click', function(){
            if($(this).closest('li').find('select').val() != '' && $(this).closest('li').find('.attachment-family').hasClass('changed'))
            {
                var url = '{{ route('apiShowCmsAttachmentFamily', ['id' => 'id', 'api' => 1]) }}';
                var that = this;

                $.ajax({
                    url:    url.replace('id', $(this).closest('li').find('select').val()),
                    headers:  {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type:		'POST',
                    dataType:	'json',
                    success: function(data)
                    {
                        if($(that).closest('li').find('img').hasClass('is-image') && data.width_353 != null && data.height_353 != null)
                        {
                            $.getFile(
                                {
                                    urlPlugin:  '/packages/syscover/pulsar/vendor',
                                    folder:     $(that).closest('li').data('id') == undefined? '{{ config('cms.tmpFolder') }}' : '{{ config('cms.attachmentFolder') }}/{{ isset($object->id_355)? $object->id_355 : null }}/{{ $lang->id_001 }}',
                                    srcFolder:  '{{ config('cms.libraryFolder') }}',
                                    srcFile:    $(that).closest('li').find('.file-name').html(),
                                    crop: {
                                        active:     true,
                                        width:      data.width_353,
                                        height:     data.height_353,
                                        overwrite:  true
                                    }
                                },
                                function(response)
                                {
                                    $(that).closest('li').find('img').attr('src', response.folder + '/' + response.name + '?' + Math.floor((Math.random() * 1000) + 1));
                                    $(that).closest('li').find('.family-name').html(data.name_353);
                                    $(that).closest('li').find('.attachment-family').removeClass('changed');
                                    $(that).closest('.attachment-item').toggleClass('cover');
                                    $(that).closest('li').find('.attachment-family').data('previous', $(that).closest('li').find('.attachment-family').val());
                                    $.setFamilyAttachment($(that).closest('li').find('.file-name').html(), data.id_353);
                                    $.setNameAttachment(that);
                                    if($(that).closest('li').data('id') != undefined) $.updateAttachment(that);
                                }
                            );
                        }
                        else
                        {
                            // set family without getFile
                            $(that).closest('li').find('.family-name').html(data.name_353);
                            $(that).closest('li').find('.attachment-family').removeClass('changed');
                            $(that).closest('.attachment-item').toggleClass('cover');
                            $(that).closest('li').find('.attachment-family').data('previous', $(that).closest('li').find('.attachment-family').val());
                            $.setFamilyAttachment($(that).closest('li').find('.file-name').html(), data.id_353);
                            $.setNameAttachment(that);
                            if($(that).closest('li').data('id') != undefined) $.updateAttachment(that);
                        }
                    }
                });
            }
            else
            {
                if($(this).closest('li').find('.attachment-family').hasClass('changed'))
                {
                    $(this).closest('li').find('.family-name').html('');
                    $(this).closest('li').find('.attachment-family').removeClass('changed');
                    $(this).closest('li').find('.attachment-family').data('previous', $(this).closest('li').find('.attachment-family').val());
                    $.setFamilyAttachment($(this).closest('li').find('.file-name').html(), '');
                }
                $(this).closest('.attachment-item').toggleClass('cover');
                $.setNameAttachment(this);
                if($(this).closest('li').data('id') != undefined) $.updateAttachment(this);
            }
        });
    };

    // update elements on database
    $.updateAttachment = function(element) {
        if($(element).closest('li').data('id') != undefined)
        {
            var attachments         = JSON.parse($('[name=attachments]').val());
            var attachmentToUpdate  = null;

            attachments.forEach(function(attachment, index, array){
                if(attachment.id == $(element).closest('li').data('id'))
                {
                    attachmentToUpdate = attachment;
                }
            });
            var url = '{{ route('updateCmsAttachment', ['article'=> isset($object->id_355)? $object->id_355 : null , 'lang'=> $lang->id_001, 'id' => 'id']) }}';

            // update attachment across ajax
            $.ajax({
                url:    url.replace('id', $(element).closest('li').data('id')),
                headers:  {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    _method: 'PUT',
                    attachment: attachmentToUpdate
                },
                type:		'POST',
                dataType:	'json',
                success: function(data){}
            });
        }
    };

    // set events on attachment elements
    $.setAttachmentActions = function() {

        // set button actions from li elements
        $('.attachment-action span').off('click').on('click', function() {
            $(this).closest('.attachment-item').toggleClass('cover');
        });

        $('button.open-ov').off('click').on('click', function() {
            $(this).closest('.attachment-item').toggleClass('cover');
        });

        $('button.close-ov').off('click').on('click', function() {
            $(this).closest('.attachment-item').toggleClass('cover');
        });

        $('div.close-icon').off('click').on('click', function() {
            $(this).closest('.attachment-item').toggleClass('cover');
            $(this).closest('li').find('.attachment-family').removeClass('changed').val($(this).closest('li').find('.attachment-family').data('previous'));
            $(this).closest('li').find('.image-name').removeClass('changed').val($(this).closest('li').find('.image-name').data('previous'));
        });

        // sorting elements
        $(".sortable").sortable({
            stop: function(event, ui){
                $.shortingElements();
            }
        });

        // remove li elements
        $('.remove-img').off('click').on('click', function() {

            $(this).closest('li').fadeOut( "slow", function() {

                var that = this;

                // check that attachment have id and is stored in database
                if($(this).data('id') != undefined)
                {
                    // delete file from attachment folder
                    var url = '{{ route('deleteCmsAttachment', ['lang'=> $lang->id_001, 'id' => 'id']) }}';
                    $.ajax({
                        url:    url.replace('id', $(this).data('id')),
                        headers:  {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {_method: 'DELETE'},
                        type:		'POST',
                        dataType:	'json',
                        success: function(data)
                        {
                            if(data.success)
                            {
                                $.removeAttachment(that);
                            }
                        }
                    });
                }
                else
                {
                    // delete file from tmp folder
                    $.ajax({
                        url:    '{{ route('deleteTmpCmsAttachment') }}',
                        headers:  {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            _method:    'DELETE',
                            fileName:   $(this).find('.file-name').html()
                        },
                        type:		'POST',
                        dataType:	'json',
                        success: function(data)
                        {
                            if(data.success)
                            {
                                $.removeAttachment(that);
                            }
                        }
                    });
                }
            });
        });
    };

    // Shorting elements
    $.shortingElements = function() {
        var attachments   = JSON.parse($('[name=attachments]').val());
        var hasId         = false;

        $('.sortable li').each(function(i) {
            var that = this;
            attachments.forEach(function(attachment, j, attachments){
                if($(that).find('.file-name').html() == attachment.fileName)
                {
                    attachment.sorting = i;
                }
                if(attachment.id != undefined)
                {
                    hasId = true;
                }
            });
        });

        if(hasId)
        {
            // update attachment across ajax
            $.ajax({
                url:    '{{ route('updatesCmsAttachment', ['article'=> isset($object->id_355)? $object->id_355 : null ,'lang'=> $lang->id_001]) }}',
                headers:  {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    _method: 'PUT',
                    attachments: attachments
                },
                type:		'POST',
                dataType:	'json',
                success: function(data)
                {
                    if(data.success)
                    {
                        $('[name=attachments]').val(JSON.stringify(attachments));
                    }
                }
            });
        }
        else
        {
            $('[name=attachments]').val(JSON.stringify(attachments));
        }
    };
</script>