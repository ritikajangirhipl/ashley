<form action="{{ route('admin.accreditation-bodies.update', [$accreditationBody->id]) }}" id="editForm">
    @csrf
    @include('admin.master.accreditation-bodies.partials._form')
</form>