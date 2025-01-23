<form action="{{ route('admin.countries.update', [$country->id]) }}" id="editForm">
    @csrf
    @include('admin.master.countries.partials._form')
</form>