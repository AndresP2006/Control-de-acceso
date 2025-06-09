async function translatePage(targetLang) {
    const elements = document.querySelectorAll('.translatable');
    for (const el of elements) {
        // Guarda el HTML original solo una vez
        const original = el.getAttribute('data-original') || el.innerHTML;
        el.setAttribute('data-original', original);
        const translated = await translateText(original, targetLang);
        el.innerHTML = translated;
    }
}

async function translateText(text, targetLang) {
    if (targetLang === "es") return text;
    // Elimina etiquetas HTML para traducir solo el texto plano
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = text;
    const plainText = tempDiv.innerText;
    const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${targetLang}&dt=t&q=${encodeURIComponent(
        plainText
    )}`;
    const res = await fetch(url);
    const data = await res.json();
    // Devuelve el texto traducido, pero mantiene el HTML original
    return text.replace(plainText, data[0][0][0]);
}

function updateSelectOptions(lang) {
    const selector = document.getElementById("language-selector");
    if (!selector) return;
    if (lang === "es") {
        selector.options[0].text = "Español";
        selector.options[1].text = "Inglés";
        selector.options[2].text = "Francés";
    } else if (lang === "en") {
        selector.options[0].text = "Spanish";
        selector.options[1].text = "English";
        selector.options[2].text = "French";
    } else if (lang === "fr") {
        selector.options[0].text = "Espagnol";
        selector.options[1].text = "Anglais";
        selector.options[2].text = "Français";
    }
}
 
document.addEventListener("DOMContentLoaded", function () {
    const selector = document.getElementById("language-selector");
    if (!selector) return;

    const lang = localStorage.getItem("lang") || "es";
    selector.value = lang;
    updateSelectOptions(lang);
    if (lang !== "es") translatePage(lang);

    selector.addEventListener("change", function () {
        const lang = this.value;
        localStorage.setItem("lang", lang);
        updateSelectOptions(lang);
        translatePage(lang);
    });
});
