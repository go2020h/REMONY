document.addEventListener('DOMContentLoaded', function() {
    // 同意チェックボックスと送信ボタンの参照を取得
    const agreeCheckbox = document.getElementById('agree');
    const submitButton = document.querySelector('.button-submit');

    // チェックボックスが存在する場合のみ処理を実行
    if (agreeCheckbox && submitButton) {
        // チェックボックスの状態が変わったときの処理
        agreeCheckbox.addEventListener('change', function() {
            // チェックが入っていればボタンを有効化、そうでなければ無効化
            submitButton.disabled = !this.checked;
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

    // ナビゲーションのホームボタンとロゴのクリック時の処理
    const homeLinks = document.querySelectorAll('nav.nav a[href="index.html"], h1.logo a');
    
    homeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
