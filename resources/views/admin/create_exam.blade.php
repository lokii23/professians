@extends('layouts.admin')

@section('content')

<div class="card p-4">

    <h4>Create Exam</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store-exam') }}">
        @csrf
        <div class="mb-3">

            <label class="form-label">
                Exam Duration (Minutes)
            </label>

            <input type="number"
                name="duration"
                class="form-control"
                placeholder="Enter duration"
                required>

        </div>
        <div class="mb-3">
            <label>Exam Title</label>
            <input type="text" name="title" class="form-control" required>
            
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="Quiz">Quiz</option>
                <option value="Midterm Exam">Midterm Exam</option>
                <option value="Final Exam">Final Exam</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Passkey (Exam Password)</label>
            <input type="text" name="passkey" class="form-control" required>
        </div>

        <button class="btn btn-primary">Create Exam</button>

    </form>

</div>

@endsection