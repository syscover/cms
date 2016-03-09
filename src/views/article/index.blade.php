@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- cms::articles.index -->
    <script type="text/javascript">
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aaSorting': [[ 0, "desc" ]],
                    'aoColumnDefs': [
                        { 'visible': false, "bSearchable": false, 'aTargets': [1]}, // hidden column 1 and prevents search on column 1
                        { 'iDataSort': 1, 'aTargets': [2] }, // sort column 2 according hidden column 1 data
                        { 'bSortable': false, 'aTargets': [7,8]},
                        { 'sClass': 'checkbox-column', 'aTargets': [7]},
                        { 'sClass': 'align-center', 'aTargets': [6,8]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . ucfirst($routeSuffix), [session('baseLang')->id_001]) }}"
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