@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('script')
    @parent
    <!-- hotels::articles.index -->
    <script type="text/javascript">
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    'iDisplayStart' : {{ $offset }},
                    'aoColumnDefs': [
                        { 'visible': false, "bSearchable": false, 'aTargets': [1]}, // hidden column 1 and prevents search on column 1
                        { "iDataSort": 1, "aTargets": [2] }, // sort column 2 according hidden column 1 data
                        { 'bSortable': false, 'aTargets': [5,6]},
                        { 'sClass': 'checkbox-column', 'aTargets': [5]},
                        { 'sClass': 'align-center', 'aTargets': [6]}
                    ],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "{{ route('jsonData' . $routeSuffix, [Session::get('baseLang')]) }}"
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- hotels::articles.index -->
@stop

@section('tHead')
    <!-- hotels::articles.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th>{{ trans('cms::pulsar.publish') }}</th>
        <th data-class="expand">{{ trans('cms::pulsar.publish') }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.language', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.section', 1) }}</th>
        <th>{{ trans('pulsar::pulsar.name') }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /hotels::articles.index -->
@stop