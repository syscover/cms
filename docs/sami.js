
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">Syscover</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Syscover_Cms" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Cms.html">Cms</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Syscover_Cms_Controllers" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Cms/Controllers.html">Controllers</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Cms_Controllers_ArticleController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/ArticleController.html">ArticleController</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Controllers_ArticleFamilyController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/ArticleFamilyController.html">ArticleFamilyController</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Controllers_CategoryController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/CategoryController.html">CategoryController</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Controllers_FileController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/FileController.html">FileController</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Controllers_SectionController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/SectionController.html">SectionController</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Controllers_TagController" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Controllers/TagController.html">TagController</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Syscover_Cms_Libraries" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Cms/Libraries.html">Libraries</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Cms_Libraries_Miscellaneous" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Libraries/Miscellaneous.html">Miscellaneous</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Syscover_Cms_Models" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Syscover/Cms/Models.html">Models</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Syscover_Cms_Models_Article" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/Article.html">Article</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Models_ArticleFamily" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/ArticleFamily.html">ArticleFamily</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Models_ArticlesCategories" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/ArticlesCategories.html">ArticlesCategories</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Models_Category" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/Category.html">Category</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Models_Section" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/Section.html">Section</a>                    </div>                </li>                            <li data-name="class:Syscover_Cms_Models_Tag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Syscover/Cms/Models/Tag.html">Tag</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Syscover_Cms_CmsServiceProvider" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Syscover/Cms/CmsServiceProvider.html">CmsServiceProvider</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Syscover.html", "name": "Syscover", "doc": "Namespace Syscover"},{"type": "Namespace", "link": "Syscover/Cms.html", "name": "Syscover\\Cms", "doc": "Namespace Syscover\\Cms"},{"type": "Namespace", "link": "Syscover/Cms/Controllers.html", "name": "Syscover\\Cms\\Controllers", "doc": "Namespace Syscover\\Cms\\Controllers"},{"type": "Namespace", "link": "Syscover/Cms/Libraries.html", "name": "Syscover\\Cms\\Libraries", "doc": "Namespace Syscover\\Cms\\Libraries"},{"type": "Namespace", "link": "Syscover/Cms/Models.html", "name": "Syscover\\Cms\\Models", "doc": "Namespace Syscover\\Cms\\Models"},
            
            {"type": "Class", "fromName": "Syscover\\Cms", "fromLink": "Syscover/Cms.html", "link": "Syscover/Cms/CmsServiceProvider.html", "name": "Syscover\\Cms\\CmsServiceProvider", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\CmsServiceProvider", "fromLink": "Syscover/Cms/CmsServiceProvider.html", "link": "Syscover/Cms/CmsServiceProvider.html#method_boot", "name": "Syscover\\Cms\\CmsServiceProvider::boot", "doc": "&quot;Bootstrap the application services.&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\CmsServiceProvider", "fromLink": "Syscover/Cms/CmsServiceProvider.html", "link": "Syscover/Cms/CmsServiceProvider.html#method_register", "name": "Syscover\\Cms\\CmsServiceProvider::register", "doc": "&quot;Register the application services.&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/ArticleController.html", "name": "Syscover\\Cms\\Controllers\\ArticleController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_indexCustom", "name": "Syscover\\Cms\\Controllers\\ArticleController::indexCustom", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_customActionUrlParameters", "name": "Syscover\\Cms\\Controllers\\ArticleController::customActionUrlParameters", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_createCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_checkSpecialRulesToStore", "name": "Syscover\\Cms\\Controllers\\ArticleController::checkSpecialRulesToStore", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_storeCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_editCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_checkSpecialRulesToUpdate", "name": "Syscover\\Cms\\Controllers\\ArticleController::checkSpecialRulesToUpdate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_updateCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::updateCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_addToDeleteRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::addToDeleteRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_addToDeleteTranslationRecord", "name": "Syscover\\Cms\\Controllers\\ArticleController::addToDeleteTranslationRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_addToDeleteRecordsSelect", "name": "Syscover\\Cms\\Controllers\\ArticleController::addToDeleteRecordsSelect", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_apiCheckSlug", "name": "Syscover\\Cms\\Controllers\\ArticleController::apiCheckSlug", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleController", "fromLink": "Syscover/Cms/Controllers/ArticleController.html", "link": "Syscover/Cms/Controllers/ArticleController.html#method_apiGetCustomFields", "name": "Syscover\\Cms\\Controllers\\ArticleController::apiGetCustomFields", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/ArticleFamilyController.html", "name": "Syscover\\Cms\\Controllers\\ArticleFamilyController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleFamilyController", "fromLink": "Syscover/Cms/Controllers/ArticleFamilyController.html", "link": "Syscover/Cms/Controllers/ArticleFamilyController.html#method_createCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleFamilyController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleFamilyController", "fromLink": "Syscover/Cms/Controllers/ArticleFamilyController.html", "link": "Syscover/Cms/Controllers/ArticleFamilyController.html#method_storeCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleFamilyController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleFamilyController", "fromLink": "Syscover/Cms/Controllers/ArticleFamilyController.html", "link": "Syscover/Cms/Controllers/ArticleFamilyController.html#method_editCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleFamilyController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\ArticleFamilyController", "fromLink": "Syscover/Cms/Controllers/ArticleFamilyController.html", "link": "Syscover/Cms/Controllers/ArticleFamilyController.html#method_updateCustomRecord", "name": "Syscover\\Cms\\Controllers\\ArticleFamilyController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/CategoryController.html", "name": "Syscover\\Cms\\Controllers\\CategoryController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\CategoryController", "fromLink": "Syscover/Cms/Controllers/CategoryController.html", "link": "Syscover/Cms/Controllers/CategoryController.html#method_indexCustom", "name": "Syscover\\Cms\\Controllers\\CategoryController::indexCustom", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\CategoryController", "fromLink": "Syscover/Cms/Controllers/CategoryController.html", "link": "Syscover/Cms/Controllers/CategoryController.html#method_storeCustomRecord", "name": "Syscover\\Cms\\Controllers\\CategoryController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\CategoryController", "fromLink": "Syscover/Cms/Controllers/CategoryController.html", "link": "Syscover/Cms/Controllers/CategoryController.html#method_updateCustomRecord", "name": "Syscover\\Cms\\Controllers\\CategoryController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/FileController.html", "name": "Syscover\\Cms\\Controllers\\FileController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\FileController", "fromLink": "Syscover/Cms/Controllers/FileController.html", "link": "Syscover/Cms/Controllers/FileController.html#method_getFilesWysiwyg", "name": "Syscover\\Cms\\Controllers\\FileController::getFilesWysiwyg", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\FileController", "fromLink": "Syscover/Cms/Controllers/FileController.html", "link": "Syscover/Cms/Controllers/FileController.html#method_uploadFilesWysiwyg", "name": "Syscover\\Cms\\Controllers\\FileController::uploadFilesWysiwyg", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\FileController", "fromLink": "Syscover/Cms/Controllers/FileController.html", "link": "Syscover/Cms/Controllers/FileController.html#method_deleteFilesWysiwyg", "name": "Syscover\\Cms\\Controllers\\FileController::deleteFilesWysiwyg", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/SectionController.html", "name": "Syscover\\Cms\\Controllers\\SectionController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\SectionController", "fromLink": "Syscover/Cms/Controllers/SectionController.html", "link": "Syscover/Cms/Controllers/SectionController.html#method_createCustomRecord", "name": "Syscover\\Cms\\Controllers\\SectionController::createCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\SectionController", "fromLink": "Syscover/Cms/Controllers/SectionController.html", "link": "Syscover/Cms/Controllers/SectionController.html#method_storeCustomRecord", "name": "Syscover\\Cms\\Controllers\\SectionController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\SectionController", "fromLink": "Syscover/Cms/Controllers/SectionController.html", "link": "Syscover/Cms/Controllers/SectionController.html#method_editCustomRecord", "name": "Syscover\\Cms\\Controllers\\SectionController::editCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\SectionController", "fromLink": "Syscover/Cms/Controllers/SectionController.html", "link": "Syscover/Cms/Controllers/SectionController.html#method_updateCustomRecord", "name": "Syscover\\Cms\\Controllers\\SectionController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Controllers", "fromLink": "Syscover/Cms/Controllers.html", "link": "Syscover/Cms/Controllers/TagController.html", "name": "Syscover\\Cms\\Controllers\\TagController", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\TagController", "fromLink": "Syscover/Cms/Controllers/TagController.html", "link": "Syscover/Cms/Controllers/TagController.html#method_storeCustomRecord", "name": "Syscover\\Cms\\Controllers\\TagController::storeCustomRecord", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Controllers\\TagController", "fromLink": "Syscover/Cms/Controllers/TagController.html", "link": "Syscover/Cms/Controllers/TagController.html#method_updateCustomRecord", "name": "Syscover\\Cms\\Controllers\\TagController::updateCustomRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Libraries", "fromLink": "Syscover/Cms/Libraries.html", "link": "Syscover/Cms/Libraries/Miscellaneous.html", "name": "Syscover\\Cms\\Libraries\\Miscellaneous", "doc": "&quot;\n&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Libraries\\Miscellaneous", "fromLink": "Syscover/Cms/Libraries/Miscellaneous.html", "link": "Syscover/Cms/Libraries/Miscellaneous.html#method_getExcerpt", "name": "Syscover\\Cms\\Libraries\\Miscellaneous::getExcerpt", "doc": "&quot;Funtion to get excerpt from news&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/Article.html", "name": "Syscover\\Cms\\Models\\Article", "doc": "&quot;Class Article&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_validate", "name": "Syscover\\Cms\\Models\\Article::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_scopeBuilder", "name": "Syscover\\Cms\\Models\\Article::scopeBuilder", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_lang", "name": "Syscover\\Cms\\Models\\Article::lang", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_author", "name": "Syscover\\Cms\\Models\\Article::author", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_family", "name": "Syscover\\Cms\\Models\\Article::family", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_attachments", "name": "Syscover\\Cms\\Models\\Article::attachments", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_categories", "name": "Syscover\\Cms\\Models\\Article::categories", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_tags", "name": "Syscover\\Cms\\Models\\Article::tags", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_addToGetRecordsLimit", "name": "Syscover\\Cms\\Models\\Article::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Article", "fromLink": "Syscover/Cms/Models/Article.html", "link": "Syscover/Cms/Models/Article.html#method_getTranslationPublishArticles", "name": "Syscover\\Cms\\Models\\Article::getTranslationPublishArticles", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/ArticleFamily.html", "name": "Syscover\\Cms\\Models\\ArticleFamily", "doc": "&quot;Class ArticleFamily&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticleFamily", "fromLink": "Syscover/Cms/Models/ArticleFamily.html", "link": "Syscover/Cms/Models/ArticleFamily.html#method_validate", "name": "Syscover\\Cms\\Models\\ArticleFamily::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticleFamily", "fromLink": "Syscover/Cms/Models/ArticleFamily.html", "link": "Syscover/Cms/Models/ArticleFamily.html#method_customFieldGroup", "name": "Syscover\\Cms\\Models\\ArticleFamily::customFieldGroup", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticleFamily", "fromLink": "Syscover/Cms/Models/ArticleFamily.html", "link": "Syscover/Cms/Models/ArticleFamily.html#method_addToGetRecordsLimit", "name": "Syscover\\Cms\\Models\\ArticleFamily::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticleFamily", "fromLink": "Syscover/Cms/Models/ArticleFamily.html", "link": "Syscover/Cms/Models/ArticleFamily.html#method_showRecord", "name": "Syscover\\Cms\\Models\\ArticleFamily::showRecord", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/ArticlesCategories.html", "name": "Syscover\\Cms\\Models\\ArticlesCategories", "doc": "&quot;Class ArticlesCategories&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticlesCategories", "fromLink": "Syscover/Cms/Models/ArticlesCategories.html", "link": "Syscover/Cms/Models/ArticlesCategories.html#method_validate", "name": "Syscover\\Cms\\Models\\ArticlesCategories::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\ArticlesCategories", "fromLink": "Syscover/Cms/Models/ArticlesCategories.html", "link": "Syscover/Cms/Models/ArticlesCategories.html#method_scopeBuilder", "name": "Syscover\\Cms\\Models\\ArticlesCategories::scopeBuilder", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/Category.html", "name": "Syscover\\Cms\\Models\\Category", "doc": "&quot;Class Category&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Category", "fromLink": "Syscover/Cms/Models/Category.html", "link": "Syscover/Cms/Models/Category.html#method_validate", "name": "Syscover\\Cms\\Models\\Category::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Category", "fromLink": "Syscover/Cms/Models/Category.html", "link": "Syscover/Cms/Models/Category.html#method_lang", "name": "Syscover\\Cms\\Models\\Category::lang", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Category", "fromLink": "Syscover/Cms/Models/Category.html", "link": "Syscover/Cms/Models/Category.html#method_addToGetRecordsLimit", "name": "Syscover\\Cms\\Models\\Category::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/Section.html", "name": "Syscover\\Cms\\Models\\Section", "doc": "&quot;Class Section&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Section", "fromLink": "Syscover/Cms/Models/Section.html", "link": "Syscover/Cms/Models/Section.html#method_validate", "name": "Syscover\\Cms\\Models\\Section::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Section", "fromLink": "Syscover/Cms/Models/Section.html", "link": "Syscover/Cms/Models/Section.html#method_addToGetRecordsLimit", "name": "Syscover\\Cms\\Models\\Section::addToGetRecordsLimit", "doc": "&quot;\n&quot;"},
            
            {"type": "Class", "fromName": "Syscover\\Cms\\Models", "fromLink": "Syscover/Cms/Models.html", "link": "Syscover/Cms/Models/Tag.html", "name": "Syscover\\Cms\\Models\\Tag", "doc": "&quot;Class Tag&quot;"},
                                                        {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Tag", "fromLink": "Syscover/Cms/Models/Tag.html", "link": "Syscover/Cms/Models/Tag.html#method_validate", "name": "Syscover\\Cms\\Models\\Tag::validate", "doc": "&quot;\n&quot;"},
                    {"type": "Method", "fromName": "Syscover\\Cms\\Models\\Tag", "fromLink": "Syscover/Cms/Models/Tag.html", "link": "Syscover/Cms/Models/Tag.html#method_lang", "name": "Syscover\\Cms\\Models\\Tag::lang", "doc": "&quot;\n&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


