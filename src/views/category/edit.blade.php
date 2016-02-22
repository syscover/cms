@extends('pulsar::layouts.form', ['action' => 'update'])

@section('head')
    @parent
    <!-- cms::category.edit -->
    @include('pulsar::includes.js.delete_translation_record')
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/speakingurl/speakingurl.min.js') }}"></script>

    @include('cms::category.includes.common_script', ['action' => 'create'])
    <!-- ./cms::category.edit -->
@stop

@section('rows')
    <!-- cms::category.edit -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id',  'value' => $object->id_352, 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_image_group', ['label' => trans_choice('pulsar::pulsar.language', 1), 'name' => 'lang', 'nameImage' => $lang->name_001, 'value' => $lang->id_001, 'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001)])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => $object->name_352, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.slug'), 'name' => 'slug', 'value' => $object->slug_352, 'maxLength' => '255', 'rangeLength' => '2,255', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'type' => 'number', 'value' => $object->sorting_352, 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
    <!-- ./cms::category.edit -->
@stop