<?php
namespace App\Core\Models;

/**
 * @author Sergei Melnikov <me@rnr.name>
 */
class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id_news';

    public function addresses() {
        return $this->hasMany(AddressModel::class, 'id_news');
    }

    public function getDateNewsAttribute($value) {
        return json_decode($value);
    }
}