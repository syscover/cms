@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- cms::article_family.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.element-table/jquery.element-table.js') }}"></script>
    <!-- /.cms::article_family.create -->
@stop

@section('rows')
    <!-- cms::article_family.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'value' => isset($object->id_351)? $object->id_351 : null,
        'fieldSize' => 2,
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_351)? $object->name_351 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans_choice('pulsar::pulsar.date', 1),
        'name' => 'date',
        'value' => 1,
        'checked' => old('date', isset($data->date)? $data->date : null),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans('pulsar::pulsar.title'),
                'name' => 'title',
                'value' => 1,
                'checked' => old('title', isset($data->title)? $data->title : null),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.slug'),
        'name' => 'slug',
        'value' => 1,
        'checked' => old('slug', isset($data->slug)? $data->slug : null),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans_choice('pulsar::pulsar.category', 1),
                'name' => 'categories',
                'value' => 1,
                'checked' => old('categories', isset($data->categories)? $data->categories : null),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.sorting'),
        'name' => 'sorting',
        'value' => 1,
        'checked' => old('sorting', isset($data->sorting)? $data->sorting : null),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans('cms::pulsar.tags'),
                'name' => 'tags',
                'value' => 1,
                'checked' => old('tags', isset($data->tags)? $data->tags : null),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.link'),
        'name' => 'link',
        'value' => 1,
        'checked' => old('link', isset($data->link)? $data->link : null),
        'fieldSize' => 4
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans('pulsar::pulsar.editor'),
        'name' => 'editor',
        'value' => old('editor', isset($object->editor_id_351)? $object->editor_id_351 : null),
        'objects' => $editors,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'fieldSize' => 5
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.field_group', 1),
        'name' => 'customFieldGroup',
        'value' => old('customFieldGroup', isset($object->field_group_id_351)? $object->field_group_id_351 : null),
        'objects' => $customFieldGroups,
        'idSelect' => 'id_025',
        'nameSelect' => 'name_025',
        'fieldSize' => 5
    ])
    <!-- /.cms::article_family.create -->
@stop