document.addEventListener('DOMContentLoaded', function() {
    // u540cu610fu30c1u30a7u30c3u30afu30dcu30c3u30afu30b9u3068u9001u4fe1u30dcu30bfu30f3u306eu53c2u7167u3092u53d6u5f97
    const agreeCheckbox = document.getElementById('agree');
    const submitButton = document.querySelector('.button-submit');

    // u30c1u30a7u30c3u30afu30dcu30c3u30afu30b9u304cu5b58u5728u3059u308bu5834u5408u306eu307fu51e6u7406u3092u5b9fu884c
    if (agreeCheckbox && submitButton) {
        // u30c1u30a7u30c3u30afu30dcu30c3u30afu30b9u306eu72b6u614bu304cu5909u308fu3063u305fu3068u304du306eu51e6u7406
        agreeCheckbox.addEventListener('change', function() {
            // u30c1u30a7u30c3u30afu304cu5165u3063u3066u3044u308cu3070u30dcu30bfu30f3u3092u6709u52b9u5316u3001u305du3046u3067u306au3051u308cu3070u7121u52b9u5316
            submitButton.disabled = !this.checked;
        });
    }

    // u30a2u30cbu30e1u30fcu30b7u30e7u30f3u306eu8a2du5b9a
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    
    // u30b9u30afu30edu30fcu30ebu6642u306eu51e6u7406
    function checkScroll() {
        const triggerBottom = window.innerHeight * 0.8;
        
        animateElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            
            if (elementTop < triggerBottom) {
                element.classList.add('show');
            }
        });
    }
    
    // u521du671fu8868u793au6642u306bu4e00u5ea6u30c1u30a7u30c3u30af
    checkScroll();
    
    // u30b9u30afu30edu30fcu30ebu6642u306bu30c1u30a7u30c3u30af
    window.addEventListener('scroll', checkScroll);

    // u30cau30d3u30b2u30fcu30b7u30e7u30f3u306eu30dbu30fcu30e0u30dcu30bfu30f3u3068u30edu30b4u306eu30afu30eau30c3u30afu6642u306eu51e6u7406
    const homeLinks = document.querySelectorAll('nav.nav a[href="index.html"], h1.logo a');
    
    homeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
