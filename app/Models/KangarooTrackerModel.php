<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

/**
 * KangarooTrackerModel
 *
 * @package App\Models
 * @author Lee Benedict Baniqued
 * @since 2023.07.06
 * @version 1.0
 */
class KangarooTrackerModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'kangaroo';

    /**
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];

    /**
     * @var array
     */
    protected $casts = [
        'created_at'  => 'datetime:Y-m-d'
    ];

    /**
     * getKangaroo
     * @since 2023.07.06
     * @return array|string
     */
    public function getKangaroo() : array|string
    {
        try {
            return self::orderBy('created_at', 'desc')->get()->toArray();
        } catch (QueryException $oException) {
            return $oException->getMessage();
        }
    }
}
