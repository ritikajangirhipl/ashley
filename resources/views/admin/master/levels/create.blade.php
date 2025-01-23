<form action="{{ route('admin.levels.store') }}" id="createForm">
    @csrf
    @include('admin.master.levels.partials._form')
</form>

