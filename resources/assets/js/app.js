import Vue from 'vue';
import "core-js/fn/object/assign";

import { populateAmenitiesAndPrices } from './helpers';
import ModalWindow from './components/ModalWindow';
import ImageCarousel from './components/ImageCarousel';
import HeaderImage from './components/HeaderImage';

let model = JSON.parse(window.vuebnb_listing_model);
model = populateAmenitiesAndPrices(model);

var app = new Vue({
    el: '#app',
    components: {
        ImageCarousel,
        ModalWindow,
        HeaderImage
    },
    data: Object.assign(model, {
        contracted: true
    }),
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    delimiters: ['{{', '}}']
});