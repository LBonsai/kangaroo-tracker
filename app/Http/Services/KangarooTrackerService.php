<?php

namespace App\Http\Services;

use App\Models\KangarooTrackerModel;

/**
 * KangarooTrackerService
 *
 * @package App\Http\Services
 * @author Lee Benedict Baniqued
 * @since 2023.07.06
 * @version 1.0
 */
class KangarooTrackerService
{
    /**
     * @var KangarooTrackerModel $oKangarooTrackerModel
     */
    private $oKangarooTrackerModel;

    /**
     * KangarooTrackerService constructor.
     * @since 2023.07.06
     */
    public function __construct(KangarooTrackerModel $oKangarooTrackerModel)
    {
        $this->oKangarooTrackerModel = $oKangarooTrackerModel;
    }

    /**
     * getKangaroo
     * @since 2023.07.06
     * @return array
     */
    public function getKangaroo() : array
    {
        $mResponseData = $this->oKangarooTrackerModel->getKangaroo();

        if (is_array($mResponseData) === false) {
            return [
                'code' => 500,
                'data' => [
                    'message' => $mResponseData
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => $mResponseData
        ];
    }
}
