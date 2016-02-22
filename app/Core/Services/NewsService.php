<?php
namespace App\Core\Services;
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
            ]),
            'link' => array_get($data, 'link'),
            'image' => array_get($data, 'image')
        ]);

        $latitude = array_get($data, 'latitude');
        $longitude = array_get($data, 'longitude');

        $address = $news->addresses()->create([
            'object' => json_encode([
                'raw' => array_get($data, 'address')
            ]),
            'latitude' => empty($latitude) ? (null) : $latitude,
            'longitude' => empty($longitude) ? (null) : $longitude
        ]);

        $news->addresses()->save($address);

        return $news->toArray();
    }

    public function getAll($criteria = []) {
        $news = NewsModel::with('addresses')->get();

        return $news->toArray();
    }
}