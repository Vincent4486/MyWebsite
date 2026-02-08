/**
 * i18n.js — Lightweight internationalization engine.
 *
 * Usage:
 *   1. Add   data-i18n="section.key"       for textContent replacements
 *   2. Add   data-i18n-html="section.key"   for innerHTML replacements (when the
 *      translation contains HTML like <br>, <code>, etc.)
 *   3. Put   data-i18n="section.title"       on the <title> element to translate
 *      the page title.
 *   4. Include this script in every page:
 *        <script src="/script/i18n.js"></script>
 *
 * The language selector <select id="language-select"> is populated automatically
 * from /locales/languages.json. To add a new language, just:
 *   1. Create /locales/xx-xx.json with translations
 *   2. Add an entry to /locales/languages.json
 *
 * Other scripts can use:
 *   - window.i18n.t("coding.stateActive")   → returns the translated string
 *   - document "i18nReady" event             → fired after first translation
 *   - document "languageChanged" event       → fired on every language switch
 */
(function () {
  'use strict';

  var DEFAULT_LOCALE     = 'en-us';
  var supportedLocales   = [];          // populated from languages.json
  var languageNames      = {};          // e.g. { "en-us": "English", … }
  var currentTranslations = {};

  /* ── helpers ─────────────────────────────────────────────── */

  function getLocale() {
    var stored = localStorage.getItem('preferredLanguage');
    if (stored && supportedLocales.indexOf(stored) !== -1) return stored;

    var browserLang = (navigator.language || navigator.userLanguage || 'en')
                        .substring(0, 2).toLowerCase();
    // Build a reverse map from 2-letter code → first matching locale
    for (var i = 0; i < supportedLocales.length; i++) {
      if (supportedLocales[i].substring(0, 2) === browserLang) return supportedLocales[i];
    }
    return DEFAULT_LOCALE;
  }

  function resolve(obj, dottedKey) {
    return dottedKey.split('.').reduce(function (o, k) {
      return (o && o[k] !== undefined) ? o[k] : null;
    }, obj);
  }

  /* ── load JSON ──────────────────────────────────────────── */

  function loadJSON(path) {
    return fetch(path).then(function (res) {
      if (!res.ok) throw new Error(res.status);
      return res.json();
    });
  }

  function loadTranslations(locale) {
    return loadJSON('/locales/' + locale + '.json')
      .catch(function () {
        console.warn('[i18n] Could not load ' + locale + ', falling back to ' + DEFAULT_LOCALE);
        if (locale !== DEFAULT_LOCALE) return loadTranslations(DEFAULT_LOCALE);
        return {};
      });
  }

  /* ── populate language dropdown ─────────────────────────── */

  function populateDropdown(locale) {
    var sel = document.getElementById('language-select');
    if (!sel) return;
    sel.innerHTML = '';
    supportedLocales.forEach(function (code) {
      var opt = document.createElement('option');
      opt.value = code;
      opt.textContent = languageNames[code] || code;
      sel.appendChild(opt);
    });
    sel.value = locale;
  }

  /* ── apply translations to DOM ──────────────────────────── */

  function apply(translations) {
    // textContent
    document.querySelectorAll('[data-i18n]').forEach(function (el) {
      var val = resolve(translations, el.getAttribute('data-i18n'));
      if (val !== null) {
        if (el.tagName === 'TITLE') document.title = val;
        else el.textContent = val;
      }
    });

    // innerHTML (for strings with markup)
    document.querySelectorAll('[data-i18n-html]').forEach(function (el) {
      var val = resolve(translations, el.getAttribute('data-i18n-html'));
      if (val !== null) el.innerHTML = val;
    });
  }

  /* ── public API ─────────────────────────────────────────── */

  window.i18n = {
    /** Return a translated string by dotted key, e.g. i18n.t('coding.stateActive') */
    t: function (key) {
      return resolve(currentTranslations, key) || key;
    },
    /** Current locale code, e.g. "en-us" */
    locale: DEFAULT_LOCALE
  };

  /** Called by the <select> language chooser */
  window.changeLanguage = function () {
    var locale = document.getElementById('language-select').value;
    localStorage.setItem('preferredLanguage', locale);

    loadTranslations(locale).then(function (t) {
      currentTranslations = t;
      window.i18n.locale = locale;
      apply(t);
      document.documentElement.lang = locale.substring(0, 2);
      document.dispatchEvent(new CustomEvent('languageChanged', { detail: { locale: locale } }));
    });
  };

  /* ── bootstrap ──────────────────────────────────────────── */

  function init() {
    loadJSON('/locales/languages.json')
      .catch(function () {
        // Fallback if languages.json is missing
        return { 'en-us': 'English' };
      })
      .then(function (langs) {
        languageNames  = langs;
        supportedLocales = Object.keys(langs);

        var locale = getLocale();
        localStorage.setItem('preferredLanguage', locale);
        window.i18n.locale = locale;
        document.documentElement.lang = locale.substring(0, 2);

        populateDropdown(locale);

        return loadTranslations(locale);
      })
      .then(function (t) {
        currentTranslations = t;
        apply(t);
        document.dispatchEvent(new CustomEvent('i18nReady', { detail: { locale: window.i18n.locale } }));
      });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
