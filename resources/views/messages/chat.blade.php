@extends('layouts.student')

@section('content')

<div class="container py-4 d-flex justify-content-center">

    <div class="phone-frame">

    <div class="phone-notch"></div>

    <div class="chat-card">

        {{-- Header --}}
        <div class="chat-header">

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
                    <h5 class="mb-0 text-white fw-bold">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </h5>

                    <small class="text-light opacity-75">
                        {{ ucfirst($user->course) }}
                    </small>
                </div>

            </div>

        </div>

        {{-- Messages --}}
        <div class="chat-body" id="chatBody">

            @foreach($messages as $message)

                @if($message->sender_id == auth()->id())

                    {{-- My Message --}}
                    <div class="d-flex justify-content-end mb-3">

                        <div class="message-bubble mine">
                            {{ $message->message }}
                        </div>

                    </div>

                @else

                    {{-- Their Message --}}
                    <div class="d-flex justify-content-start mb-3">

                        <div class="message-bubble theirs">
                            {{ $message->message }}
                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        {{-- Input --}}
        <div class="chat-footer">

            <form action="{{ route('messages.send') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="receiver_id"
                       value="{{ $user->id }}">

                <div class="input-group">

                    <textarea
                        name="message"
                        class="form-control chat-input"
                        rows="2"
                        placeholder="Type your message..."
                        required></textarea>

                    <button class="btn send-btn">
                        <i class="bi bi-send-fill"></i>
                    </button>

                </div>

            </form>

        </div>

    </div>
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

/* Main Card */
.chat-card{
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
    height: 80vh;
    display: flex;
    flex-direction: column;
}

/* Header */
.chat-header{
    background: linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );
    padding: 20px;
}

/* Messages Area */
.chat-body{
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

/* Bubbles */
.message-bubble{
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 18px;
    word-wrap: break-word;
}

.mine{
    background: #2563eb;
    color: white;
    border-bottom-right-radius: 5px;
}

.theirs{
    background: rgba(255,255,255,.08);
    color: white;
    border-bottom-left-radius: 5px;
}

/* Footer */
.chat-footer{
    padding: 15px;
    border-top: 1px solid rgba(255,255,255,.08);
}

/* Input */
.chat-input{
    background: rgba(255,255,255,.08);
    border: none;
    color: white;
    resize: none;
}

.chat-input:focus{
    background: rgba(255,255,255,.12);
    color: white;
    box-shadow: none;
}

.chat-input::placeholder{
    color: #cbd5e1;
}

/* Send Button */
.send-btn{
    background: #2563eb;
    color: white;
    border: none;
    padding: 0 20px;
}

.send-btn:hover{
    background: #1d4ed8;
    color: white;
}

/* Avatar */
.avatar-placeholder{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Scrollbar */
.chat-body::-webkit-scrollbar{
    width: 6px;
}

.chat-body::-webkit-scrollbar-thumb{
    background: rgba(255,255,255,.2);
    border-radius: 20px;
}

</style>

<script>
window.onload = function () {
    let chatBody = document.getElementById('chatBody');
    chatBody.scrollTop = chatBody.scrollHeight;
};
</script>

@endsection