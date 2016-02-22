<?php
namespace App\Core\Services;
use App\Core\Models\AddressModel;
use App\Core\Models\NewsModel;

/**
 * @author Sergei Melnikov <me@rnr.name>
 */
class NewsService
{
    public function store($data) {
        $news = NewsModel::create([
            'id_category' => array_get($data, 'category'),
            'title' => array_get($data, 'title'),
            'content' => array_get($data, 'content'),
            'date_news' => json_encode([
                'time_news' => array_get($data, 'date')
            ])
        ]);

        $address = $news->addresses()->create([
            'object' => json_encode([
                'raw' => array_get($data, 'address')
            ]),
            'latitude' => array_get($data, 'latitude'),
            'longitude' => array_get($data, 'longitude'),
        ]);

        $news->addresses()->save($address);

        return $news->toArray();
    }

    public function getAll($criteria) {
        return [

        ];
    }
}