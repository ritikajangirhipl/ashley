	<form action="{{ route('admin.curriculum-details.update', [request()->type, $curriculumDetail->id]) }}" id="editForm">
    @csrf
    @include('admin.shared.curriculum_details.partials._form')
</form>