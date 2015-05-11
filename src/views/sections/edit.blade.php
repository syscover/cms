@extends('pulsar::layouts.form', ['action' => 'update'])

@section('rows')
    <!-- cms::sections.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_350, 'maxLength' => '30', 'rangeLength' => '2,30', 'required' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_350, 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    <!-- /cms::sections.create -->
@stop