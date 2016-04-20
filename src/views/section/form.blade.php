@extends('pulsar::layouts.form')

@section('rows')
    <!-- cms::section.create -->
    @include('pulsar::includes.html.form_text_group', [
        'fieldSize' => 2,
        'label' => 'ID',
        'name' => 'id',
        'value' => old('id', isset($object->id_350)? $object->id_350 : null),
        'maxLength' => '30',
        'rangeLength' => '2,30',
        'required' => true,
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_350)? $object->name_350 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_select_group', [
        'fieldSize' => 4,
        'label' => trans_choice('pulsar::pulsar.family', 1),
        'name' => 'family',
        'value' => old('family', isset($object->article_family_350)? $object->article_family_350 : null),
        'objects' => $families,
        'idSelect' => 'id_351',
        'nameSelect' => 'name_351'
    ])
    <!-- /.cms::section.create -->
@stop