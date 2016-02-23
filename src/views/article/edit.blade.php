@extends('pulsar::layouts.tab', ['tabs' => [
        ['id' => 'box_tab1', 'name' => trans_choice('pulsar::pulsar.article', 1)],
        ['id' => 'box_tab2', 'name' => trans_choice('pulsar::pulsar.attachment', 2)]
    ]])

@section('head')
    @parent
    @include('pulsar::includes.js.delete_translation_record')
    <!-- cms::articles.edit -->
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

    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/attachment/js/attachment-library.js') }}"></script>
    @include('pulsar::includes.js.attachment', [
        'action'            => 'edit',
        'resource'          => 'cms-article',
        'routesConfigFile'  => 'cms',
        'objectId'          => $object->id_355])

    @include('pulsar::includes.html.froala_references')

    @include('cms::article.includes.common_script', ['action' => 'edit'])
    <!-- /cms::articles.edit -->
@stop

@section('layoutTabHeader')
    @include('pulsar::includes.html.form_record_header', ['action' => 'update'])
@stop
@section('layoutTabFooter')
    @include('pulsar::includes.html.form_record_footer', ['action' => 'update'])
@stop

@section('box_tab1')
    <!-- cms::articles.edit -->
    <div class="row">
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id',  'value' => $object->id_355, 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 4])
            @include('pulsar::includes.html.form_image_group', ['label' => trans_choice('pulsar::pulsar.language', 1), 'name' => 'lang', 'nameImage' => $object->lang_name, 'value' => $object->lang_id, 'url' => asset('/packages/syscover/pulsar/storage/langs/' . $object->lang_image), 'labelSize' => 4, 'fieldSize' => 8])
            @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.section', 1), 'id' => 'section', 'name' => 'section', 'value' => $object->section_355, 'objects' => $sections, 'idSelect' => 'id_350', 'nameSelect' => 'name_350', 'class' => 'select2', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-section-outer-container']])
            @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.family', 1), 'id' => 'family', 'name' => 'family', 'value' => $object->family_355, 'objects' => $families, 'idSelect' => 'id_351', 'nameSelect' => 'name_351', 'class' => 'select2', 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['language' => config('app.locale'), 'width' => '100%', 'error-placement' => 'select2-family-outer-container']])
        </div>
        <div class="col-md-6">
            @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.author'), 'name' => 'authorName',  'value' => $object->author_name . ' ' . $object->author_surname, 'readOnly' => true, 'labelSize' => 4, 'fieldSize' => 8])
            <input type="hidden" name="author" value="{{ $object->author }}">
            @include('pulsar::includes.html.form_select_group', ['label' => trans('cms::pulsar.status'), 'name' => 'status', 'value' => $object->status_355, 'objects' => $statuses, 'idSelect' => 'id', 'nameSelect' => 'name', 'labelSize' => 4, 'fieldSize' => 8, 'required' => true])
            @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('cms::pulsar.publish'), 'name' => 'publish', 'id' => 'idPublish', 'value' => date(config('pulsar.datePattern') . ' H:i', $object->publish_355), 'labelSize' => 4, 'fieldSize' => 8, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')) . ' HH:mm', 'locale' => config('app.locale')]])
        </div>
    </div>
    @include('pulsar::includes.html.form_section_header', ['label' => trans('cms::pulsar.content'), 'icon' => 'fa fa-inbox', 'containerId' => 'headerContent'])
    @include('pulsar::includes.html.form_datetimepicker_group', ['label' => trans('pulsar::pulsar.date'), 'containerId' => 'dateContent', 'name' => 'date', 'id' => 'idDate', 'value' => date(config('pulsar.datePattern')), 'required' => true, 'fieldSize' => 4, 'data' => ['format' => Miscellaneous::convertFormatDate(config('pulsar.datePattern')), 'locale' => config('app.locale')]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.title'), 'containerId' => 'titleContent', 'name' => 'title', 'value' => $object->title_355, 'maxLength' => '510', 'rangeLength' => '2,510', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.slug'), 'containerId' => 'slugContent', 'name' => 'slug', 'value' => $object->slug_355, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.category', 2), 'containerId' => 'categoriesContent', 'name' => 'categories[]', 'value' => $object->getCategories, 'objects' => $categories, 'idSelect' => 'id_352', 'nameSelect' => 'name_352', 'multiple' => true, 'class' => 'col-md-12 select2', 'fieldSize' => 10, 'data' => ['placeholder' => trans('pulsar::pulsar.select_category'), 'width' => '100%']])
    @include('pulsar::includes.html.form_text_group', ['fieldSize' => 6, 'label' => trans('pulsar::pulsar.link'), 'containerId' => 'linkContent', 'name' => 'link', 'value' => $object->link_355, 'maxLength' => '255', 'rangeLength' => '2,255', 'inputs' => [
        ['fieldSize' => 2, 'class' => 'uniform', 'type' => 'checkbox' ,'label' => trans('pulsar::pulsar.new_window'), 'name' => 'blank', 'value' => 1, 'checked' => $object->blank_355]
    ]])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'containerId' => 'sortingContent', 'name' => 'sorting', 'type' => 'number', 'value' => $object->sorting_355, 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.tags'), 'containerId' => 'tagsContent', 'name' => 'tags', 'placeholder' => trans('cms::pulsar.write_tag')])
    @include('pulsar::includes.html.form_wysiwyg_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'wysiwyg', 'labelSize' => 2, 'fieldSize' => 10])
    @include('pulsar::includes.html.form_contentbuilder_group', ['label' => trans_choice('pulsar::pulsar.article', 1), 'name' => 'contentbuilder', 'theme' => 'default', 'labelSize' => 2, 'fieldSize' => 10])
    <textarea name="article" class="hidden">{{ $object->article_355 }}</textarea>

    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('pulsar::pulsar.custom_field', 2), 'icon' => 'fa fa-align-left', 'containerId' => 'headerCustomFields'])
    <div id="wrapperCustomFields"></div>

    @include('pulsar::includes.html.form_hidden', ['name' => 'dataObject', 'value' => $object->data_355])
    @include('pulsar::includes.html.form_hidden', ['name' => 'jsonTags'])
    @include('pulsar::includes.html.form_hidden', ['name' => 'attachments', 'value' => $attachmentsInput])
    <!-- /cms::articles.edit -->
@stop

@section('box_tab2')
    @include('pulsar::includes.html.attachment', [
         'action'            => 'edit',
         'routesConfigFile'  => 'cms'])
@stop

@section('endBody')
    <!--TODO: Implementar botón para añadir fotografías desde la librería-->
    <div id="attachment-library-mask">
        <div id="attachment-library-content">
            {{ trans('pulsar::pulsar.drag_files') }}
        </div>
    </div>
@stop