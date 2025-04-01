<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <title>管理画面</title>
</head>

<body>
    <!-- 検索フォーム -->
     検索機能
    <div>
        <form action="{{ route('contacts.search') }}" method="POST">
            @csrf
            <input type="text" name="keyword" placeholder="名前・メールアドレス">
            <select name="gender_key">
                <option value="" disabled selected>性別</option>
                <option value="1">男</option>
                <option value="2">女</option>
                <option value="3">その他</option>
            </select>
            <select name="category_key">
                <option value="" disabled selected>お問い合わせの種類</option>
                <option value="1">商品のお届けについて</option>
                <option value="2">商品の交換について</option>
                <option value="3">商品トラブル</option>
                <option value="4">ショップへのお問い合わせ</option>
                <option value="5">その他</option>
            </select>
                <input type="date" name="date_key">
            <button type="submit">検索</button>
        </form>
    </div>
        <div>
            <form action="{{ route('contacts.index') }}" method="GET">
                <button type="submit">リセット</button>
            </form>
        </div>

    <!-- 連絡先のテーブル -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>性別</th>
                <th>お問い合わせ内容</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender === 1) 男
                        @elseif($contact->gender === 2) 女
                        @elseif($contact->gender === 3) その他
                        @endif
                    </td>
                    <td>
                        @if($contact->gender === 1) 商品のお届けについて
                        @elseif($contact->gender === 2) 商品の交換について
                        @elseif($contact->gender === 3) 商品トラブル
                        @elseif($contact->gender === 4) ショップへのお問い合わせ
                        @elseif($contact->gender === 5) その他
                        @endif
                    </td>
                    <td>
                        <button>
                            <a href="{{ route('contacts.show', ['contact' =>$contact->id]) }}">詳細</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーションリンク -->
    <div>
        {{ $contacts->links() }}
    </div>

    <!-- 検索結果の表示 -->
    <div>
        @if(!empty($values))
            <h3>検索結果:</h3>
            @foreach($values as $value)
                <p>{{ $value->last_name }} {{ $value->first_name }}</p>

                <p>{{ $value->email }}</p>

                @if($value -> gender === 1)
                <p>男</p>
                @elseif($value -> gender === 2)
                <p>女</p>
                @elseif($value -> gender === 3)
                <p>その他</p>
                @endif

                @if($value -> category_id === 1)
                <p>商品のお届けについて</p>
                @elseif($value -> category_id === 2)
                <p>商品の交換について</p>
                @elseif($value -> category_id === 3)
                <p>商品トラブル</p>
                @elseif($value -> category_id === 4)
                <p>ショップへのお問い合わせ</p>
                @elseif($value -> category_id === 5)
                <p>その他</p>
                @endif
            @endforeach
        @endif
    </div>
</body>

</html>
