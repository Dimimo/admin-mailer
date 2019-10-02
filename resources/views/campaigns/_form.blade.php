<form action="{{ $campaign->id? route($prefix.'campaigns.update', [$campaign->id]) : route($prefix.'campaigns.store') }}"
      method="post">
    {{ csrf_field() }}
    @if ($campaign->id) @method('PUT') @endif

    <div class="form-group row">
        <label for="name" class="col-2 col-form-label align-right">Name</label>
        <div class="col-10">
            <input class="form-control @if ($errors->has('name')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                   type="text" id="name" name="name" placeholder="(required)" minlength="4"
                   maxlength="80" value="{{ old('name', $campaign->name) }}">
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
    <div class="form-group row pb-5">
        <label for="description" class="col-2 col-form-label align-right">Description</label>
        <div class="col-10">
            <textarea class="@if ($errors->has('description')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                      id="description" name="description">
                {!! old('description', $campaign->description) !!}
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
    <div class="form-group row">
        <label for="lists[]" class="col-2 col-form-label align-right">Distribution lists</label>
        <div class="col-10">
            <select class="form-control @if ($errors->has('lists')) is-invalid @elseif (count($errors) > 0) is-valid @endif"
                    aria-describedby="listSelection" multiple="multiple" name="lists[]" id="lists[]">
                @foreach ($lists as $list)
                    <option value="{{ $list->id }}" @if ($campaign->optionListed($list->id)) selected @endif >
                        {{ $list->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('lists'))
                <div class="invalid-feedback">
                    <span class="fas fa-exclamation-circle"></span> {{ $errors->first('lists') }}
                </div>
            @elseif (count($errors) > 0)
                <div class="valid-feedback">
                    <span class="fas fa-check-circle"></span> The list selection is valid
                </div>
            @endif
            <small id="listSelection" class="form-text text-muted">
                Distribution lists are a collection of customers. You should create these first if you haven't yet.
                Every customer in these lists will be connected to this campaign and will receive featured emails. If no
                list is selected, nobody can receive any email.<br>
                <strong>Once an email has been send out, the selected lists can not be changed anymore!</strong> If
                that's the case, simply create a new campaign.
            </small>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-2 p-4">
            <button class="btn btn-block btn-primary" type="submit">
                @if ($campaign->id) Update {{ $campaign->name }} @else Create @endif
            </button>
        </div>
    </div>
</form>

@include('common.push.summernote',['summernote_id' => 'description', 'summernote_url' => 'upload/articles/image', 'page_templates' => false])

@push('css')
    <link rel="stylesheet" href="/css/bootstrap-duallistbox.min.css"/>
@endpush
@push('js')
    <script src="/js/jquery.bootstrap-duallistbox.min.js"></script>
    <script>
        $('select[name="lists[]"]').bootstrapDualListbox({
            infoText: 'Showing all ({0})',
            moveOnSelect: false,
            nonSelectedListLabel: 'Available lists',
            selectedListLabel: 'Selected lists',
        });

        $(function () {
            const dualListContainer = $('select[name="lists[]"]').bootstrapDualListbox('getContainer');
            dualListContainer.find('.moveall i').removeClass().addClass('fa fa-arrow-right');
            dualListContainer.find('.removeall i').removeClass().addClass('fa fa-arrow-left');
            dualListContainer.find('.move i').removeClass().addClass('fa fa-arrow-right');
            dualListContainer.find('.remove i').removeClass().addClass('fa fa-arrow-left');

            dualListContainer.find('button.moveall').removeClass().addClass('btn btn-info');
            dualListContainer.find('button.removeall').removeClass().addClass('btn btn-info');
            dualListContainer.find('button.move').removeClass().addClass('btn btn-secondary');
            dualListContainer.find('button.remove').removeClass().addClass('btn btn-secondary');
        });
    </script>

@endpush
