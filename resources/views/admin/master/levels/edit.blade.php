<form action="{{ route('admin.levels.update', [$levelMaster->id]) }}" id="editForm">
    @csrf
    @include('admin.master.levels.partials._form')
</form>