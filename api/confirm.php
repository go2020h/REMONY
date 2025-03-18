<?php
// u30edu30b0u30d5u30a1u30a4u30ebu306eu8a2du5b9a
$log_file = '/tmp/confirm_log.txt';

// u30edu30b0u95a2u6570
function log_message($message) {
    global $log_file;
    $date = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$date] $message\n", FILE_APPEND);
}

log_message('u78bau8a8du753bu9762u51e6u7406u3092u958bu59cbu3057u307eu3057u305f');

// u30d5u30a9u30fcu30e0u304bu3089u306eu30c7u30fcu30bfu3092u53d6u5f97
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';

log_message("u53d7u4fe1u30c7u30fcu30bf: u540du524d=$name, u30e1u30fcu30eb=$email");

// u5fc5u9808u9805u76eeu306eu30c1u30a7u30c3u30af
if (empty($name) || empty($email) || empty($message)) {
    log_message('u5fc5u9808u9805u76eeu304cu5165u529bu3055u308cu3066u3044u307eu305bu3093u3002u30a8u30e9u30fcu30dau30fcu30b8u306bu30eau30c0u30a4u30ecu30afu30c8u3057u307eu3059u3002');
    header('Location: /error.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REMONY for you - u304au554fu3044u5408u308fu305bu78bau8a8d</title>
    <link rel="stylesheet" href="/styles.css">
    <!-- u30edu30b0u51fau529bu7528u306eGoogle Analyticsu30bfu30b0 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
        
        // u30d5u30a9u30fcu30e0u78bau8a8du753bu9762u8868u793au3092u30edu30b0u3068u3057u3066u8a18u9332
        document.addEventListener('DOMContentLoaded', function() {
            console.log('u78bau8a8du753bu9762u304cu8868u793au3055u308cu307eu3057u305f');
            
            if (typeof gtag === 'function') {
                gtag('event', 'form_confirmation', {
                    'event_category': 'contact',
                    'event_label': 'confirmation_displayed'
                });
            }
        });
    </script>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="logo"><a href="/index.html">REMONY for you</a></h1>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="/index.html">u30dbu30fcu30e0</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="confirm-section">
        <div class="container">
            <div class="confirm-box animate-on-scroll">
                <h2 class="section-title">u5165u529bu5185u5bb9u306eu78bau8a8d</h2>
                <ul class="form-steps">
                    <li>u5165u529b</li>
                    <li class="active">u78bau8a8d</li>
                    <li>u5b8cu4e86</li>
                </ul>
                <div class="confirm-content">
                    <p>u4ee5u4e0bu306eu5185u5bb9u3067u9001u4fe1u3057u307eu3059u3002u3088u308du3057u3051u308cu3070u300cu9001u4fe1u3059u308bu300du30dcu30bfu30f3u3092u62bcu3057u3066u304fu3060u3055u3044u3002</p>
                    
                    <table class="confirm-table">
                        <tr>
                            <th>u304au540du524d</th>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <th>u30e1u30fcu30ebu30a2u30c9u30ecu30b9</th>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <th>u304au554fu3044u5408u308fu305bu5185u5bb9</th>
                            <td><?php echo nl2br($message); ?></td>
                        </tr>
                    </table>
                    
                    <div class="button-group">
                        <form action="/index.html" method="get" class="back-form">
                            <button type="submit" class="button-back">u4feeu6b63u3059u308b</button>
                        </form>
                        
                        <form action="/api/send_mail.php" method="post" class="send-form">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <input type="hidden" name="message" value="<?php echo $message; ?>">
                            <input type="hidden" name="confirmed" value="1">
                            <button type="submit" class="button-submit">u9001u4fe1u3059u308b</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 REMONY for you. All rights reserved.</p>
        </div>
    </footer>

    <script src="/scripts.js"></script>
</body>
</html>
