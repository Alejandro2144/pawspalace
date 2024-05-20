function initMap() {
    var mapOptions = {
        center: {
            lat: 6.192683696746826,
            lng: -75.56332397460938
        },
        zoom: 14
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var marker = new google.maps.Marker({
        position: {
            lat: 6.192683696746826,
            lng: -75.56332397460938
        },
        map: map,
        title: 'My location'
    });
}
window.onload = initMap;

function setFlag(flagCode) {
    document.getElementById('selected-flag').className = 'flag-icon flag-icon-' + flagCode;
}
