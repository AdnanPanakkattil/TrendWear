'use strict';

(function () {
  var config = window.TrendWearThemeConfig || {};
  var defaultColor = config.defaultColor || '#ff5722';
  var presets = Array.isArray(config.presets) ? config.presets : [];
  var saveUrl = config.saveUrl || '';
  var currentColor = (config.currentColor || defaultColor).toLowerCase();

  function normalizeHex(hex) {
    if (typeof hex !== 'string') {
      return defaultColor;
    }
    var trimmed = hex.trim().toLowerCase();
    return /^#[0-9a-f]{6}$/.test(trimmed) ? trimmed : defaultColor;
  }

  function computePalette(hex) {
    var clean = normalizeHex(hex);
    var r = parseInt(clean.slice(1, 3), 16);
    var g = parseInt(clean.slice(3, 5), 16);
    var b = parseInt(clean.slice(5, 7), 16);
    var darken = function (c) {
      return Math.max(0, Math.round(c * 0.86));
    };
    var toHex = function (c) {
      return c.toString(16).padStart(2, '0');
    };
    return {
      primary: clean,
      primaryDark: '#' + toHex(darken(r)) + toHex(darken(g)) + toHex(darken(b)),
      primaryRgb: r + ', ' + g + ', ' + b
    };
  }

  function applyColorTheme(hex) {
    var palette = computePalette(hex);
    var root = document.documentElement;
    var isDark = root.classList.contains('dark-style');

    root.style.setProperty('--tw-primary', palette.primary);
    root.style.setProperty('--tw-primary-dark', palette.primaryDark);
    root.style.setProperty('--tw-primary-rgb', palette.primaryRgb);
    root.style.setProperty(
      '--tw-primary-light',
      'rgba(' + palette.primaryRgb + ', ' + (isDark ? '0.15' : '0.12') + ')'
    );
    root.style.setProperty('--bs-primary', palette.primary);
    root.style.setProperty('--bs-primary-rgb', palette.primaryRgb);

    currentColor = palette.primary;
    document.dispatchEvent(
      new CustomEvent('tw:theme-color-changed', {
        detail: palette
      })
    );
  }

  function persistColorTheme(hex) {
    if (!saveUrl) {
      return;
    }
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var token = csrfMeta ? csrfMeta.getAttribute('content') : '';

    fetch(saveUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify({ theme_color: normalizeHex(hex) })
    }).catch(function () {
      // Keep live preview active even if network fails
    });
  }

  function syncActiveControls(container, hex) {
    var normalized = normalizeHex(hex);
    var swatches = container.querySelectorAll('.tw-color-swatch');
    swatches.forEach(function (btn) {
      var swatchColor = normalizeHex(btn.getAttribute('data-color'));
      btn.classList.toggle('active', swatchColor === normalized);
    });

    var picker = container.querySelector('.tw-custom-color-input');
    var hexLabel = container.querySelector('.tw-custom-color-hex');
    if (picker) {
      picker.value = normalized;
    }
    if (hexLabel) {
      hexLabel.textContent = normalized.toUpperCase();
    }
  }

  function buildColorCustomizerBlock() {
    var wrapper = document.createElement('div');
    wrapper.className = 'm-0 px-6 pt-6 template-customizer-color-theme w-100';

    var label = document.createElement('label');
    label.className = 'form-label d-block mb-2';
    label.textContent = 'Color Theme';
    wrapper.appendChild(label);

    var grid = document.createElement('div');
    grid.className = 'tw-color-theme-grid';

    presets.forEach(function (preset) {
      var btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'tw-color-swatch';
      btn.setAttribute('data-color', preset.color);
      btn.setAttribute('title', preset.name);
      btn.style.setProperty('--tw-swatch-color', preset.color);

      var dot = document.createElement('span');
      dot.className = 'tw-color-swatch-dot';
      dot.innerHTML = '<i class="ti ti-check"></i>';

      var text = document.createElement('span');
      text.className = 'tw-color-swatch-label';
      text.textContent = preset.name;

      btn.appendChild(dot);
      btn.appendChild(text);

      btn.addEventListener('click', function () {
        var selected = btn.getAttribute('data-color');
        applyColorTheme(selected);
        syncActiveControls(wrapper, selected);
        persistColorTheme(selected);
      });

      grid.appendChild(btn);
    });

    wrapper.appendChild(grid);

    var customRow = document.createElement('div');
    customRow.className = 'tw-custom-color-row';

    var customLabel = document.createElement('span');
    customLabel.className = 'small fw-medium';
    customLabel.textContent = 'Custom Color';

    var pickerWrap = document.createElement('div');
    pickerWrap.className = 'tw-custom-color-picker-wrap';

    var hexText = document.createElement('span');
    hexText.className = 'tw-custom-color-hex';
    hexText.textContent = currentColor.toUpperCase();

    var colorInput = document.createElement('input');
    colorInput.type = 'color';
    colorInput.className = 'tw-custom-color-input';
    colorInput.value = currentColor;
    colorInput.setAttribute('aria-label', 'Choose custom color theme');

    colorInput.addEventListener('input', function () {
      applyColorTheme(colorInput.value);
      syncActiveControls(wrapper, colorInput.value);
    });

    colorInput.addEventListener('change', function () {
      applyColorTheme(colorInput.value);
      syncActiveControls(wrapper, colorInput.value);
      persistColorTheme(colorInput.value);
    });

    pickerWrap.appendChild(hexText);
    pickerWrap.appendChild(colorInput);
    customRow.appendChild(customLabel);
    customRow.appendChild(pickerWrap);
    wrapper.appendChild(customRow);

    syncActiveControls(wrapper, currentColor);
    return wrapper;
  }

  function mountIntoTemplateCustomizer() {
    var customizer = document.getElementById('template-customizer');
    if (!customizer) {
      return false;
    }

    var themingSection = customizer.querySelector('.template-customizer-theming');
    if (!themingSection) {
      return false;
    }

    if (themingSection.querySelector('.template-customizer-color-theme')) {
      return true;
    }

    var block = buildColorCustomizerBlock();
    themingSection.appendChild(block);

    var resetBtn = customizer.querySelector('.template-customizer-reset-btn');
    if (resetBtn) {
      resetBtn.addEventListener('click', function () {
        applyColorTheme(defaultColor);
        syncActiveControls(block, defaultColor);
        persistColorTheme(defaultColor);
      });
    }

    return true;
  }

  function initColorCustomizer() {
    if (mountIntoTemplateCustomizer()) {
      return;
    }

    if (document.body && typeof MutationObserver !== 'undefined') {
      var observer = new MutationObserver(function () {
        if (mountIntoTemplateCustomizer()) {
          observer.disconnect();
        }
      });

      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initColorCustomizer);
  } else {
    initColorCustomizer();
  }

  window.addEventListener('load', mountIntoTemplateCustomizer);
})();

