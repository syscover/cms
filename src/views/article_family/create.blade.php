@extends('pulsar::layouts.form', ['action' => 'store'])

@section('rows')
    <!-- cms::article_families.create -->
    @include('pulsar::includes.html.form_text_group', ['label' => 'ID', 'name' => 'id', 'fieldSize' => 2, 'readOnly' => true])
    @include('pulsar::includes.html.form_text_group', ['label' => trans('pulsar::pulsar.name'), 'name' => 'name', 'value' => Input::old('name'), 'maxLength' => '100', 'rangeLength' => '2,100', 'required' => true])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.date'), 'name' => 'date', 'value' => 1, 'isChecked' => Input::old('date'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('pulsar::pulsar.title'), 'name' => 'title', 'value' => 1, 'isChecked' => Input::old('title'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('cms::pulsar.slug'), 'name' => 'slug', 'value' => 1, 'isChecked' => Input::old('slug'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans_choice('pulsar::pulsar.category', 1), 'name' => 'categories', 'value' => 1, 'isChecked' => Input::old('categories'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_checkbox_group', ['label' => trans('pulsar::pulsar.sorting'), 'name' => 'sorting', 'value' => 1, 'isChecked' => Input::old('sorting'), 'fieldSize' => 4, 'inputs' => [
        ['label' => trans('cms::pulsar.tags'), 'name' => 'tags', 'value' => 1, 'isChecked' => Input::old('tags'), 'fieldSize' => 4]
    ]])
    @include('pulsar::includes.html.form_select_group', ['label' => trans('pulsar::pulsar.editor'), 'name' => 'editor', 'value' => Input::old('editor'), 'objects' => $editors, 'idSelect' => 'id', 'nameSelect' => 'name', 'class' => 'form-control', 'fieldSize' => 5])



            <!--=== Striped Table ===-->
<div class="row">
<div class="col-md-12">
    <div class="widget box">
        <div class="widget-header">
            <h4><i class="fa fa-cubes"></i> {{ trans('cms::pulsar.custom_fields') }}</h4>
            <div class="toolbar no-padding">
                <div class="btn-group">
                    <span class="btn btn-xs"><i class="fa fa-plus"></i> Nuevo campo</span>
                </div>
            </div>
        </div>
        <div class="widget-content">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td class="align-center"><a href="#" class="btn btn-xs bs-tooltip delete-record" data-original-title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td class="align-center"><a href="#" class="btn btn-xs bs-tooltip delete-record" data-original-title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td><input class="form-control" type="text" name="name" value="" maxlength="100" rangelength="2,100" required="" aria-required="true"></td>
                    <td class="align-center"><a href="#" class="btn btn-xs bs-tooltip delete-record" data-original-title="Borrar"><i class="fa fa-trash"></i></a></td>
                </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- /Striped Table -->

    <!-- /cms::article_families.create -->
@stop