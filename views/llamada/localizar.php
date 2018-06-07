  <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA58qxXem9QkoJUk3cdrR_gG7NZ6ndg99U&libraries=places"></script>-->
<?php


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
//use dosamigos\google\maps\Size;
?>


<?php

$this->title = 'Localización Llamada';

$latitud = $model->latitud;
$longitud = $model->longitud;

$coord = new LatLng(['lat' => $latitud, 'lng' => $longitud]);
$map = new Map([
    'center' => $coord,
    'zoom' => 16,
]);

// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => '('.$latitud.', '.$longitud.')'
]);
 
// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>Ubicación de Persona Discapacitada que realizó la Llamada</p>'
    ])
);
 
$map->addOverlay($marker);
 
// Display the map -finally :)
echo $map->display();
?>
