async function translatePage(targetLang) {
  const elements = document.querySelectorAll(".translatable");
  for (const el of elements) {
    // Traduce innerHTML
    const original = el.getAttribute("data-original") || el.innerHTML;
    el.setAttribute("data-original", original);
    const translated = await translateText(original, targetLang);
    el.innerHTML = translated;

    // Traduce placeholder si existe
    if (el.placeholder !== undefined && el.hasAttribute("placeholder")) {
      const originalPlaceholder =
        el.getAttribute("data-original-placeholder") || el.placeholder;
      el.setAttribute("data-original-placeholder", originalPlaceholder);
      el.placeholder = await translateText(originalPlaceholder, targetLang);
    }

    // Traduce value si es un botón o input submit/reset/button
    if (
      (el.tagName === "INPUT" &&
        ["submit", "button", "reset"].includes(el.type)) ||
      el.tagName === "BUTTON"
    ) {
      const originalValue = el.getAttribute("data-original-value") || el.value;
      el.setAttribute("data-original-value", originalValue);
      el.value = await translateText(originalValue, targetLang);
    }
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
    selector.options[3].text = "Portugués";
    selector.options[4].text = "Japonés";
    selector.options[5].text = "Chino";
    selector.options[6].text = "Ruso";
  } else if (lang === "en") {
    selector.options[0].text = "Spanish";
    selector.options[1].text = "English";
    selector.options[2].text = "French";
    selector.options[3].text = "Portuguese";
    selector.options[4].text = "Japanese";
    selector.options[5].text = "Chinese";
    selector.options[6].text = "Russian";
  } else if (lang === "fr") {
    selector.options[0].text = "Espagnol";
    selector.options[1].text = "Anglais";
    selector.options[2].text = "Français";
    selector.options[3].text = "Portugais";
    selector.options[4].text = "Japonais";
    selector.options[5].text = "Chinois";
    selector.options[6].text = "Russe";
  } else if (lang === "pt") {
    selector.options[0].text = "Espanhol";
    selector.options[1].text = "Inglês";
    selector.options[2].text = "Francês";
    selector.options[3].text = "Português";
    selector.options[4].text = "Japonês";
    selector.options[5].text = "Chinês";
    selector.options[6].text = "Russo";
  } else if (lang === "ja") {
    selector.options[0].text = "Español";
    selector.options[1].text = "英語";
    selector.options[2].text = "フランス語";
    selector.options[3].text = "ポルトガル語";
    selector.options[4].text = "日本語";
    selector.options[5].text = "中国語";
    selector.options[6].text = "ロシア語";
  } else if (lang === "zh") {
    selector.options[0].text = "Español";
    selector.options[1].text = "英语";
    selector.options[2].text = "法语";
    selector.options[3].text = "葡萄牙语";
    selector.options[4].text = "日语";
    selector.options[5].text = "中文";
    selector.options[6].text = "俄语";
  } else if (lang === "ru") {
    selector.options[0].text = "Español";
    selector.options[1].text = "Английский";
    selector.options[2].text = "Французский";
    selector.options[3].text = "Португальский";
    selector.options[4].text = "Японский";
    selector.options[5].text = "Китайский";
    selector.options[6].text = "Русский";
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
