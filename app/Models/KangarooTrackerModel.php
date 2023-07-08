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

    /**
     * checkIfNameExists
     * @since 2023.07.07
     * @param string $sName
     * @return string
     */
    public function checkIfNameExists(string $sName) : string
    {
        try {
            return self::where('name', '=', $sName)->where('id', '<>', 25)->exists();
        } catch (QueryException $oException) {
            return $oException->getMessage();
        }
    }

    /**
     * addKangaroo
     * @since 2023.07.07
     * @param array $aFormData
     * @return bool|string
     */
    public function addKangaroo(array $aFormData) : bool|string
    {
        try {
            return self::fill($aFormData)->save();
        } catch (QueryException $oException) {
            return $oException->getMessage();
        }
    }

    /**
     * getKangarooById
     * @param int $iId
     * @since 2023.07.08
     * @return array|string
     */
    public function getKangarooById(int $iId) : array|string
    {
        try {
            return self::find($iId)->toArray();
        } catch (QueryException $oException) {
            return $oException->getMessage();
        }
    }

    /**
     * editKangaroo
     * @since 2023.07.08
     * @param int $iId
     * @param array $aFormData
     * @return bool|string
     */
    public function editKangaroo(int $iId, array $aFormData) : bool|string
    {
        try {
            return self::where('id', $iId)->update($aFormData);
        } catch (QueryException $oException) {
            return $oException->getMessage();
        }
    }
}
