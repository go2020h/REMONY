document.addEventListener('DOMContentLoaded', function() {
    // 同意チェックボックスと送信ボタンの参照を取得
    const agreeCheckbox = document.getElementById('agree');
    const confirmButton = document.getElementById('confirm-button');
    const contactForm = document.getElementById('contactForm');
    const backButton = document.getElementById('back-button');
    const submitButton = document.getElementById('submit-button');
    
    // 入力セクションと確認セクションの参照を取得
    const inputSection = document.getElementById('input-section');
    const confirmSection = document.getElementById('confirm-section');
    
    // ステップ表示の参照を取得
    const stepInput = document.getElementById('step-input');
    const stepConfirm = document.getElementById('step-confirm');
    const stepComplete = document.getElementById('step-complete');

    // チェックボックスが存在する場合のみ処理を実行
    if (agreeCheckbox && confirmButton) {
        // チェックボックスの状態が変わったときの処理
        agreeCheckbox.addEventListener('change', function() {
            // チェックが入っていればボタンを有効化、そうでなければ無効化
            confirmButton.disabled = !this.checked;
            
            // ボタンの外観も更新
            if (this.checked) {
                confirmButton.style.opacity = '1';
                confirmButton.style.cursor = 'pointer';
            } else {
                confirmButton.style.opacity = '0.65';
                confirmButton.style.cursor = 'not-allowed';
            }
        });
        
        // 初期状態を設定
        confirmButton.disabled = !agreeCheckbox.checked;
        confirmButton.style.opacity = agreeCheckbox.checked ? '1' : '0.65';
        confirmButton.style.cursor = agreeCheckbox.checked ? 'pointer' : 'not-allowed';
    }
    
    // 確認ボタンのクリックイベント
    if (confirmButton) {
        confirmButton.addEventListener('click', function() {
            // フォームのバリデーション
            const name = document.getElementById('name').value;
            const kana = document.getElementById('kana').value;
            const zipcode = document.getElementById('zipcode') ? document.getElementById('zipcode').value : '';
            const address = document.getElementById('address') ? document.getElementById('address').value : '';
            const tel = document.getElementById('tel').value;
            const callTimeRadio = document.querySelector('input[name="call-time"]:checked');
            const callTime = callTimeRadio ? callTimeRadio.value : '';
            const specificTimeDetail = document.getElementById('specific-time-detail') ? document.getElementById('specific-time-detail').value : '';
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            if (!name || !kana || !tel || !email || !message) {
                alert('すべての必須項目を入力してください。');
                return;
            }
            
            // 確認画面に値をセット
            document.getElementById('confirm-name').textContent = name;
            document.getElementById('confirm-kana').textContent = kana;
            
            // 住所情報を統合して表示
            let fullAddress = '';
            if (zipcode) fullAddress += `〒${zipcode} `;
            if (address) fullAddress += address;
            document.getElementById('confirm-address').textContent = fullAddress || '未入力';
            
            document.getElementById('confirm-tel').textContent = tel || '未入力';
            
            // 電話時間の表示を更新
            let callTimeText = '';
            if (callTime === 'anytime') {
                callTimeText = 'いつでも';
            } else if (callTime === 'specific-time' && specificTimeDetail) {
                callTimeText = `時間指定: ${specificTimeDetail}`;
            } else if (callTime === 'specific-time') {
                callTimeText = '時間指定';
            }
            document.getElementById('confirm-call-time').textContent = callTimeText || '未入力';
            
            document.getElementById('confirm-email').textContent = email;
            document.getElementById('confirm-message').textContent = message;
            
            // 入力画面を非表示にし、確認画面を表示
            inputSection.style.display = 'none';
            confirmSection.style.display = 'block';
            
            // ステップの表示を更新
            stepInput.classList.remove('active');
            stepConfirm.classList.add('active');
            
            // コンソールにログを出力
            console.log('確認画面が表示されました');
        });
    }
    
    // 戻るボタンのクリックイベント
    if (backButton) {
        backButton.addEventListener('click', function() {
            // 確認画面を非表示にし、入力画面を表示
            confirmSection.style.display = 'none';
            inputSection.style.display = 'block';
            
            // ステップの表示を更新
            stepConfirm.classList.remove('active');
            stepInput.classList.add('active');
            
            // コンソールにログを出力
            console.log('入力画面に戻りました');
        });
    }

    // アニメーションの設定
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    
    // スクロール時の処理
    function checkScroll() {
        const triggerBottom = window.innerHeight * 0.8;
        
        animateElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            
            if (elementTop < triggerBottom) {
                element.classList.add('show');
            }
        });
    }
    
    // 初期表示時に一度チェック
    checkScroll();
    
    // スクロール時にチェック
    window.addEventListener('scroll', checkScroll);

    // 送信ボタンのクリックイベント
    if (submitButton) {
        submitButton.addEventListener('click', function(e) {
            e.preventDefault(); // 送信ボタンのデフォルト動作をキャンセル
            
            // 送信ボタンを無効化
            submitButton.disabled = true;
            
            // フォームデータを取得
            const formData = new FormData(contactForm);
            const webhookUrl = formData.get('_webhook');
            
            // フォームデータをオブジェクトに変換
            let formValues = {};
            let contentText = '';
            
            // 各フォーム項目を取得し、contentに追加
            const formLabels = {
                'name': '氏名',
                'kana': 'フリガナ',
                'zipcode': '郵便番号',
                'address': '住所',
                'tel': '電話番号',
                'call-time': '連絡時間',
                'specific-time-detail': '時間指定詳細',
                'email': 'メールアドレス',
                'message': 'お問い合わせ内容'
            };
            
            for (let [key, value] of formData.entries()) {
                // 同意チェックボックスとシステムフォーム項目を除外
                if (key !== '_webhook' && key !== '_subject' && key !== '_captcha' && key !== 'agree') {
                    // 値を保存
                    formValues[key] = value;
                    
                    // ラベルを取得
                    const label = formLabels[key] || key;
                    
                    // 表示値を取得
                    const displayValue = value.trim() ? value : '未入力';
                    
                    // contentに追加
                    contentText += `<br><br>【${label}】<br>${displayValue}`;
                }
            }
            
            // contentメール本文を追加
            formValues['content'] = `<br><br>==== REMONYよりお問い合わせ内容 ====${contentText}<br><br>================<br>`;
            
            console.log('フォームデータ:', formValues);
            
            // 確認画面を非表示
            confirmSection.style.display = 'none';
            
            // フォームを非表示
            contactForm.style.display = 'none';
            
            // Webhookに送信
            fetch(webhookUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formValues)
            })
            .then(response => {
                console.log('Webhook送信結果:', response);
                
                // 完了画面を表示
                const existingCompleteSection = document.getElementById('complete-section');
                if (existingCompleteSection) {
                    existingCompleteSection.remove();
                }
                
                let completeSection = document.createElement('div');
                completeSection.id = 'complete-section';
                completeSection.className = 'form-section';
                completeSection.innerHTML = `
                    <div class="complete-message">
                        <h3>送信完了</h3>
                        <p>お問い合わせ内容が送信されました。<br>内容を確認し、担当者よりご連絡差し上げます。</p>
                    </div>
                `;
                
                contactForm.parentNode.appendChild(completeSection);
                
                // ステップの表示を更新
                stepConfirm.classList.remove('active');
                stepComplete.classList.add('active');
            })
            .catch(error => {
                console.error('送信エラー:', error);
                alert('送信エラーが発生しました。もう一度お試しください。');
                // 送信ボタンを有効化
                submitButton.disabled = false;
            });
        });
    }

    // ナビゲーションのホームボタンとロゴのクリック時の処理
    const homeLinks = document.querySelectorAll('nav.nav a[href="index.html"], h1.logo a');
    
    homeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
