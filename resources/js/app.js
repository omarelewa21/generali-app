import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler';
import welcome from './components/welcome.vue';
import genderlogic from './components/gender-logic.vue';

const gender = createApp({});
gender.component('gender-component',genderlogic);

const welcome = createApp({});
welcome.component('welcome-component', welcome);


gender.mount('#home');
welcome.mount('#welcome');

