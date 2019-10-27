<div class="row">
    <a href="{{ route($prefix.'customers.edit', [$customer->id]) }}"
       class="btn btn-link col-auto green">
        <span class="fas fa-edit"></span> Edit
    </a>
    <form action="{{ route($prefix.'customers.destroy', [$customer->id]) }}"
          class="col-auto ml-n3 pr-1"
          onsubmit="return confirm('Are you sure you want to delete?');" method="post">
        {{ csrf_field() }}
        @method('DELETE')
        <button type="submit" class="btn btn-link red" title="Delete this customer">
            <span class="fas fa-trash-alt"></span> Delete
        </button>
    </form>
</div>