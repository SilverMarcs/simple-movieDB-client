<div class="list-group-item d-flex justify-content-between align-items-center">
    {{ $title }}
    <form action="/favorite" method="post">
        @csrf
        <input type="hidden" name="title" value="{{ $title }}">
        <input type="hidden" name="action" value="{{ $favorited ? 'remove' : 'add' }}">
        <button type="submit" class="btn btn-success">
            @if($favorited)
                <i class="fas fa-heart"></i>
            @else
                <i class="far fa-heart"></i>
            @endif
        </button>
    </form>
</div>
