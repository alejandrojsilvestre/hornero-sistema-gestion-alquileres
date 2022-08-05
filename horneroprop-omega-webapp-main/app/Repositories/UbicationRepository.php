<?php

namespace App\Repositories;

use Spatie\Geocoder\Facades\Geocoder;

class UbicationRepository {

    public static function setUbicationToModel($model) : void
    {
        if($geocode = static::getGeocode()) {
            if(!$geocode['lat'] && !$geocode['lng']) {
                return;
            }

            $geoLat = $geocode['lat'];
            $geoLng = $geocode['lng'];

            foreach($geocode['address_components'] as $addressComponent) {
                // Country
                if($addressComponent->types[0] === 'country') {
                    $geoCountry = $addressComponent->long_name;
                }

                // Province
                if($addressComponent->types[0] === 'administrative_area_level_1') {
                    $geoProvince = $addressComponent->short_name;
                }

                // Locality
                if (isset($addressComponent->types[1])) {
                    switch ($addressComponent->types[1]) {
                        case 'sublocality' :
                            $geoLocality = $addressComponent->long_name;
                            break;
                    }
                }

                if(!isset($geoLocality)) {
                    switch ($addressComponent->types[0]) {
                        case 'neighborhood' :
                            $geoLocality = $addressComponent->long_name;
                            break;
                        case 'locality' :
                            if(!isset($geoLocality)) {
                                $geoLocality = $addressComponent->long_name;
                            }
                            break;
                    }
                }
            }

            if (isset($geoLat)) {
                $model->lat = $geoLat;
            }
            if (isset($geoLng)) {
                $model->lng = $geoLng;
            }
            if (isset($geoLocality)) {
                $localidad = \App\Localidad::firstOrCreate(['nombre' => $geoLocality]);
                $model->localidad()->associate($localidad->id);
            }
            if (isset($geoProvince)) {
                $provincia = \App\Provincia::firstOrCreate(['nombre' => $geoProvince]);
                $model->provincia()->associate($provincia->id);
            }
            if (isset($geoCountry)) {
                $pais = \App\Pais::firstOrCreate(['nombre' => $geoCountry]);
                $model->pais()->associate($pais->id);
            }

            $model->save();
        }

    }

    public static function getGeocode() : ?Array {
        if (request()->direccion) {
            try {
                return Geocoder::getCoordinatesForAddress(request()->direccion);
            } catch(\Exception $e) {
                return null;
            }
        } else {
            return null;
        }
    }
}