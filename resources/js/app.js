import './bootstrap';

import { createApp } from 'vue'
import VueKonva from 'vue-konva';
import Notifications from '@kyvg/vue3-notification'

import App from './App.vue'

createApp(App).use(VueKonva).use(Notifications).mount("#app")
