<form action="{{ route('admin.curriculums.store',request()->type) }}" id="createForm">
    @csrf
    @include('admin.shared.curriculums.partials._form')
</form>

