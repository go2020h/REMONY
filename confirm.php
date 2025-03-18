<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REMONY for you - u304au554fu3044u5408u308fu305bu78bau8a8d</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="logo"><a href="index.html">REMONY for you</a></h1>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="index.html">u30dbu30fcu30e0</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="confirm-section">
        <div class="container">
            <div class="confirm-box animate-on-scroll">
                <h2 class="section-title">u304au554fu3044u5408u308fu305bu5185u5bb9u306eu78bau8a8d</h2>
                <ul class="form-steps">
                    <li>u5165u529b</li>
                    <li class="active">u78bau8a8d</li>
                    <li>u5b8cu4e86</li>
                </ul>
                <div class="confirm-content">
                    <?php
                    // u30d5u30a9u30fcu30e0u304bu3089u9001u4fe1u3055u308cu305fu30c7u30fcu30bfu3092u53d6u5f97
                    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
                    $kana = isset($_POST['kana']) ? htmlspecialchars($_POST['kana'], ENT_QUOTES, 'UTF-8') : '';
                    $postal = isset($_POST['postal']) ? htmlspecialchars($_POST['postal'], ENT_QUOTES, 'UTF-8') : '';
                    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8') : '';
                    $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8') : '';
                    $time = isset($_POST['time']) ? htmlspecialchars($_POST['time'], ENT_QUOTES, 'UTF-8') : '';
                    $time_detail = isset($_POST['time_detail']) ? htmlspecialchars($_POST['time_detail'], ENT_QUOTES, 'UTF-8') : '';
                    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
                    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';
                    
                    // u9023u7d61u53efu80fdu6642u9593u306eu8868u793au7528u30c6u30adu30b9u30c8u3092u751fu6210
                    $time_text = ($time == 'anytime') ? 'u3044u3064u3067u3082u53ef' : 'u6642u9593u6307u5b9a: ' . $time_detail;
                    ?>
                    
                    <table class="confirm-table">
                        <tbody>
                            <tr>
                                <th>u304au540du524d</th>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <th>u30d5u30eau30acu30ca</th>
                                <td><?php echo $kana; ?></td>
                            </tr>
                            <tr>
                                <th>u3054u4f4fu6240</th>
                                <td>u3012<?php echo $postal; ?><br><?php echo $address; ?></td>
                            </tr>
                            <tr>
                                <th>u96fbu8a71u756au53f7</th>
                                <td><?php echo $tel; ?></td>
                            </tr>
                            <tr>
                                <th>u9023u7d61u53efu80fdu6642u9593</th>
                                <td><?php echo $time_text; ?></td>
                            </tr>
                            <tr>
                                <th>u30e1u30fcu30ebu30a2u30c9u30ecu30b9</th>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <th>u304au554fu3044u5408u308fu305bu5185u5bb9</th>
                                <td><?php echo nl2br($message); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <form action="send_mail.php" method="post" class="confirm-form">
                        <!-- u30d5u30a9u30fcu30e0u30c7u30fcu30bfu3092u975eu8868u793au30d5u30a3u30fcu30ebu30c9u3068u3057u3066u9001u4fe1 -->
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="kana" value="<?php echo $kana; ?>">
                        <input type="hidden" name="postal" value="<?php echo $postal; ?>">
                        <input type="hidden" name="address" value="<?php echo $address; ?>">
                        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
                        <input type="hidden" name="time" value="<?php echo $time; ?>">
                        <input type="hidden" name="time_detail" value="<?php echo $time_detail; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="message" value="<?php echo $message; ?>">
                        <input type="hidden" name="confirmed" value="1">
                        
                        <div class="button-area">
                            <button type="button" class="button-back" onclick="history.back();">u4feeu6b63u3059u308b</button>
                            <button type="submit" class="button-submit">u9001u4fe1u3059u308b</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 REMONY for you. All rights reserved.</p>
        </div>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
