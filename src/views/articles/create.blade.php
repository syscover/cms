@extends('pulsar::layouts.form', ['action' => 'store'])

@section('script')
    <!-- cms::categories.index -->
    <script type="text/javascript" src="{{ asset('packages/syscover/pulsar/vendor/tagsinput/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.tags-autocomplete').tagsInput({
                defaultText: '{{ trans('pulsar::pulsar.add_tag') }}',
                width: '100%',
                height: 'auto',
                autocomplete_url: [ { "id": "Netta rufina", "label": "Red-crested Pochard", "value": "Red-crested Pochard" }, { "id": "Sterna sandvicensis", "label": "Sandwich Tern", "value": "Sandwich Tern" }]
            });
        });
    </script>
    <!-- /cms::categories.index -->
@stop

@section('rows')
    <!-- cms::categories.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id',  'value' => Input::old('name', isset($object->id_355)? $object->id_355 : null), 'readOnly' => true, 'fieldSize' => 2])
    @include('pulsar::includes.html.form_image_group', ['label' => trans_choice('pulsar::pulsar.language', 1), 'name' => 'lang', 'nameImage' => $lang->name_001, 'value' => $lang->id_001, 'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001)])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.slug'), 'name' => 'title', 'value' => Input::old('title', isset($object->name_355)? $object->name_355 : null), 'maxLength' => '355', 'rangeLength' => '2,510', 'required' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'type' => 'number', 'value' => Input::old('sorting', isset($object->sorting_355)? $object->sorting_355 : null), 'maxLength' => '3', 'rangeLength' => '1,3', 'min' => '0', 'fieldSize' => 2])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => Input::old('tags', isset($object->tags_355)? $object->tags_355 : null), 'class' => 'tags-autocomplete'])
    <!-- /cms::categories.create -->
@stop