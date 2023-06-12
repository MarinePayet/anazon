import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import { startStimulusApp } from '@symfony/stimulus-bridge';

import './styles/app.scss';

const $ = require('jquery');
require('bootstrap');

import a2lix_lib from '@a2lix/symfony-collection/dist/a2lix_sf_collection.min'

a2lix_lib.sfCollection.init()


// export const app = startStimulusApp(require.context(
//     '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
//     true,
//     /\.(j|t)sx?$/
// ));