@extends('pulsar::layouts.form')

@section('head')
    @parent
    <!-- /cms::category.create -->
    <script src="{{ asset('packages/syscover/pulsar/vendor/speakingurl/speakingurl.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // launch slug function when change title and slug
            $("[name=name], [name=slug]").on('change', function(){
                $("[name=slug]").val(getSlug($(this).val(),{
                    separator: '-',
                    lang: '{{ $lang->id_001 }}'
                }))
                $.checkSlug()
            })
        })

        $.checkSlug = function() {
            $.ajax({
                dataType:   'json',
                type:       'POST',
                url:        '{{ route('apiCheckSlugCmsCategory') }}',
                data:       {
                    lang:   '{{ $lang->id_001 }}',
                    slug:   $('[name=slug]').val(),
                    id:     $('[name=id]').val()
                },
                headers:  {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success:  function(data)
                {
                    $("[name=slug]").val(data.slug)
                }
            })
        }
    </script>
    <!-- /cms::category.create -->
@stop

@section('rows')
    <!-- cms::category.create -->
    @include('pulsar::includes.html.form_text_group', [
        'label' => 'ID',
        'name' => 'id',
        'value' => old('name', isset($object->id_352)? $object->id_352 : null),
        'readOnly' => true,
        'fieldSize' => 2
    ])
    @include('pulsar::includes.html.form_image_group', [
        'label' => trans_choice('pulsar::pulsar.language', 1),
        'name' => 'lang',
        'nameImage' => $lang->name_001,
        'value' => $lang->id_001,
        'url' => asset('/packages/syscover/pulsar/storage/langs/' . $lang->image_001)
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.name'),
        'name' => 'name',
        'value' => old('name', isset($object->name_352)? $object->name_352 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.slug'),
        'name' => 'slug',
        'value' => old('slug', isset($object->slug_352)? $object->slug_352 : null),
        'maxLength' => '255',
        'rangeLength' => '2,255',
        'required' => true
    ])
    @include('pulsar::includes.html.form_text_group', [
        'label' => trans('pulsar::pulsar.sorting'),
        'name' => 'sorting',
        'type' => 'number',
        'value' => old('sorting', isset($object->sorting_352)? $object->sorting_352 : null),
        'maxLength' => '3',
        'rangeLength' => '1,3',
        'min' => '0',
        'fieldSize' => 2
    ])
    <!-- /cms::category.create -->
@stop