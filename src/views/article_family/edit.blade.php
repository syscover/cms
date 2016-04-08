@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- cms::article_family.edit -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.element-table/jquery.element-table.js') }}"></script>
    <!-- /cms::article_family.edit -->
@stop

@section('rows')
    <!-- cms::article_family.edit -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_351, 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_351, 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans_choice('pulsar::pulsar.date', 1), 'name' => 'date', 'value' => 1, 'checked' => $data->date, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => 1, 'checked' => $data->title, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.slug'), 'name' => 'slug', 'value' => 1, 'checked' => $data->slug, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans_choice('pulsar::pulsar.category', 1), 'name' => 'categories', 'value' => 1, 'checked' => $data->categories, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'value' => 1, 'checked' => $data->sorting, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => 1, 'checked' => $data->tags, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.link'), 'name' => 'link', 'value' => 1, 'checked' => isset($data->link)? $data->link : false, 'fieldSize' => 4])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => $object->editor_type_351, 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'fieldSize' => 5])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.field_group', 1), 'name' => 'customFieldGroup', 'value' => $object->custom_field_group_351, 'objects' => $customFieldGroups, 'idSelect' => 'id_025', 'nameSelect' => 'name_025', 'fieldSize' => 5])
    <!-- /cms::article_family.edit -->
@stop