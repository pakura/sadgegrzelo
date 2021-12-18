<div class="col-md-12">
    <div class="form-group">
        <label class="control-label required">Title:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-header"></i></span>
            {!! Form::text('title', null, [
                'id' => 'title' . $current->language,
                'class' => 'form-control',
                'autofocus'
            ]) !!}
        </div>
    </div>
</div>>
<div class="col-md-12">
    <div class="form-group">
        <label class="control-label required">Video URL:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
            {!! Form::text('file', null, [
                'id' => 'file' . $current->language,
                'class' => 'form-control',
                'data-lang' => 1
            ]) !!}
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label class="control-label">Visible:</label>
        {!! Form::checkbox('visible', null, null, [
            'id' => 'visible' . $current->language,
            'class' => 'iswitch iswitch-secondary',
            'data-lang' => 1
        ]) !!}
    </div>
</div>
<button type="button" class="btn btn-md btn-white" data-dismiss="modal">{{trans('general.close')}}</button>
<button type="submit" class="btn btn-md btn-secondary">{{trans('general.save')}}</button>
