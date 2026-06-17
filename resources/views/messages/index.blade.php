@extends('layouts.student')

@section('content')
    <h2 class="text-white fw-bold mb-4">
    CyberChat - Connect, Collaborate, Communicate
</h2>
<div class="container py-5">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0 fw-bold">
                <i class="bi bi-chat-dots-fill me-2"></i>
                People you may know
            </h4>
        </div>
        <div class="p-3 border-bottom">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                    id="userSearch"
                    class="form-control border-start-0"
                    placeholder="Search student...">
            </div>
        </div>
        <div class="card-body p-0">

            @forelse($users as $user)

                <a href="{{ route('messages.show', $user->id) }}"
                    class="text-decoration-none text-dark user-item"
                    data-name="{{ strtolower($user->first_name . ' ' . $user->last_name) }}">

                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom message-item">


                        <div class="d-flex align-items-center">

                            <div class="avatar-circle me-3">

                                @if($user->profile_photo)

                                    <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                        alt="Profile Photo"
                                        class="avatar-img">

                                @else

                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($user->first_name, 0, 1)) }}
                                    </div>

                                @endif

                            </div>

                            <div>
                                <h6 class="mb-1 fw-bold">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </h6>

                                <small class="text-muted">
                                    {{ ucfirst($user->course) }}
                                </small>
                            </div>

                        </div>

                        <i class="bi bi-chevron-right text-muted"></i>

                    </div>

                </a>

            @empty

                <div class="text-center py-5">
                    <h6 class="text-muted">
                        No users available.
                    </h6>
                </div>

            @endforelse

        </div>

    </div>

</div>

<style>

body{
    background: linear-gradient(
        135deg,
        #0f172a,
        #111827,
        #1e293b
    );
    min-height:100vh;
}

/* Main Card */
.card{
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    overflow: hidden;
}

/* Header */
.card-header{
    background: linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    ) !important;
    border: none;
}

/* Message List */
.message-item{
    transition: all .25s ease;
    background: transparent;
}

.message-item:hover{
    background: rgba(255,255,255,0.08);
    transform: translateX(5px);
}

/* User Name */
.message-item h6{
    color: #ffffff;
}

/* Role */
.message-item small{
    color: #cbd5e1 !important;
}

/* Arrow */
.message-item i{
    color: #94a3b8 !important;
}

/* Divider */
.border-bottom{
    border-color: rgba(255,255,255,0.08) !important;
}

/* Avatar */
.avatar-circle{
    width:50px;
    height:50px;
}

.avatar-img{
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid rgba(255,255,255,0.2);
}

.avatar-placeholder{
    width:50px;
    height:50px;
    border-radius:50%;
    background: linear-gradient(
        135deg,
        #3b82f6,
        #2563eb
    );
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

/* Empty State */
.text-muted{
    color:#cbd5e1 !important;
}
#userSearch{
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    color: white;
}

#userSearch::placeholder{
    color: #cbd5e1;
}

.input-group-text{
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    color: white;
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const searchInput = document.getElementById('userSearch');

    searchInput.addEventListener('keyup', function() {

        let keyword = this.value.toLowerCase();

        document.querySelectorAll('.user-item').forEach(function(item) {

            let name = item.dataset.name;

            if(name.includes(keyword)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }

        });

    });

});
</script>
@endsection