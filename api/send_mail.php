<?php
// ログファイルの設定
$log_file = '/tmp/mail_log.txt';

// ログ関数
function log_message($message) {
    global $log_file;
    $date = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$date] $message\n", FILE_APPEND);
}

log_message('メール送信処理を開始しました');

// 確認画面からの送信かチェック
if (!isset($_POST['confirmed']) || $_POST['confirmed'] != '1') {
    log_message('確認画面からの送信ではありません。エラーページにリダイレクトします。');
    header('Location: /error.html');
    exit;
}

// フォームからのデータを取得
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

log_message("送信データ: 名前=$name, メール=$email");

// 必須項目のチェック
if (empty($name) || empty($email) || empty($message)) {
    log_message('必須項目が入力されていません。エラーページにリダイレクトします。');
    header('Location: /error.html');
    exit;
}

// メール送信先
$to = 'katagiri@hidane.org';

// メールの件名
$subject = 'REMONY for you - お問い合わせがありました';

// メール本文
$mail_body = "以下の内容でお問い合わせがありました。\n\n";
$mail_body .= "お名前: $name\n";
$mail_body .= "メールアドレス: $email\n";
$mail_body .= "お問い合わせ内容:\n$message\n";

// 追加のヘッダー
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// メール送信
$mail_result = mb_send_mail($to, $subject, $mail_body, $headers);

log_message("メール送信結果: " . ($mail_result ? '成功' : '失敗'));

// 送信結果に応じてリダイレクト
if ($mail_result) {
    log_message('メール送信に成功しました。完了ページにリダイレクトします。');
    header('Location: /thanks.html');
} else {
    log_message('メール送信に失敗しました。エラーページにリダイレクトします。');
    header('Location: /error.html');
}
