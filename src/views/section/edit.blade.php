@extends('pulsar::layouts.form', ['action' => 'update'])

@section('rows')
    <!-- cms::sections.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_350, 'maxLength' => '30', 'rangeLength' => '2,30', 'required' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_350, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    @include('pulsar::includes.html.form_select_group', ['label' => trans_choice('pulsar::pulsar.family', 1), 'name' => 'family', 'value' => $object->article_family_350, 'objects' => $families, 'idSelect' => 'id_351', 'nameSelect' => 'name_351'])
    <!-- /cms::sections.create -->
@stop