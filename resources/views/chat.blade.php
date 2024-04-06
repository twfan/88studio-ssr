<!DOCTYPE html>
<html>
<head>
    <title>Real-time Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="chat-window">
    <div id="messages"></div>
    <input type="text" id="message-input" placeholder="Type your message...">
    <input id="actual-btn" name="image" type="file">
    <button type="button" id="send-btn">Send</button>
</div>

<script>
    let pusherAppKey = '{{ env('PUSHER_APP_KEY') }}';
    let pusherAppCluster = '{{ env('PUSHER_CLUSTER') }}';
    
    var pusher = new Pusher(pusherAppKey, {
        cluster: pusherAppCluster,
        encrypted: true
    });
    
    var channel = pusher.subscribe('chatting-app');
    
    channel.bind('chat/19/3', function(data) {
        $('#messages').append('<div>' + data.message + '</div>');
    });

    $('#send-btn').on('click', function() {
        var message = $('#message-input').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        let formData = new FormData()
        formData.append('message', message)
        formData.append('image', $("#actual-btn")[0].files[0])
        
        return fetch("{{ route('chat.store') }}" , {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    body : formData
                }).then(function(res) {
                }).then(function(orderData) {
                    $("#inputChat").val("");
                });
    });

    
</script>

</body>
</html>
