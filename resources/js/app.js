const siteHeader = document.querySelector('[data-site-header]');

if (siteHeader && 'IntersectionObserver' in window) {
    const scrollSentinel = document.createElement('div');

    scrollSentinel.setAttribute('aria-hidden', 'true');
    scrollSentinel.style.cssText = 'position:absolute;top:0;left:0;width:1px;height:1px;pointer-events:none;';
    document.body.prepend(scrollSentinel);

    new IntersectionObserver(([entry]) => {
        siteHeader.classList.toggle('is-scrolled', !entry.isIntersecting);
    }).observe(scrollSentinel);
}
