<form action="{{ $list->id? route($prefix.'lists.update', [$list->id]) : route($prefix.'lists.store') }}"
      method="post">
    {{ csrf_field() }}
    @if ($list->id) @method('PUT') @endif

    <div class="form-group row">
        <label for="name" class="col-2 col-form-label align-right">Name</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('name')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                   type="text" id="name" name="name" placeholder="(required)" minlength="4"
                   maxlength="80" value="{{ old('name', $list->name) }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('name') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Name is valid
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="city_id" class="col-2 col-form-label align-right">City (optional)</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('city_id')) is-invalid @endif"
                   type="text" id="city_id" name="city_id" placeholder="(start typing)"
                   value="{{ old('city_id', $list->city_id) }}">
            @if ($errors->has('city_id'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('city_id') }}
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-2 col-form-label align-right">Description</label>
        <div class="col-10">
            <textarea class="@if ($errors->has('description')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                      id="description" name="description">
                {!! old('description', $list->description) !!}
            </textarea>
            @if ($errors->has('description'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('description') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> Description is valid
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-2 p-4">
            <button class="btn btn-block btn-primary" type="submit">
                @if ($list->id) Update {{ $list->name }} @else Create @endif
            </button>
        </div>
    </div>
</form>

@include('common.push.autocomplete_city', ['field' => 'city_id'])
@include('common.push.summernote',['summernote_id' => 'description', 'summernote_url' => 'upload/articles/image', 'page_templates' => false])
