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

    /**
     * checkIfNameExists
     * @since 2023.07.07
     * @param string $sName
     * @return array
     */
    public function checkIfNameExists(string $sName) : array
    {
        $sResponse = $this->oKangarooTrackerModel->checkIfNameExists($sName);
        if ($sResponse !== '' && $sResponse !== '1') {
            return [
                'code' => 500,
                'data' => [
                    'message' => $sResponse
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'bIsExist' => ((int)$sResponse === 1)
            ]
        ];
    }

    /**
     * addKangaroo
     * @since 2023.07.07
     * @param array $aFormData
     * @return array
     */
    public function addKangaroo(array $aFormData) : array
    {
        $aFormData['created_at'] = now();
        $mResponseData = $this->oKangarooTrackerModel->addKangaroo($aFormData);
        if (is_bool($mResponseData) === false || $mResponseData === false) {
            return [
                'code' => 500,
                'data' => [
                    'message' => 'The new data could not be registered. Please try again.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => $mResponseData
        ];
    }

    /**
     * getKangarooById
     * @since 2023.07.08
     * @param int $iId
     * @return array
     */
    public function getKangarooById(int $iId) : array
    {
        $mResponseData = $this->oKangarooTrackerModel->getKangarooById($iId);
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

    /**
     * editKangaroo
     * @since 2023.07.08
     * @param array $aFormData
     * @return array
     */
    public function editKangaroo(array $aFormData) : array
    {
        $aFormData['updated_at'] = now();
        $iId = $aFormData['id'];
        unset($aFormData['id']);
        $mResponseData = $this->oKangarooTrackerModel->editKangaroo($iId, $aFormData);
        if ($mResponseData !== '1' || (bool)$mResponseData === false) {
            return [
                'code' => 500,
                'data' => [
                    'message' => 'The data could not be updated. Please try again.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => (bool)$mResponseData
        ];
    }
}
