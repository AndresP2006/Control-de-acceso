async function translatePage(targetLang) {
    const elements = document.querySelectorAll('.translatable');
    for (const el of elements) {
        const original = el.getAttribute('data-original') || el.innerText;
        el.setAttribute('data-original', original);
        const translated = await translateText(original, targetLang);
        el.innerText = translated;
    }
}

async function translateText(text, targetLang) {
    if (targetLang === 'es') return text;
    const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${targetLang}&dt=t&q=${encodeURIComponent(text)}`;
    const res = await fetch(url);
    const data = await res.json();
    return data[0][0][0];
}

document.addEventListener('DOMContentLoaded', function() {
    const selector = document.getElementById('language-selector');
    if (!selector) return;
    selector.addEventListener('change', function() {
        const lang = this.value;
        localStorage.setItem('lang', lang);
        translatePage(lang);
    });
    const lang = localStorage.getItem('lang') || 'es';
    selector.value = lang;
    if (lang !== 'es') translatePage(lang);
});