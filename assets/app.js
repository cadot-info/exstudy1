const $ = require("jquery");
global.$ = global.jQuery = $;
import "bootstrap";

//import "bootstrap/dist/css/bootstrap.css";

import './styles/app.scss';
$('[data-toggle="popover"]').popover();
import "bootstrap/dist/css/bootstrap.css";
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

import './bootstrap';


$('.word').click(function () {
    $('#mots_texte').html('<h4 style="color:black;">' + $(this).attr('question') + '</h4>' + $(this).attr('texte'))
});