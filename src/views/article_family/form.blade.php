@extends('pulsar::layouts.form', ['action' => 'store'])

@section('head')
@parent
    <!-- cms::article_family.create -->
    <link rel="stylesheet" href="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/magnific-popup.css') }}">
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('packages/syscover/pulsar/vendor/jquery.element-table/jquery.element-table.js') }}"></script>
    <!-- ./cms::article_family.create -->
@stop

@section('rows')
    <!-- cms::article_family.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'fieldSize' => 2,
        'readOnly' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name'),
        'maxLength' => '100',
        'rangeLength' => '2,100',
        'required' => true
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans_choice('pulsar::pulsar.date', 1),
        'name' => 'date',
        'value' => 1,
        'checked' => old('date'),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans('pulsar::pulsar.title'),
                'name' => 'title',
                'value' => 1,
                'checked' => old('title'),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.slug'),
        'name' => 'slug',
        'value' => 1,
        'checked' => old('slug'),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans_choice('pulsar::pulsar.category', 1),
                'name' => 'categories',
                'value' => 1,
                'checked' => old('categories'),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.sorting'),
        'name' => 'sorting',
        'value' => 1,
        'checked' => old('sorting'),
        'fieldSize' => 4,
        'inputs' => [
            [
                'label' => trans('cms::pulsar.tags'),
                'name' => 'tags',
                'value' => 1,
                'checked' => old('tags'),
                'fieldSize' => 4
            ]
        ]
    ])
    @include('pulsar::includes.html.form_checkbox_group', [
        'label' => trans('pulsar::pulsar.link'),
        'name' => 'link',
        'value' => 1,
        'checked' => old('link'),
        'fieldSize' => 4
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans('pulsar::pulsar.editor'),
        'name' => 'editor',
        'value' => old('editor'),
        'objects' => $editors,
        'idSelect' => 'id',
        'nameSelect' => 'name',
        'fieldSize' => 5
    ])
    @include('pulsar::includes.html.form_select_group', [
        'label' => trans_choice('pulsar::pulsar.field_group', 1),
        'name' => 'customFieldGroup',
        'value' => old('customFieldGroup'),
        'objects' => $customFieldGroups,
        'idSelect' => 'id_025',
        'nameSelect' => 'name_025',
        'fieldSize' => 5
    ])
    <!-- ./cms::article_family.create -->
@stop