<div class="form-group{{($error = $errors->first('title')) ? ' validate-has-error' : '' }}">
    <label class="col-sm-2 control-label required">Title:</label>
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-header"></i></span>
            {!! Form::text('title', null, [
                'id' => 'title' . $current->language,
                'class' => 'form-control',
            ]) !!}
        </div>
        @if ($error)
            <span class="text-danger">{{$error}}</span>
        @endif
    </div>
</div>

<div class="form-group-separator"></div>

<div class="form-group{{($error = $errors->first('type')) ? ' validate-has-error' : '' }}">
    <label class="col-sm-2 control-label required">Type:</label>
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-ellipsis-h"></i></span>
            {!! Form::select('type', cms_collections('types'), null, [
                'id' => 'type',
                'class' => 'form-control select',
            ] + ($current->id ? ['disabled' => 'disabled'] : [])) !!}
        </div>
        @if ($error)
        <span class="text-danger">{{$error}}</span>
        @endif
    </div>
</div>

<div class="form-group-separator"></div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('admin_order_by')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Admin order by:</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                    {!! Form::select('admin_order_by', $orderBy = cms_collections('order_by'), null, [
                        'id' => 'admin_order_by',
                        'class' => 'form-control select',
                    ]) !!}
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('web_order_by')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Web order by:</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                    {!! Form::select('web_order_by', $orderBy, null, [
                        'id' => 'web_order_by',
                        'class' => 'form-control select',
                    ]) !!}
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group-separator"></div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('admin_sort')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Admin sort:</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort"></i></span>
                    {!! Form::select('admin_sort', cms_collections('sort'), null, [
                        'id' => 'admin_sort',
                        'class' => 'form-control select',
                    ]) !!}
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('web_sort')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Web sort:</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort"></i></span>
                    {!! Form::select('web_sort', cms_collections('sort'), null, [
                        'id' => 'web_sort',
                        'class' => 'form-control select',
                    ]) !!}
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group-separator"></div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('admin_per_page')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Admin per page:</label>
            <div class="col-sm-8">
                <div id="admin_per_page" class="input-group spinner" data-step="1" data-min="1" data-max="50">
                    <div class="input-group-btn">
                        <span class="btn btn-info" data-type="decrement">-</span>
                    </div>
                    {!! Form::text('admin_per_page', null, [
                        'class' => 'form-control text-center',
                        'readonly' => 1
                    ]) !!}
                    <div class="input-group-btn">
                        <span class="btn btn-info" data-type="increment">+</span>
                    </div>
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group{{($error = $errors->first('web_per_page')) ? ' validate-has-error' : '' }}">
            <label class="col-sm-4 control-label required">Web per page:</label>
            <div class="col-sm-8">
                <div id="web_per_page" class="input-group spinner" data-step="1" data-min="1" data-max="50">
                    <div class="input-group-btn">
                        <span class="btn btn-info" data-type="decrement">-</span>
                    </div>
                    {!! Form::text('web_per_page', null, [
                        'class' => 'form-control text-center',
                        'readonly' => 1
                    ]) !!}
                    <div class="input-group-btn">
                        <span class="btn btn-info" data-type="increment">+</span>
                    </div>
                </div>
                @if ($error)
                <span class="text-danger">{{$error}}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group-separator"></div>

<div class="form-group">
    <label class="col-sm-2 control-label">Description:</label>
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Short description']) !!}
    </div>
</div>

<div class="form-group-separator"></div>

<div class="form-group">
    <div class="col-sm-10 btn-action pull-right">
        <button type="submit" class="btn btn-secondary btn-icon-standalone" title="{{ $submit }}">
            <i class="fa fa-{{ $icon }}"></i>
            <span>{{ trans('general.save') }}</span>
        </button>
        @if ($current->id)
            <a href="{{ cms_route($current->type . '.index', [$current->id]) }}" class="btn btn-info btn-icon-standalone" title="{{ trans('general.'.$current->type) }}">
                <i class="{{icon_type($current->type)}}"></i>
                <span>{{ucfirst($current->type)}}</span>
            </a>
        @endif
        <a href="{{ cms_route('collections.index') }}" class="btn btn-blue btn-icon-standalone" title="{{ trans('general.back') }}">
            <i class="fa fa-arrow-left"></i>
            <span>{{ trans('general.back') }}</span>
        </a>
    </div>
</div>
@push('body.bottom')
<script type="text/javascript">
$(function() {
    $('.select').select2({
        placeholder: 'Select type...',
        allowClear: true
    }).on('select2-open', function() {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
});
</script>
<link rel="stylesheet" href="{{ asset('assets/libs/js/select2/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/js/select2/select2-bootstrap.css') }}">
<script src="{{ asset('assets/libs/js/select2/select2.min.js') }}"></script>
@endpush
