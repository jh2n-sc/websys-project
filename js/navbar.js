(function() {
	if (window.__kabalayanNavbarInit) return; // prevent double init
	window.__kabalayanNavbarInit = true;

	function initNavHighlighting() {
		try {
			var links = document.querySelectorAll('nav ul li a');
			var currentPath = window.location.pathname.split('/').pop();
			links.forEach(function(link){
				var href = (link.getAttribute('href') || '').split('/').pop();
				if (href === currentPath || (href === '' && currentPath === 'home.html')) {
					link.classList.add('active');
				}
			});
		} catch(e) {}
	}

	function initSidebar() {
		var openButton = document.getElementById('open-sidebar-button');
		var navbar = document.getElementById('navbar');
		var closeButton = document.getElementById('close-sidebar-button');
		var body = document.body;
		var overlay;
		var MOBILE_MQ = window.matchMedia('(max-width: 768px)');

		function isMobile() { return MOBILE_MQ.matches; }

		function setInert(el, val) {
			if (!el) return;
			if (val) {
				try { el.setAttribute('inert', ''); } catch(e) {}
			} else {
				try { el.removeAttribute('inert'); } catch(e) {}
			}
		}

		function ensureOverlay() {
			if (!overlay) {
				overlay = document.createElement('div');
				overlay.id = 'nav-overlay';
				overlay.style.position = 'fixed';
				overlay.style.inset = '0';
				overlay.style.background = 'rgba(0,0,0,0.4)';
				overlay.style.backdropFilter = 'blur(2px)';
				overlay.style.webkitBackdropFilter = 'blur(2px)';
				overlay.style.display = 'none';
				overlay.style.zIndex = '9';
				overlay.addEventListener('click', function(){ closeSidebar(); });
				document.body.appendChild(overlay);
			}
		}

		function openSidebar() {
			ensureOverlay();
			if (navbar) {
				navbar.classList.add('show');
				setInert(navbar, false); // when opening, always interactive
			}
			if (body) { body.classList.add('sidebar-open'); }
			if (openButton) { openButton.setAttribute('aria-expanded', 'true'); }
			if (overlay) overlay.style.display = 'block';
		}

		function closeSidebar() {
			if (navbar) {
				navbar.classList.remove('show');
				// Only make navbar inert on mobile to disable background nav when the drawer is closed
				setInert(navbar, isMobile());
			}
			if (body) { body.classList.remove('sidebar-open'); }
			if (openButton) { openButton.setAttribute('aria-expanded', 'false'); }
			if (overlay) overlay.style.display = 'none';
		}

		if (openButton) {
			openButton.addEventListener('click', function(e){
				e.preventDefault(); e.stopPropagation();
				openSidebar();
			});
		}
		if (closeButton) {
			closeButton.addEventListener('click', function(e){
				e.preventDefault(); e.stopPropagation();
				closeSidebar();
			});
		}

		document.addEventListener('click', function(e){
			if (!navbar || !navbar.classList.contains('show')) return;
			var isInsideNavbar = navbar.contains(e.target);
			var isOnOpenBtn = openButton && (e.target === openButton || openButton.contains(e.target));
			if (!isInsideNavbar && !isOnOpenBtn) { closeSidebar(); }
		}, true);

		document.addEventListener('keydown', function(e){
			if (e.key === 'Escape' && navbar && navbar.classList.contains('show')) {
				closeSidebar();
			}
		});

		var resizeTimer;
		function handleResize() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function(){
				// On resize, ensure navbar is interactive on desktop and inert only on mobile (when closed)
				if (navbar) {
					if (isMobile()) {
						// keep closed by default on mobile and inert to prevent background focus
						navbar.classList.remove('show');
						setInert(navbar, true);
					} else {
						// desktop: ensure not inert
						navbar.classList.remove('show');
						setInert(navbar, false);
					}
				}
			}, 50);
		}
		window.addEventListener('resize', handleResize);
		// Run once at init to set correct inert state
		handleResize();
	}

	function updateThemeTooltip() {
		const themeToggle = document.getElementById('theme-toggle');
		const themeTooltip = document.getElementById('theme-tooltip');
		const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
		if (themeTooltip) {
			themeTooltip.textContent = isDark ? 'Light Mode' : 'Dark Mode';
		}
	}

	function mountThemeIfPresent() {
		if (window.KabalayanTheme) {
			var btn = document.getElementById('theme-toggle');
			var icon = document.getElementById('theme-icon');
			if (btn) {
				// Store the original click handler
				const originalOnClick = btn.onclick;
				btn.onclick = function(e) {
					// Call the original handler if it exists
					if (originalOnClick) originalOnClick(e);
					// Update the tooltip after a short delay to ensure theme has changed
					setTimeout(updateThemeTooltip, 100);
				};
				window.KabalayanTheme.mount(btn, icon);
			}
		}
		// Initial update of the tooltip
		updateThemeTooltip();
	}

	function init() {
		initNavHighlighting();
		initSidebar();
		mountThemeIfPresent();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();


