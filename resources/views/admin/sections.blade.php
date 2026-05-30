@extends('layouts.admin')

@section('content')
<style>
.section-card {
    transition: 0.3s;
    cursor: pointer;
}

.section-card:hover {
    transform: translateY(-5px) scale(1.02);
    background: linear-gradient(135deg, gold, orange);
    color: black;
}
</style>
<div class="row g-4 mb-4">

    <div class="col-md-12">
        <div class="card-modern">
            <h4>📚 Sections</h4>
            <p class="text-muted">Select a section to view students</p>
        </div>
    </div>

</div>

<div class="row g-4">

    @foreach($sections as $sec)

    <div class="col-md-3">
        <a href="{{ route('admin.sections.show', $sec) }}" style="text-decoration:none;">
            <div class="card-modern text-center section-card">
                
                <h5>{{ $sec }}</h5>
                <p class="text-muted">View Students</p>

            </div>
        </a>
    </div>

    @endforeach

</div>

@endsection