import Vue from 'vue';
import "core-js/fn/object/assign";

import { populateAmenitiesAndPrices } from './helpers';
import ModalWindow from './components/ModalWindow';
import ImageCarousel from './components/ImageCarousel';
import HeaderImage from './components/HeaderImage';
import FeatureList from './components/FeatureList.vue';
import ExpandableText from './components/ExpandableText.vue';

let model = JSON.parse(window.vuebnb_listing_model);
model = populateAmenitiesAndPrices(model);

var app = new Vue({
    el: '#app',
    components: {
        ImageCarousel,
        ModalWindow,
        HeaderImage,
        FeatureList,
        ExpandableText
    },
    data: Object.assign(model, {}),
    methods: {
        openModal() {
            this.$refs.imagemodal.modalOpen = true;
        }
    },
    delimiters: ['{{', '}}']
});