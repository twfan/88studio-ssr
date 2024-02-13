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
    <form id="send-message-form">
        <input type="text" id="message-input" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>
</div>

<script>
    let pusherAppKey = '{{ env('PUSHER_APP_KEY') }}';
    let pusherAppCluster = '{{ env('PUSHER_CLUSTER') }}';
    
    var pusher = new Pusher(pusherAppKey, {
        cluster: pusherAppCluster,
        encrypted: true
    });
    
        var channel = pusher.subscribe('chatting-app');
        
        channel.bind('message-sent', function(data) {
            console.log("tes", data)
            $('#messages').append('<div>' + data.message + '</div>');
        });

    $('#send-message-form').submit(function(e) {
        e.preventDefault();
        
        var message = $('#message-input').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/send-message',
            method: 'POST',
            data: {
                message: message
            },
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                $('#message-input').val('');
            },
            error: function(xhr, status, error) {
                console.error('Error sending message:', error);
            }
        });
    });
</script>

</body>
</html>
