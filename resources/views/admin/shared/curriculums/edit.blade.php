	<form action="{{ route('admin.curriculums.update', [request()->type,$curriculum->id]) }}" id="editForm">
    @csrf
    @include('admin.shared.curriculums.partials._form')
</form>