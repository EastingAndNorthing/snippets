<?php

$results = DB::connection(DBConnection::LOCAL->value)
    ->table('pt_products')
    ->fromSub(self::getImageRankQuery($merchant_name), 'ranked_images')
    ->select([
        'merchant',
        'search_name',
        'image_url',
        'num_images',
        'rank'
    ])
    ->where('ranked_images.rank', 1)
    ->whereIn('ranked_images.search_name', $search_names)
    ->get()->toArray();


function getImageRankQuery(?string $merchant_name = null) {

    return DB::connection(DBConnection::LOCAL->value)
        ->table('pt_products')
        ->select([
            'merchant',
            'search_name',
            'image_url',
            'additional_image_1',
            'additional_image_2',
            'additional_image_3',
            'additional_image_4',
            'num_images'
        ])
        ->when(
            $merchant_name,

            // If a merchant is given, add different rank + where clause
            fn($query) =>
                $query->selectRaw("
                    DENSE_RANK() OVER (
                        PARTITION BY search_name
                        ORDER BY
                            num_images DESC,
                            merchant ASC,
                            image_url DESC
                    ) as `rank`
                ")->where('merchant_normalised', $merchant_name)
            ,

            // Otherwise, default ranking
            fn($query) =>
                $query->selectRaw("
                    DENSE_RANK() OVER (
                        PARTITION BY search_name
                        ORDER BY num_images DESC
                    ) AS `rank`
                ")
        )
        ->from('pt_products');
}