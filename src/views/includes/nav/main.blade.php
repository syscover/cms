        <li{!! Miscellaneous::setCurrentOpenPage(['cms-article','cms-article-families','cms-section','cms-category']) !!}>
            <a href="javascript:void(0);"><i class="sys-icon-edit-write"></i>CMS</a>
            <ul class="sub-menu">
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-article', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-article') !!}><a href="{{ route('CmsArticles', [session('baseLang')]) }}"><i class="icon-file-text-alt"></i>{{ trans_choice('pulsar::pulsar.article', 2) }}</a></li>
                @endif
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-article-families', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-article-families') !!}><a href="{{ route('CmsArticleFamilies') }}"><i class="icon-align-justify"></i>{{ trans_choice('cms::pulsar.article_family', 2) }}</a></li>
                @endif
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-section', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-section') !!}><a href="{{ route('CmsSection') }}"><i class="sys-icon-magnet"></i>{{ trans_choice('pulsar::pulsar.section', 2) }}</a></li>
                @endif
                @if(session('userAcl')->isAllowed(Auth::user()->profile_010, 'cms-category', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-category') !!}><a href="{{ route('CmsCategories', [session('baseLang')]) }}"><i class="icon-list-ol"></i>{{ trans_choice('pulsar::pulsar.category', 2) }}</a></li>
                @endif
            </ul>
        </li>