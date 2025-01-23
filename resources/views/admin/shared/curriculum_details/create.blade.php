<form action="{{ route('admin.curriculum-details.store',request()->type) }}" id="createForm">
    @csrf
    @include('admin.shared.curriculum_details.partials._form')
</form>

