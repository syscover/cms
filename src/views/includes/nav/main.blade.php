        <li{!! Miscellaneous::setCurrentOpenPage(['cms-article','cms-article-families','cms-section']) !!}>
            <a href="javascript:void(0);"><i class="sys-icon-edit-write"></i>CMS</a>
            <ul class="sub-menu">
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-article-families', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-article-families') !!}><a href="{{ route('CmsArticleFamilies') }}"><i class="icon-align-justify"></i>{{ trans_choice('cms::pulsar.article_family', 2) }}</a></li>
                @endif
                @if(Session::get('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-section', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-section') !!}><a href="{{ route('CmsSection') }}"><i class="sys-icon-magnet"></i>{{ trans_choice('pulsar::pulsar.section', 2) }}</a></li>
                @endif
            </ul>
        </li>