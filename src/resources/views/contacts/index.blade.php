<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <title>管理画面</title>
</head>

<body>
    <!-- 検索フォーム -->
    <h1>検索機能</h1>
    <div>
        <!-- これで動いている理由がロジックとして理解できない -->
        <form action="{{ route('contacts.search') }}" method="GET">
            <input type="text" name="keyword" value="{{ $searchWord ?? '' }}" placeholder="名前・メールアドレス">

            <select name="gender_key">
                <option value="" {{ empty($searchGender) ? 'selected' : '' }} disabled>性別</option>
                <option value="1" {{ ($searchGender ?? '') == 1 ? 'selected' : '' }}>男</option>
                <option value="2" {{ ($searchGender ?? '') == 2 ? 'selected' : '' }}>女</option>
                <option value="3" {{ ($searchGender ?? '') == 3 ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_key">
                <option value="" {{ empty($searchCategory) ? 'selected' : '' }} disabled>お問い合わせの種類</option>
                <option value="1" {{ ($searchCategory ?? '') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ ($searchCategory ?? '') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ ($searchCategory ?? '') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ ($searchCategory ?? '') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ ($searchCategory ?? '') == 5 ? 'selected' : '' }}>その他</option>
            </select>

            <input type="date" name="date_key" value="{{ $searchDate ?? '' }}">

            <button type="submit">検索</button>
        </form>
    </div>

    <!-- リセット＆エクスポート -->
    <div>
        <form action="{{ route('contacts.index') }}" method="GET">
            <button type="submit">リセット</button>
        </form>
    </div>
    <div>
        <form action="{{ route('contacts.csv') }}" method="GET">
            <!-- ここでhiddenフィールドを使って、検索条件を保持 -->
            <input type="hidden" name="keyword" value="{{ $searchWord ?? '' }}">
            <input type="hidden" name="gender_key" value="{{ $searchGender ?? '' }}">
            <input type="hidden" name="category_key" value="{{ $searchCategory ?? '' }}">
            <input type="hidden" name="date_key" value="{{ $searchDate ?? '' }}">
            <button type="submit">エクスポート</button>
        </form>
    </div>

    <!-- 連絡先テーブル -->
    @if(isset($contacts) && $contacts->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>性別</th>
                <th>お問い合わせ内容</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @switch($contact->gender)
                            @case(1) 男 @break
                            @case(2) 女 @break
                            @case(3) その他 @break
                            @default -
                        @endswitch
                    </td>
                    <td>
                        @switch($contact->category->id)
                            @case(1) 商品のお届けについて @break
                            @case(2) 商品の交換について @break
                            @case(3) 商品トラブル @break
                            @case(4) ショップへのお問い合わせ @break
                            @case(5) その他 @break
                            @default -
                        @endswitch
                    </td>
                    <td>
                        <div class="modal js-modal">
                            <div class="modal-container">
                                <!-- モーダルを閉じるボタン -->
                                <div class="modal-close js-modal-close"></div>
                                <!-- モーダル内部のコンテンツ -->
                                <div class="modal-content">
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('contacts.show', ['contact' => $contact->id]) }}">
                            <button>詳細</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div>
        {{ $contacts->links() }}
    </div>
    @else
        <p>データが見つかりませんでした。</p>
    @endif

</body>
</html>
