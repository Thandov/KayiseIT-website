import { createApp } from 'vue';
import SiteNavbar from './Components/SiteNavbar.vue';

const mountEl = document.getElementById('site-navbar');

if (mountEl) {
    let config = {};
    try {
        config = JSON.parse(mountEl.dataset.nav || '{}');
    } catch {
        config = {};
    }

    createApp(SiteNavbar, config).mount(mountEl);
}
