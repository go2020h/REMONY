<?php
// エラーを表示（開発時のみ）
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 確認画面からの送信でない場合はエラー
if (!isset($_POST['confirmed']) || $_POST['confirmed'] != '1') {
    header('Location: error.php');
    exit;
}

// フォームからのデータを取得
$name = isset($_POST['name']) ? $_POST['name'] : '';
$kana = isset($_POST['kana']) ? $_POST['kana'] : '';
$postal = isset($_POST['postal']) ? $_POST['postal'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$time_detail = isset($_POST['time_detail']) ? $_POST['time_detail'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// 連絡可能時間の表示用テキストを生成
$time_text = ($time == 'anytime') ? 'いつでも可' : '時間指定: ' . $time_detail;

// 送信先メールアドレス
$to = 'katagiri@hidane.org';

// メールの件名
$subject = 'REMONY for you - お問い合わせがありました';

// メールの本文
$body = <<<EOT
REMONY for you サイトからお問い合わせがありました。

【お名前】
{$name}

【フリガナ】
{$kana}

【ご住所】
〒{$postal}
{$address}

【電話番号】
{$tel}

【連絡可能時間】
{$time_text}

【メールアドレス】
{$email}

【お問い合わせ内容】
{$message}

EOT;

// 追加のヘッダー
$headers = "From: {$email}\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// メール送信処理
try {
    // mb_send_mailを使用して文字化けを防止
    mb_language('ja');
    mb_internal_encoding('UTF-8');
    
    $success = mb_send_mail($to, $subject, $body, $headers);
    
    if ($success) {
        // 送信成功時はサンクスページへリダイレクト
        header('Location: thanks.php');
        exit;
    } else {
        // 送信失敗時はエラーページへリダイレクト
        header('Location: error.php');
        exit;
    }
} catch (Exception $e) {
    // 例外発生時はエラーページへリダイレクト
    header('Location: error.php');
    exit;
}
