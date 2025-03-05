import './bootstrap';
import './modal';
import './monitorsFitler';
import './portlet'
import './graphs'

import '../../node_modules/bootstrap/dist/js/bootstrap.bundle'
import '../../node_modules/chart.js/dist/chart.umd.js'

window.addEventListener('load', function() {
    document.getElementById("menu-toggler").addEventListener("click", function () {
        document.getElementById("menu-currentUser").classList.toggle("d-none");
    });
})