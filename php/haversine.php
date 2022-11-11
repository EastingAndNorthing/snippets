<?php

class LocationBasedEntity extends CustomPost
{

    public static function queryByLocation($lat, $lng, $radius = 0)
    {

      global $wpdb;

      $sql = $wpdb->prepare( "
          SELECT DISTINCT
              p.ID,
              p.post_title,
              map_lat.meta_value as locLat,
              map_lng.meta_value as locLong,
              ".static::getHaversineDistanceCalculation($lat, $lng)."
              AS distance
          FROM $wpdb->posts p
          INNER JOIN $wpdb->postmeta map_lat ON p.ID = map_lat.post_id
          INNER JOIN $wpdb->postmeta map_lng ON p.ID = map_lng.post_id
          WHERE 1 = 1
          AND p.post_type = '<post_type>'
          AND p.post_status = 'publish'
          AND map_lat.meta_key = '_lat'
          AND map_lng.meta_key = '_lng'
          HAVING distance < %s
          ORDER BY distance ASC", $radius);

      return $wpdb->get_results( $sql );

    }


    public static function getHaversineDistanceCalculation($latitude, $longitude)
    {
        
        if(!filter_var($latitude, FILTER_VALIDATE_FLOAT) || !filter_var($longitude, FILTER_VALIDATE_FLOAT)) {
          $latitude = 0;
          $longitude = 0;
        }

        return sprintf('
            (6371009 * 2 * ASIN(
                SQRT(
                    POWER(SIN((%1$s - abs(map_lat.meta_value)) * pi() / 180 / 2), 2) +
                    COS(%1$s * pi() / 180 ) * COS(abs(map_lat.meta_value) * pi() / 180) *
                    POWER(SIN((%2$s - map_lng.meta_value) * pi() / 180 / 2), 2)
                )
            ))
        ', $latitude, $longitude);

    }
}
