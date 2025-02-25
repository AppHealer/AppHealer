function setGraphAveragePointVisibility(point, show) {
    document.getElementById('timeout-pointInner-' + point).setAttribute('visibility', show ? 'visible' : 'hidden');
    var infoBoxElms = document.querySelectorAll('[data-infobox="' + point + '"]');
    for (var i = 0; i < infoBoxElms.length; i++) {
        infoBoxElms[i].setAttribute('visibility', show ? 'visible' : 'hidden');
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var points = document.querySelectorAll('[data-timeout-point]');
    for (var i = 0; i < points.length; i++) {
        points[i].addEventListener('mouseover', function(e) {
            setGraphAveragePointVisibility(
                e.currentTarget.getAttribute('data-timeout-point'),
                true
            );
        });

        points[i].addEventListener('mouseout', function(e) {
            setGraphAveragePointVisibility(
                e.currentTarget.getAttribute('data-timeout-point'),
                false
            );
        });
    }

});