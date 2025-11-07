// Theme module with navbar icon support; falls back to floating button if none found
(function() {
	const STORAGE_KEY = 'kabalayan-theme';
	const root = document.documentElement;

	function applyTheme(theme) {
		if (theme === 'dark') {
			root.setAttribute('data-theme', 'dark');
		} else {
			root.removeAttribute('data-theme');
		}
	}

	function getPreferredTheme() {
		const saved = localStorage.getItem(STORAGE_KEY);
		if (saved === 'light' || saved === 'dark') return saved;
		const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
		return prefersDark ? 'dark' : 'light';
	}

	function nextTheme() {
		return (root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
	}

	function setTheme(theme) {
		localStorage.setItem(STORAGE_KEY, theme);
		applyTheme(theme);
	}

	function sunIcon() {
		return '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v1"/><path d="M12 20v1"/><path d="M3 12h1"/><path d="M20 12h1"/><path d="M5.6 5.6l.7.7"/><path d="M18.4 18.4l.7.7"/><path d="M5.6 18.4l.7-.7"/><path d="M18.4 5.6l.7-.7"/><circle cx="12" cy="12" r="4"/></svg>';
	}

	function moonIcon() {
		return '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';
	}

	function updateIcon(theme, iconElOrBtn) {
		const isDark = theme === 'dark';
		const html = isDark ? sunIcon() : moonIcon();
		if (!iconElOrBtn) return;
		if (iconElOrBtn.tagName && iconElOrBtn.tagName.toLowerCase() === 'svg') {
			iconElOrBtn.outerHTML = html; // replace
		} else {
			iconElOrBtn.innerHTML = html;
		}
	}

	function mount(button, iconEl) {
		const theme = getPreferredTheme();
		applyTheme(theme);
		updateIcon(theme, iconEl || button);
		button.addEventListener('click', function() {
			const t = nextTheme();
			setTheme(t);
			updateIcon(t, iconEl || button);
			button.setAttribute('aria-label', t === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
		});
	}

	// expose for navbar include to hook
	window.KabalayanTheme = { mount };

	// Fallback: if no navbar button exists, add a small floating icon
	document.addEventListener('DOMContentLoaded', function() {
		const existing = document.getElementById('theme-toggle');
		if (existing) return;
		// Allow pages (e.g., login) to opt out of the floating toggle
		var body = document.body;
		if (body && (body.classList.contains('no-theme-toggle') || body.getAttribute('data-no-theme-toggle') === 'true')) {
			return;
		}
		const btn = document.createElement('button');
		btn.className = 'theme-toggle';
		btn.type = 'button';
		btn.setAttribute('aria-label', 'Toggle theme');
		document.body.appendChild(btn);
		mount(btn, null);
	});
})();


