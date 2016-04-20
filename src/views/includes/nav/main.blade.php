<li{!! is_current_resource(['cms-article','cms-library','cms-article-family','cms-section','cms-category','cms-attachment-family']) !!}>
    <a href="javascript:void(0)"><i class="sys-icon-edit-write"></i>CMS</a>
    <ul class="sub-menu">
        @if(is_allowed('cms-article', 'access'))
            <li{!! is_current_resource('cms-article') !!}><a href="{{ route('cmsArticle', [session('baseLang')->id_001]) }}"><i class="fa fa-file-text-o"></i>{{ trans_choice('pulsar::pulsar.article', 2) }}</a></li>
        @endif
        @if(is_allowed('cms-category', 'access'))
            <li{!! is_current_resource('cms-category') !!}><a href="{{ route('cmsCategory', [session('baseLang')->id_001]) }}"><i class="fa fa-list-ol"></i>{{ trans_choice('pulsar::pulsar.category', 2) }}</a></li>
        @endif
        @if(is_allowed('cms-section', 'access'))
            <li{!! is_current_resource('cms-section') !!}><a href="{{ route('cmsSection') }}"><i class="sys-icon-magnet"></i>{{ trans_choice('pulsar::pulsar.section', 2) }}</a></li>
        @endif
        @if(is_allowed('cms-article-family', 'access'))
            <li{!! is_current_resource('cms-article-family') !!}><a href="{{ route('cmsArticleFamily') }}"><i class="fa fa-align-justify"></i>{{ trans_choice('cms::pulsar.article_family', 2) }}</a></li>
        @endif
    </ul>
</li>