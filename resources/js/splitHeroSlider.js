document.addEventListener('DOMContentLoaded', () => {
  const hero = document.getElementById('splitHero');
  const toggle = document.getElementById('splitHeroToggle');
  const heroDataEl = document.getElementById('splitHeroData');

  if (!hero || !toggle) return;

  let acfData = {};

  if (heroDataEl) {
    try {
      acfData = JSON.parse(heroDataEl.textContent);
    } catch (error) {
      console.warn('Invalid split hero JSON data', error);
    }
  }

  const fallbackData = {
    mortgages: {
      menuLabel: 'Mortgages',
      menuHref: '#',
      logoTop: 'EASYMOVE',
      logoBottom: 'FINANCIAL',
      eyebrow: 'MORTGAGES',
      title: 'Simple, Secure,<br>Stress-Free',
      text: 'Buying your dream home?<br>We make it clear, personal, and easy.',
      buttonText: 'Discover',
      buttonUrl: '#',
      image:
        'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=2000&auto=format&fit=crop',
    },
    insurance: {
      menuLabel: 'Insurance',
      menuHref: '#',
      logoTop: 'EASYMOVE',
      logoBottom: 'PROTECTION',
      eyebrow: 'INSURANCE',
      title: 'Safe and<br>Protected',
      text: 'Protecting your home or family?<br>We make it clear, personal, and easy.',
      buttonText: 'Discover',
      buttonUrl: '#',
      image:
        'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=2000&auto=format&fit=crop',
    },
  };

  const data = {
    mortgages: {
      ...fallbackData.mortgages,
      ...(acfData.mortgages || {}),
    },
    insurance: {
      ...fallbackData.insurance,
      ...(acfData.insurance || {}),
    },
  };

  const els = {
    openImageA: document.getElementById('openImageA'),
    openImageB: document.getElementById('openImageB'),
    openLogoTop: document.getElementById('openLogoTop'),
    openLogoBottom: document.getElementById('openLogoBottom'),
    openEyebrow: document.getElementById('openEyebrow'),
    openTitle: document.getElementById('openTitle'),
    openText: document.getElementById('openText'),
    openButton: document.getElementById('openButton'),

    closedLogoTop: document.getElementById('closedLogoTop'),
    closedLogoBottom: document.getElementById('closedLogoBottom'),
    closedEyebrow: document.getElementById('closedEyebrow'),
    closedTitle: document.getElementById('closedTitle'),
    closedText: document.getElementById('closedText'),
    closedButton: document.getElementById('closedButton'),
    heroMenuItems: document.querySelectorAll('#openMenu [data-hero-menu-item]'),
  };

  if (!els.openImageA || !els.openImageB) return;

  let openSide = 'left';
  let openKey = 'mortgages';
  let closedKey = 'insurance';
  let locked = false;
  let activeImageIndex = 0;
  let imageSwapToken = 0;
  let hasRendered = false;

  const imageLayers = [els.openImageA, els.openImageB];

  function preloadImage(src) {
    return new Promise((resolve) => {
      if (!src) {
        resolve();
        return;
      }

      const img = new Image();
      let settled = false;

      const finish = () => {
        if (settled) return;
        settled = true;
        resolve();
      };

      img.decoding = 'async';
      img.onload = finish;
      img.onerror = finish;
      img.src = src;

      if (img.complete) {
        finish();
      }
    });
  }

  function setOpenImageInstant(src) {
    if (!src) return;

    const activeLayer = imageLayers[activeImageIndex];
    const idleLayer = imageLayers[activeImageIndex === 0 ? 1 : 0];

    activeLayer.src = src;
    activeLayer.dataset.src = src;
    activeLayer.classList.add('is-active');

    idleLayer.classList.remove('is-active');
    idleLayer.dataset.src = '';
  }

  function crossfadeOpenImage(src) {
    if (!src) return;

    const activeLayer = imageLayers[activeImageIndex];

    if (activeLayer.dataset.src === src) {
      return;
    }

    const nextIndex = activeImageIndex === 0 ? 1 : 0;
    const nextLayer = imageLayers[nextIndex];
    const swapToken = ++imageSwapToken;

    preloadImage(src).then(() => {
      if (swapToken !== imageSwapToken) {
        return;
      }

      nextLayer.src = src;
      nextLayer.dataset.src = src;

      requestAnimationFrame(() => {
        nextLayer.classList.add('is-active');
        activeLayer.classList.remove('is-active');
        activeImageIndex = nextIndex;
      });
    });
  }

  function fillOpen(item) {
    els.openLogoTop.textContent = item.logoTop || '';
    els.openLogoBottom.textContent = item.logoBottom || '';
    els.openEyebrow.textContent = item.eyebrow || '';
    els.openTitle.innerHTML = item.title || '';
    els.openText.innerHTML = item.text || '';
    els.openButton.textContent = item.buttonText || '';
    els.openButton.href = item.buttonUrl || '#';
  }

  function syncHeroMenuGroups() {
    if (!els.heroMenuItems || !els.heroMenuItems.length) {
      return;
    }

    els.heroMenuItems.forEach((menuItem) => {
      const group = menuItem.dataset.heroMenuGroup || 'general';
      const shouldHide =
        (openKey === 'mortgages' && group === 'insurance') ||
        (openKey === 'insurance' && group === 'mortgage');

      menuItem.classList.toggle('hidden', shouldHide);

      if (!shouldHide) {
        return;
      }

      const dialog = menuItem.querySelector('.hero-submenu-dialog');
      const toggle = menuItem.querySelector('.hero-submenu-toggle');

      if (dialog) {
        dialog.classList.add('invisible', 'translate-y-1', 'opacity-0');
        dialog.classList.remove('visible', 'translate-y-0', 'opacity-100');
      }

      if (toggle) {
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  function fillClosed(item) {
    els.closedLogoTop.textContent = item.logoTop || '';
    els.closedLogoBottom.textContent = item.logoBottom || '';
    els.closedEyebrow.textContent = item.eyebrow || '';
    els.closedTitle.innerHTML = item.title || '';
    els.closedText.innerHTML = item.text || '';
    els.closedButton.textContent = item.buttonText || '';
    els.closedButton.href = item.buttonUrl || '#';
  }

  function render() {
    const currentOpen = data[openKey];
    const currentClosed = data[closedKey];

    fillOpen(currentOpen);
    fillClosed(currentClosed);
    syncHeroMenuGroups();

    if (hasRendered) {
      crossfadeOpenImage(currentOpen.image);
    } else {
      setOpenImageInstant(currentOpen.image);
      hasRendered = true;
    }

    preloadImage(currentClosed.image);

    hero.classList.remove('state-open-left', 'state-open-right');
    hero.classList.add(
      openSide === 'left' ? 'state-open-left' : 'state-open-right',
    );
  }

  function togglePanels() {
    if (locked) return;
    locked = true;

    hero.classList.add('is-animating');

    const prevOpenKey = openKey;
    openKey = closedKey;
    closedKey = prevOpenKey;
    openSide = openSide === 'left' ? 'right' : 'left';

    render();

    setTimeout(() => {
      hero.classList.remove('is-animating');
      locked = false;
    }, 920);
  }

  toggle.addEventListener('click', togglePanels);

  render();
});
