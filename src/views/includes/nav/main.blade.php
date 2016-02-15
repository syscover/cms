        <li{!! Miscellaneous::setCurrentOpenPage(['cms-article','cms-library','cms-article-family','cms-section','cms-category','cms-attachment-family']) !!}>
            <a href="javascript:void(0)"><i class="sys-icon-edit-write"></i>CMS</a>
            <ul class="sub-menu">
                @if(session('userAcl')->allows('cms-article', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-article') !!}><a href="{{ route('CmsArticle', [session('baseLang')->id_001]) }}"><i class="fa fa-file-text-o"></i>{{ trans_choice('pulsar::pulsar.article', 2) }}</a></li>
                @endif
                @if(session('userAcl')->allows('cms-category', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-category') !!}><a href="{{ route('CmsCategory', [session('baseLang')->id_001]) }}"><i class="fa fa-list-ol"></i>{{ trans_choice('pulsar::pulsar.category', 2) }}</a></li>
                @endif
                @if(session('userAcl')->allows('cms-section', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-section') !!}><a href="{{ route('CmsSection') }}"><i class="sys-icon-magnet"></i>{{ trans_choice('pulsar::pulsar.section', 2) }}</a></li>
                @endif
                @if(session('userAcl')->allows('cms-article-family', 'access'))
                    <li{!! Miscellaneous::setCurrentPage('cms-article-family') !!}><a href="{{ route('CmsArticleFamily') }}"><i class="fa fa-align-justify"></i>{{ trans_choice('cms::pulsar.article_family', 2) }}</a></li>
                @endif

            </ul>
        </li>