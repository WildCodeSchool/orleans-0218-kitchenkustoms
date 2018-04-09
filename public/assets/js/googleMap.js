function initMap() {
    var kitchen_kustoms = {lat: 47.900630, lng: 1.906657 };
    var map = new google.maps.Map(document.getElementById('map'), { zoom: 19, center: kitchen_kustoms });
    var marker = new google.maps.Marker({ position: kitchen_kustoms, map: map });
}