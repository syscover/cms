@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- cms::articles.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'displayStart' : {{ $offset }},
                    'sorting': [[0, 'desc']],
                    'columnDefs': [
                        { 'visible': false, 'searchable': false, 'targets': [1]}, // hidden column 1 and prevents search on column 1
                        { 'dataSort': 1, 'targets': [2] }, // sort column 2 according hidden column 1 data
                        { 'sortable': false, 'targets': [7,8]},
                        { 'class': 'checkbox-column', 'targets': [7]},
                        { 'class': 'align-center', 'targets': [6,8]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('jsonData' . ucfirst($routeSuffix), [session('baseLang')->id_001]) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- cms::articles.index -->
@stop

@section('tHead')
    <!-- cms::articles.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th>{{ trans('cms::pulsar.publish') }}</th>
        <th data-class="expand">{{ trans('cms::pulsar.publish') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.language', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.section', 1) }}</th>
        <th>{{ trans('pulsar::pulsar.title') }}</th>
        <th data-hide="phone">{{ trans_choice('pulsar::pulsar.sorting', 1) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /cms::articles.index -->
@stop