
document.addEventListener('DOMContentLoaded', function() {
    try {
        var snippets = document.querySelectorAll('[data-route]');
        for (var i = 0; i < snippets.length; i++) {
            var portlet = snippets[i];
            updatePortlet(portlet);
            if (portlet.getAttribute('data-refresh')) {
                setInterval(
                    updatePortlet,
                    portlet.getAttribute('data-refresh') * 1000,
                    portlet
                )
            }
        }

        var links = document.querySelectorAll('[data-portlet-url]');
        for (var j = 0; j < links.length; j++) {
            links[j].addEventListener('click', function(e) {
                var portlet = document.getElementById(e.originalTarget.getAttribute('data-portlet'));
                portlet.setAttribute('data-route', e.originalTarget.getAttribute('data-portlet-url'));
                var links = document.querySelectorAll('[data-portlet-url]');
                for (var i = 0; i < links.length; i++) {
                    if (
                        links[i].getAttribute('data-portlet') == e.originalTarget.getAttribute('data-portlet')
                        && links[i].classList.contains('selected')
                    ) {
                        links[i].classList.remove('selected')
                    }
                }
                e.originalTarget.classList.add('selected');
                updatePortlet(portlet);
            });
        }


    } catch (e) {}
}, false);




function updatePortlet(portlet) {
    var url = portlet.getAttribute('data-route')
        axios.get(url).then(function (response) {
            try {
                var route = URL.parse(response.request.responseURL).pathname;
                if (URL.parse(response.request.responseURL).search !== undefined) {
                    route = route + URL.parse(response.request.responseURL).search;
                }
                document.querySelectorAll('[data-route="' + route + '"]')[0].innerHTML = response.data;
            } catch (e) {}
    });
}

