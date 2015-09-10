@extends('pulsar::layouts.form', ['action' => 'update'])

@section('script')
    @parent
    <!-- cms::article_family.edit -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/jquery.element-table/jquery.element-table.js') }}"></script>
    <!-- /cms::article_family.edit -->
@stop

@section('rows')
    <!-- cms::article_family.edit -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_351, 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_351, 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.date'), 'name' => 'date', 'value' => 1, 'isChecked' => $data->date, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => 1, 'isChecked' => $data->title, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('cms::pulsar.slug'), 'name' => 'slug', 'value' => 1, 'isChecked' => $data->slug, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans_choice('pulsar::pulsar.category', 1), 'name' => 'categories', 'value' => 1, 'isChecked' => $data->categories, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'value' => 1, 'isChecked' => $data->sorting, 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => 1, 'isChecked' => $data->tags, 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => $object->editor_type_351, 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5])
    @include('pulsar::includes.html.form_section_header', ['label' => trans_choice('cms::pulsar.field', 2), 'icon' => 'fa fa-align-left'])
    @include('pulsar::includes.html.form_element_table_group', [
        'id'        => 'fields',
        'label'     => trans_choice('cms::pulsar.field', 1),
        'icon'      => 'fa fa-align-left',
        'dataJson'  => $customFields,
        'thead'     => [(object)['class' => null, 'data' => trans_choice('pulsar::pulsar.label', 1)], (object)['class' => null, 'data' => trans('pulsar::pulsar.name')], (object)['class' => null, 'data' => trans('pulsar::pulsar.type')], (object)['class' => null, 'data' => trans_choice('pulsar::pulsar.size', 2)]],
        'tbody'     => [
                (object)['include' => 'pulsar::includes.html.form_text_group', 'properties' => ['label' => trans_choice('pulsar::pulsar.label', 1), 'name' => 'label', 'required' => true, 'maxLength' => '50', 'rangeLength' => '2,50']],
                (object)['include' => 'pulsar::includes.html.form_text_group', 'properties' => ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'required' => true, 'maxLength' => '15', 'rangeLength' => '2,15']],
                (object)['include' => 'pulsar::includes.html.form_select_group', 'properties' => ['label' => trans('pulsar::pulsar.type'), 'name' => 'type', 'value' => Input::old('editor'), 'objects' => $types, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true]],
                (object)['include' => 'pulsar::includes.html.form_text_group', 'properties' => ['label' => trans_choice('pulsar::pulsar.size', 1), 'name' => 'size', 'required' => true, 'maxLength' => '2', 'fieldSize' => 2, 'type' => 'number', 'min' => "1", 'max'=> "10"]],
            ]
        ])
    <!-- /cms::article_family.edit -->
@stop