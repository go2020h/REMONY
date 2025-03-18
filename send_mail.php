<?php
// エラーレポートを有効化
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// 電話連絡可能時間の表示用テキスト
$time_text = ($time == 'anytime') ? 'いつでも可' : '時間指定: ' . $time_detail;

// 送信先メールアドレス
$to = 'tanikaga@nfes-tech.com';

// メールの件名
$subject = 'REMONY for you - お問い合わせがありました';

// メール本文
$body = <<<EOT
REMONY for you サイトからお問い合わせがありました。

【お名前】
{$name}

【フリガナ】
{$kana}

【住所】
〒{$postal}
{$address}

【電話番号】
{$tel}

【電話連絡可能時間】
{$time_text}

【メールアドレス】
{$email}

【お問い合わせ内容】
{$message}

EOT;

// メールヘッダー
$headers = "From: {$email}\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// メール送信
$mail_sent = mail($to, $subject, $body, $headers);

// 送信結果に応じたリダイレクト
if ($mail_sent) {
    // 送信成功時
    header('Location: thanks.php');
    exit;
} else {
    // 送信失敗時
    header('Location: error.php');
    exit;
}
