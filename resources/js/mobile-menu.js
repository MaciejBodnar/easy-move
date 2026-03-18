import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.headerMenu = function () {
  return {
    mobileOpen: false,
    closeAll() {
      this.mobileOpen = false;
    },
    toggleMobile() {
      this.mobileOpen = !this.mobileOpen;
    },
  };
};

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const mobileMenu = document.querySelector('.mobile-menu');
  if (!mobileMenu) return;

  const parents = mobileMenu.querySelectorAll('.menu-item-has-children');

  parents.forEach((item) => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > .sub-menu');

    if (!link || !submenu) return;

    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'mobile-submenu-toggle';
    button.setAttribute('aria-expanded', 'false');
    button.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
    `;

    const row = document.createElement('div');
    row.className = 'mobile-parent-row';

    link.parentNode.insertBefore(row, link);
    row.appendChild(link);
    row.appendChild(button);

    submenu.hidden = true;

    button.addEventListener('click', () => {
      const expanded = button.getAttribute('aria-expanded') === 'true';
      button.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      submenu.hidden = expanded;
      item.classList.toggle('is-open', !expanded);
    });
  });
});
