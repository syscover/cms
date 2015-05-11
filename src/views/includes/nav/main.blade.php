        <li{!! Miscellaneous::setCurrentOpenPage(['cms-article','cms-family','cms-section']) !!}>
            <a href="javascript:void(0);"><i class="sys-icon-edit-write"></i>CMS</a>
            <ul class="sub-menu">
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-article', 'access'))
                    <li{{ Miscellaneous::setCurrentPage('cms-article') }}><a href="#"><i class="icomoon-icon-truck"></i>{{ trans_choice('pulsar::pulsar.article', 2) }}</a></li>
                @endif
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-family', 'access'))
                    <li{{ Miscellaneous::setCurrentPage('cms-family') }}><a href="#"><i class="icomoon-icon-truck"></i>{{ trans_choice('pulsar::pulsar.family', 2) }}</a></li>
                @endif
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-section', 'access'))
                    <li{{ Miscellaneous::setCurrentPage('cms-section') }}><a href="{{ route('CmsSection') }}"><i class="sys-icon-magnet"></i>{{ trans_choice('pulsar::pulsar.section', 2) }}</a></li>
                @endif
            </ul>
        </li>