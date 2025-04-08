<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
</head>
<body>

<h1>詳細確認</h1>

<table>
    <tbody>
        メールアドレス
        <p>{{ $contact->email }}</p>
        電話番号
        <p>{{ $contact->tel }}</p>
        住所
        <p>{{ $contact->address }}</p>
        施設
        <p>{{ $contact->building }}</p>
        詳細
        <p>{{ $contact->detail }}</p>
        </tbody>
</table>

<div>
    <button type="submit">
        <a href="{{ route('contacts.index') }}">戻る</a>
    </button>
</div>


<div>
    <!-- 削除の時はformを利用する -->
    <form action="{{ route('contacts.destroy', ['contact'=>$contact->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">削除</button>
    </form>
</div>

</body>
</html>