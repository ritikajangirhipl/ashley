<form action="{{ route('admin.accreditation-bodies.store') }}" id="createForm">
    @csrf
    @include('admin.master.accreditation-bodies.partials._form')
</form>

