<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            {{ Form::bsText('title', [
                'required' => true,
                'title' => trans('validation.attributes.title'),
                'label_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
            ]) }}

            {{ Form::bsTextarea('summary', [
                'title' => trans('validation.attributes.summary'),
                'label_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'attributes' => [
                    'rows' => 5
                ],
            ]) }}

            {{ Form::bsEditor('body', [
                'title' => trans('validation.attributes.body'),
                'placeholder' => trans('labels.backend.posts.placeholders.body'),
                'label_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'height' => 300,
            ]) }}

            @if(old('tags'))
                @php($tags = old('tags'))
            @else
                @php($tags = isset($post) ? $post->tags->pluck('name', 'id') : old('tags'))
            @endif

            {{ Form::bsSelect('tags[]', [
                'type' => 'autocomplete',
                'multiple' => true,
                'tags' => true,
                'title' => trans('validation.attributes.tags'),
                'placeholder' => trans('labels.placeholders.tags'),
                'label_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'options' => isset($tags) ? $tags : [],
                'ajax_url' => route('admin.tags.search'),
                'minimum_input_length' => 2,
                'item_value' => 'id',
                'item_label' => 'name',
            ]) }}

            {{ Form::bsImage('featured_image', [
                'title' => trans('validation.attributes.image'),
                'label_class' => 'col-lg-2',
                'field_wrapper_class' => 'col-lg-10',
                'url' => isset($post) ? $post->featured_image_url : null
            ]) }}
        </div>

        <div class="box-footer">
            <div class="pull-left">
                <a href="{{ route('admin.post.index') }}"
                   class="btn btn-danger btn-sm">@lang('buttons.back')</a>
            </div>
            <div class="pull-right">
                {{ Form::hidden('status', 'publish') }}
                <div class="btn-group">
                    {{ Form::submit(trans('buttons.posts.save_and_publish'), ['class' => 'btn btn-success btn-sm']) }}
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a data-toggle="submit-link" data-target="[name=&quot;status&quot;]" data-value="draft" href="javascript:void(0);">@lang('buttons.posts.save_as_draft')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="box-group" id="accordion">
        <div class="panel box box-danger">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                        @lang('labels.backend.posts.titles.publication')
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                <div class="box-body">
                    @isset($post)
                    <div class="form-group">
                        <label class="control-label col-lg-3">@lang('validation.attributes.status')</label>
                        <div class="col-lg-9">
                            <label class="control-label">{!! state_html_label($post->state, trans($post->status_label)) !!}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">@lang('labels.author')</label>
                        <div class="col-lg-9">
                            <label class="control-label">{{ $post->owner }}</label>
                        </div>
                    </div>
                    @endisset
                    {{ Form::bsDatetime('published_at', [
                        'required' => true,
                        'value' => \Carbon\Carbon::now(),
                        'title' => trans('validation.attributes.publish_at'),
                        'format' => 'YYYY-MM-DD hh:mm',
                        'label_class' => 'col-lg-3',
                        'field_wrapper_class' => 'col-lg-9',
                    ]) }}
                    {{ Form::bsCheckbox('pinned', [
                        'label' => trans('validation.attributes.pinned'),
                        'field_wrapper_class' => 'col-lg-offset-3 col-lg-9',
                    ]) }}
                    {{ Form::bsCheckbox('promoted', [
                        'label' => trans('validation.attributes.promoted'),
                        'field_wrapper_class' => 'col-lg-offset-3 col-lg-9',
                    ]) }}
                </div>
            </div>
        </div>
        <div class="panel box box-info">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        @lang('labels.backend.titles.metas')
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                <div class="box-body">
                    {{ Form::bsText('meta[title]', [
                        'title' => trans('validation.attributes.title'),
                        'description' => trans('labels.backend.posts.descriptions.meta_title'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_title'),
                        'label_class' => 'col-lg-2',
                        'field_wrapper_class' => 'col-lg-10',
                    ]) }}

                    {{ Form::bsTextarea('meta[description]', [
                        'title' => trans('validation.attributes.description'),
                        'description' => trans('labels.backend.posts.descriptions.meta_description'),
                        'placeholder' => trans('labels.backend.posts.placeholders.meta_description'),
                        'label_class' => 'col-lg-2',
                        'field_wrapper_class' => 'col-lg-10',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
</div>
