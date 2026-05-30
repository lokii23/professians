@extends('layouts.admin')

@section('content')

<style>

    .results-table{

        font-size:14px;
    }

    .results-table th{

        padding:10px 12px;

        font-size:13px;

        white-space:nowrap;
    }

    .results-table td{

        padding:10px 12px;

        vertical-align:middle;
    }

    .results-table .badge{

        font-size:12px;

        padding:6px 10px;
    }

    .results-table a{

        font-size:14px;
    }

    .results-header h4{

        font-size:22px;

        margin-bottom:5px;
    }

    .results-header p{

        font-size:14px;
    }

</style>

<div class="card-modern p-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        <div class="results-header">

            <h4 class="mb-1">
                📊 Exam Results
            </h4>

            <p class="text-muted mb-0">

                Exam:
                <span class="fw-bold">
                    {{ $exam->title }}
                </span>

                |

                Section:
                <span class="fw-bold">
                    {{ request('section') ?? 'All Sections' }}
                </span>

            </p>

        </div>

        <!-- SORT BUTTONS -->
        <div class="d-flex gap-2 mt-2 mt-md-0">

            <a href="{{ route('admin.results', ['id' => $exam->id, 'sort' => 'asc']) }}"
               class="btn btn-sm btn-primary">

                Sort A-Z

            </a>

            <a href="{{ route('admin.results', ['id' => $exam->id, 'sort' => 'desc']) }}"
               class="btn btn-sm btn-dark">

                Sort Z-A

            </a>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table table-striped table-hover align-middle results-table">

            <thead class="table-dark">

                <tr>

                    <th width="50">#</th>

                    <th>Student</th>

                    <th>Exam</th>

                    <th width="90">Score</th>

                    <th width="150">Date</th>

                </tr>

            </thead>

            <tbody>

                @foreach($results as $index => $r)

                <tr>

                    <!-- NUMBER -->
                    <td class="fw-bold">
                        {{ $index + 1 }}
                    </td>

                    <!-- STUDENT -->
                    <td>

                        <a href="{{ route('admin.review-result', $r->id) }}"
                           class="fw-bold text-decoration-none">

                            {{ $r->user->last_name }},
                            {{ $r->user->first_name }}
                            {{ $r->user->middle_name }}

                        </a>

                    </td>

                    <!-- EXAM -->
                    <td>
                        {{ $r->exam->title ?? 'N/A' }}
                    </td>

                    <!-- SCORE -->
                    <td>

                        <span class="badge bg-success">
                            {{ $r->score }}
                        </span>

                    </td>

                    <!-- DATE -->
                    <td>

                        {{ $r->created_at->format('M d, Y') }}

                        <br>

                        <small class="text-muted">
                            {{ $r->created_at->format('h:i A') }}
                        </small>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection