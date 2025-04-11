<?php

namespace App\Contacts\UseCase;

use Symfony\Component\HttpFoundation\StreamedResponse;

final class CsvExportWriteUseCase
{
    // 目的：csv内部の処理

    public function handle($contacts)
    {
        // ストリームレスポンスを作成
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w'); // 出力ストリームを開く

            // ヘッダー行を書き込む
            fputcsv($handle, ['First Name', 'Last Name', 'Gender', 'Email', 'Tel', 'Address', 'Building', 'Detail']);

            // データを書き込む
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->first_name,
                    $contact->last_name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->detail,
                ]);
            }

            // fclose($handle);  ← Laravelではresponse()->stream()内でfclose()は不要
        });

        // HTTPヘッダーをセット
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

        return $response;
    }
}
