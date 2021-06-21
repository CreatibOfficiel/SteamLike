class ReloaderLink extends HTMLAnchorElement {
    constructor() {
        super();
        this.addEventListener('click', () => {
            setTimeout(() => {
                window.location.reload();
            }, 50)
        });
    }
}

window.customElements.define('reloader-link', ReloaderLink, { extends: 'a' });