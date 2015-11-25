@extends('pulsar::layouts.form', ['action' => 'store'])

@section('rows')
    <!-- cms::sections.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => Input::old('id'), 'maxLength' => '30', 'rangeLength' => '2,30', 'required' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.family', 1), 'name' => 'family', 'value' => Input::old('family'), 'objects' => $families, 'idSelect' => 'id_351', 'nameSelect' => 'name_351'])
    <!-- /cms::sections.create -->
@stop