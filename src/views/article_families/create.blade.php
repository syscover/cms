@extends('pulsar::layouts.form', ['action' => 'store'])

@section('rows')
    <!-- cms::article_families.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => Input::old('editor'), 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true])
    <!-- /cms::article_families.create -->
@stop