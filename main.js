// メインのJavaScriptファイル

document.addEventListener('DOMContentLoaded', () => {
    // スムーズスクロール
    setupSmoothScroll();
    
    // アニメーション
    setupScrollAnimations();
    
    // フォームバリデーション
    setupFormValidation();
    
    // モバイルメニュー
    setupMobileMenu();
});

// スムーズスクロール機能
function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // ヘッダーの高さを考慮
                    behavior: 'smooth'
                });
            }
        });
    });
}

// スクロールアニメーション
function setupScrollAnimations() {
    const elements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });
    
    elements.forEach(element => {
        observer.observe(element);
    });
}

// フォームバリデーション
function setupFormValidation() {
    const form = document.querySelector('.contact-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // 簡易バリデーション
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let isValid = true;
            
            if (!name.value.trim()) {
                showError(name, 'お名前を入力してください');
                isValid = false;
            } else {
                clearError(name);
            }
            
            if (!email.value.trim()) {
                showError(email, 'メールアドレスを入力してください');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, '有効なメールアドレスを入力してください');
                isValid = false;
            } else {
                clearError(email);
            }
            
            if (!message.value.trim()) {
                showError(message, 'お問い合わせ内容を入力してください');
                isValid = false;
            } else {
                clearError(message);
            }
            
            if (isValid) {
                // フォーム送信成功時の処理
                showFormSuccess();
                form.reset();
            }
        });
    }
}

// メールアドレスのバリデーション
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// エラーメッセージの表示
function showError(input, message) {
    const formGroup = input.parentElement;
    let errorElement = formGroup.querySelector('.error-message');
    
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        formGroup.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
    formGroup.classList.add('error');
}

// エラーメッセージのクリア
function clearError(input) {
    const formGroup = input.parentElement;
    const errorElement = formGroup.querySelector('.error-message');
    
    if (errorElement) {
        errorElement.textContent = '';
    }
    
    formGroup.classList.remove('error');
}

// フォーム送信成功時のメッセージ
function showFormSuccess() {
    const form = document.querySelector('.contact-form');
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.textContent = 'お問い合わせありがとうございます。担当者より折り返しご連絡いたします。';
    
    form.insertAdjacentElement('beforebegin', successMessage);
    
    // 3秒後にメッセージを消す
    setTimeout(() => {
        successMessage.remove();
    }, 5000);
}

// モバイルメニュー
function setupMobileMenu() {
    const hamburger = document.createElement('div');
    hamburger.className = 'hamburger';
    hamburger.innerHTML = '<span></span><span></span><span></span>';
    
    const nav = document.querySelector('.nav');
    nav.appendChild(hamburger);
    
    hamburger.addEventListener('click', () => {
        document.body.classList.toggle('menu-open');
    });
    
    // メニュー項目をクリックしたらメニューを閉じる
    const menuItems = document.querySelectorAll('.nav-list a');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            document.body.classList.remove('menu-open');
        });
    });
}
