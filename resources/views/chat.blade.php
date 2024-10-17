<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPT Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div>
        <h1>Chat with AI</h1>
        <textarea id="user-input" rows="5" cols="40" placeholder="Ask something..."></textarea><br>
        <button id="send-button">Send</button>

        <h2>Response:</h2>
        <div id="response"></div>
    </div>

    <script>
        $('#send-button').click(function() {
            let input = $('#user-input').val();

            $.ajax({
                url: '/chat',
                type: 'POST',
                data: {
                    input: input,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#response').text(data.response);
                },
                error: function() {
                    $('#response').text('Error sending request.');
                }
            });
        });
    </script>
</body>
</html>
