<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/modal.css')}}">
    <title>管理画面</title>
</head>

<body class="body">
    <!-- 検索フォーム -->
    <div class="header">
        <h2>FashionablyLate</h2>
    </div>

    <div class="subheader">
        <h2>Admin</h2>
    </div>

    <div class="search-form">
        <!-- これで動いている理由がロジックとして理解できない -->
        <form action="{{ route('contacts.search') }}" method="GET" class="search-fields">
            <input class="search_means" type="text" name="keyword" value="{{ $searchWord ?? '' }}" placeholder="名前やメールアドレスを入力しt">

            <select name="gender_key" class="search_means">
                <option value="" {{ empty($searchGender) ? 'selected' : '' }} disabled>性別</option>
                <option value="1" {{ ($searchGender ?? '') == 1 ? 'selected' : '' }}>男</option>
                <option value="2" {{ ($searchGender ?? '') == 2 ? 'selected' : '' }}>女</option>
                <option value="3" {{ ($searchGender ?? '') == 3 ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_key" class="search_means">
                <option value="" {{ empty($searchCategory) ? 'selected' : '' }} disabled>お問い合わせの種類</option>
                <option value="1" {{ ($searchCategory ?? '') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{ ($searchCategory ?? '') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{ ($searchCategory ?? '') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{ ($searchCategory ?? '') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{ ($searchCategory ?? '') == 5 ? 'selected' : '' }}>その他</option>
            </select>

            <input class="search_means" type="date" name="date_key" value="{{ $searchDate ?? '' }}">

            <button type="submit" class="search-submit__button">検索</button>
        </form>

        <form action="{{ route('contacts.index') }}" method="GET">
            <button type="submit" class="search-submit__button">リセット</button>
        </form>
    </div>

     <!-- ページネーション -->
    <div class="header-export__pagination">
        <div class="export">
            <form action="{{ route('contacts.csv') }}" method="GET">
                <!-- ここでhiddenフィールドを使って、検索条件を保持 -->
                <input type="hidden" name="keyword" value="{{ $searchWord ?? '' }}">
                <input type="hidden" name="gender_key" value="{{ $searchGender ?? '' }}">
                <input type="hidden" name="category_key" value="{{ $searchCategory ?? '' }}">
                <input type="hidden" name="date_key" value="{{ $searchDate ?? '' }}">
                <button type="submit" class="search-submit__button">エクスポート</button>
            </form>
        </div>
         <div class="pagination">
            {{ $contacts->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <!-- 連絡先テーブル -->
    <table class="contacts-table">
        <thead class="contacts-table__header">
            <tr class="contacts-table__header-row">
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせ内容</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody class="contacts-table__body">
            @foreach ($contacts as $contact)
            <tr class="contacts-table__body-row">
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @switch($contact->gender)
                        @case(1) 男 @break
                        @case(2) 女 @break
                        @case(3) その他 @break
                        @default -
                    @endswitch
                </td>
                <td>{{ $contact->email }}</td>
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
                        <button class="modal__open" data-modal-id="modal-{{ $contact->id }}">詳細</button>
                        <!-- モーダル本体（IDをユニークにする！） -->
                        <div class="modal" id="modal-{{ $contact->id }}">
                            <div class="modal__bg modal__close"></div>
                            <div class="modal__content">
                                <a href="{{ route('contacts.index' )}}">
                                    <button class="modal__close">×</button>
                                </a>
                                <p>名前：{{ $contact->last_name }} {{ $contact->first_name }}</p>
                                <p>メールアドレス：{{ $contact->email }}</p>
                                <p>電話番号：{{ $contact->tel }}</p>
                                <p>住所：{{ $contact->address }}</p>
                                <p>施設：{{ $contact->building }}</p>
                                <p>詳細：{{ $contact->detail }}</p>

                                <div>
                                <form action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダルのスクリプト -->
    <script src="{{ asset('/js/modal.js') }}"></script>
</body>
</html>
