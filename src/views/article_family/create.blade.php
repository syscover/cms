@extends('pulsar::layouts.form', ['action' => 'store'])

@section('script')
@parent
    <!-- cms::article_family.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.element-table/jquery.element-table.js') }}"></script>
    <!-- /cms::article_family.create -->
@stop

@section('rows')
    <!-- cms::article_family.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.date'), 'name' => 'date', 'value' => 1, 'checked' => Input::old('date'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => 1, 'checked' => Input::old('title'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.slug'), 'name' => 'slug', 'value' => 1, 'checked' => Input::old('slug'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans_choice('pulsar::pulsar.category', 1), 'name' => 'categories', 'value' => 1, 'checked' => Input::old('categories'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'value' => 1, 'checked' => Input::old('sorting'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => 1, 'checked' => Input::old('tags'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => Input::old('editor'), 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'fieldSize' => 5])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.field_group', 1), 'name' => 'customFieldGroup', 'value' => Input::old('customFieldGroup'), 'objects' => $customFieldGroups, 'idSelect' => 'id_025', 'nameSelect' => 'name_025', 'fieldSize' => 5])
    <!-- /cms::article_family.create -->
@stop