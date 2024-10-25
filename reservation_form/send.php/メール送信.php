<?php
// PHPMailerライブラリの読み込み
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailerを使うための必要なファイルを読み込む
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// PHPMailerのインスタンスを作成
$mail = new PHPMailer(true);

try {
    // サーバー設定
    $mail->isSMTP();                                           // SMTPを使用
    $mail->Host       = 'smtp.gmail.com';                      // SMTPサーバーを指定
    $mail->SMTPAuth   = true;                                  // SMTP認証を有効に
    $mail->Username   = 'horimoto@dia-niigata.co.jp';          // Gmailのメールアドレス
    $mail->Password   = 'dfed fcso zooq mark';                 // Gmailのアプリパスワード
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // TLS暗号化を有効に
    $mail->Port       = 587;                                   // TCPポートを指定（TLSの場合は587）

    // 送信元と送信先の設定
    $mail->setFrom('horimoto@dia-niigata.co.jp', 'ダイアパレス予約フォーム');    // 送信元アドレスと名前
    $mail->addAddress('horimoto@dia-niigata.co.jp');          // 送信先アドレス

    // メールの内容
    $mail->isHTML(true);                                       // HTML形式でメールを送信
    $mail->Subject = 'ダイアパレス ご予約フォームからの問い合わせ';

    // フォームからのデータを取得
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $time2 = $_POST['time2'];
    $email = $_POST['email'];
    $postcode = $_POST['postcode'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // メールの本文
    $mailContent = "
    <h1>ご予約フォームの詳細</h1>
    <p><strong>お名前:</strong> $name</p>
    <p><strong>ご来場の日付:</strong> $date</p>
    <p><strong>ご来場の時間:</strong> $time</p>
    <p><strong>第二希望の時間:</strong> $time2</p>
    <p><strong>メールアドレス:</strong> $email</p>
    <p><strong>郵便番号:</strong> $postcode</p>
    <p><strong>住所:</strong> $address</p>
    <p><strong>電話番号:</strong> $phone</p>
    ";

    $mail->Body    = $mailContent;

    // メール送信を実行
    $mail->send();
    echo 'ご予約ありがとうございました！送信が成功しました。';
} catch (Exception $e) {
    echo "メール送信に失敗しました。エラー: {$mail->ErrorInfo}";
}
?>
