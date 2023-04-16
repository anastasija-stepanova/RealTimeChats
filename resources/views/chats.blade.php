<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Real time chats</title>
</head>
<body>
<div class="main">
    @foreach ($chats as $key => $chat)
        <div class="chat-wrapper">
            <div class="chat-name">Chat {{ $key + 1 }}</div>
            <form class="chat" data-sender="{{ $chat['sender'] }}" data-receiver="{{ $chat['receiver'] }}">
                <div class="history">
                    @foreach ($messages as $message)
                        <div class="message-container">
                            @if ($message->from == $chat['sender'])
                                <div class="sender-name">{{ $message->from }}</div>
                                <div class="message-content out">{{ $message->body }}</div>
                            @elseif ($message->from == $chat['receiver'])
                                <div class="receiver-name">{{ $message->from }}</div>
                                <div class="message-content in">{{ $message->body }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <label>
                    <textarea name="message" class="input-message"></textarea>
                </label>
                <button type="submit" class="btn btn-send">Send</button>
            </form>
        </div>
    @endforeach
</div>

<script>
    window.csrfToken = '{{ csrf_token() }}';
</script>
</body>
</html>
