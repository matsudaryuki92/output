<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="{{ route('index.check') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Enter your name">
            <button type="submit">送信</button>
        </form>
    </div>
</body>
</html>