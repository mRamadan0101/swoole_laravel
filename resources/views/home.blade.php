@extends('layouts.app')

@section('content')
<script type="text/javascript">
    socket.on('websocketmessage',function (data) {
        document.getElementById('welcomeMessage').innerHTML += '<b>'+data+'</b><br>';
    });
    function sendmsg() {
        var message = document.getElementById('message').value;
        var to = document.getElementById('to').value;
        socket.emit('sendingmsg',{
            to:to,
            message:message
        });
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div>
                    <label>TO</label>
                    <input type="text" name="to" id="to">
                    <br>
                    <label>Message</label>
                    <input type="text" name="message" id="message">
                    <button id="sendmsg" onclick="sendmsg();">SEND</button>
                    </div>
                    <div id="welcomeMessage"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
