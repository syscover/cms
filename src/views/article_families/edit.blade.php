@extends('pulsar::layouts.form', ['action' => 'update'])

@section('rows')
    <!-- cms::article_families.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'value' => $object->id_351, 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_351, 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.width') . ' (px)', 'name' => 'width', 'value' => $object->image_width_351, 'fieldSize' => 2, 'type' => 'number', 'inputs' => [
            ['label' => trans('pulsar::pulsar.height') . ' (px)', 'name' => 'height', 'value' => $object->image_height_351, 'fieldSize' => 2, 'type' => 'number']
        ]])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => $object->editor_type_351, 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5, 'required' => true])
    <!-- /cms::article_families.create -->
@stop