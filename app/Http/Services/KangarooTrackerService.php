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
    private KangarooTrackerModel $oKangarooTrackerModel;

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
        $aResponseData = $this->oKangarooTrackerModel->getKangaroo();
        if (empty($aResponseData) === true) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'No data found'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => $aResponseData
        ];
    }

    /**
     * checkIfNameExists
     * @since 2023.07.07
     * @param array $aParams
     * @return array
     */
    public function checkIfNameExists(array $aParams) : array
    {
        return [
            'code' => 200,
            'data' => [
                'bIsExist' => (bool)$this->oKangarooTrackerModel->checkIfNameExists($aParams)
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
        $bResponseData = $this->oKangarooTrackerModel->addKangaroo($aFormData);
        if ($bResponseData === false) {
            return [
                'code' => 500,
                'data' => [
                    'message' => 'The new data could not be registered. Please try again.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => $bResponseData
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
        return [
            'code' => 200,
            'data' => $this->oKangarooTrackerModel->getKangarooById($iId)
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
        $bResponse = $this->oKangarooTrackerModel->editKangaroo($iId, $aFormData);
        if ($bResponse === false) {
            return [
                'code' => 500,
                'data' => [
                    'message' => 'The data could not be updated. Please try again.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => $bResponse
        ];
    }
}
