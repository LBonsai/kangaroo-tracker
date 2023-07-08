<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'kangaroo';

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = ['created_at' => 'datetime:Y-m-d'];

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'weight', 'height', 'gender', 'color', 'friendliness', 'birthday', 'created_at', 'updated_at'
    ];

    /**
     * getKangaroo
     * @since 2023.07.06
     * @return array
     */
    public function getKangaroo() : array
    {
        return self::orderBy('created_at', 'desc')->get()->toArray();
    }

    /**
     * checkIfNameExists
     * @since 2023.07.07
     * @param array $aParams
     * @return string
     */
    public function checkIfNameExists(array $aParams) : string
    {
        $oQuery = self::where('name', '=', $aParams['name']);

        if (Arr::has($aParams, 'id') === true) {
            $oQuery->where('id', '<>', $aParams['id']);
        }

        return $oQuery->exists();
    }

    /**
     * addKangaroo
     * @since 2023.07.07
     * @param array $aFormData
     * @return bool
     */
    public function addKangaroo(array $aFormData) : bool
    {
        return self::fill($aFormData)->save();
    }

    /**
     * getKangarooById
     * @param int $iId
     * @since 2023.07.08
     * @return array
     */
    public function getKangarooById(int $iId) : array
    {
        return self::find($iId)->toArray();
    }

    /**
     * editKangaroo
     * @since 2023.07.08
     * @param int $iId
     * @param array $aFormData
     * @return bool
     */
    public function editKangaroo(int $iId, array $aFormData) : bool
    {
        return self::where('id', $iId)->update($aFormData);
    }
}
