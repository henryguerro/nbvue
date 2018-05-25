import Vue from 'vue';
import "core-js/fn/object/assign";

import { populateAmenitiesAndPrices } from './helpers';
import ModalWindow from './components/ModalWindow';
import ImageCarousel from './components/ImageCarousel';

let model = JSON.parse(window.vuebnb_listing_model);
model = populateAmenitiesAndPrices(model);

var app = new Vue({
    el: '#app',
    components: {
        ImageCarousel,
        ModalWindow
    },
    data: Object.assign(model, {
        headerImageStyle: {
            'background-image': `url(${model.images[0]})`
        },
        contracted: true
    }),
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    delimiters: ['{{', '}}']
});