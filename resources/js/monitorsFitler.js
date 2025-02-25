const monitorsFilter = document.getElementById('monitorsFilter')
if (monitorsFilter) {
    const search = document.getElementById('monitorsFilterSearch');
    search.addEventListener('keyup', function (e) {
        updateFilter()
    });

    const sort = document.getElementById('monitorsFilterSort');
    sort.addEventListener('change', function (e) {
        updateFilter()
    });



    function updateFilter() {
        var portlet = document.getElementById('monitors');
        var path = portlet.getAttribute('data-route');
        if (path.indexOf('?') > 0) {
            path = path.substring(0, path.indexOf('?'))
        }
        portlet.setAttribute(
            'data-route',
            path + '?search=' + search.value + '&sort=' + sort.value
        )


    }

}