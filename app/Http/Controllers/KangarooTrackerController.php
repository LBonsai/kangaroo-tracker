<?php

namespace App\Http\Controllers;

use App\Http\Requests\KangarooTrackerFormRequest;
use App\Http\Services\KangarooTrackerService;
use App\Models\KangarooTrackerModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * KangarooTrackerController
 *
 * @package App\Http\Controllers
 * @author Lee Benedict Baniqued
 * @since 2023.07.06
 * @version 1.0
 */
class KangarooTrackerController extends Controller
{
    /**
     * @var KangarooTrackerService $oKangarooTrackerService
     */
    private KangarooTrackerService $oKangarooTrackerService;

    /**
     * KangarooTrackerController constructor.
     * @since 2023.07.06
     */
    public function __construct()
    {
        $this->oKangarooTrackerService = new KangarooTrackerService(new KangarooTrackerModel());
    }

    /**
     * getKangaroo
     * @since 2023.07.06
     * @return JsonResponse
     */
    public function getKangaroo() : JsonResponse
    {
        $aResponse = $this->oKangarooTrackerService->getKangaroo();
        return response()->json($aResponse['data'], $aResponse['code']);
    }

    /**
     * checkIfNameExists
     * @param Request $oRequest
     * @return JsonResponse
     * @since 2023.07.07
     */
    public function checkIfNameExists(Request $oRequest) : JsonResponse
    {
        $aResponse = $this->oKangarooTrackerService->checkIfNameExists($oRequest->all());
        return response()->json($aResponse['data'], $aResponse['code']);
    }

    /**
     * addKangaroo
     * @since 2023.07.07
     * @param KangarooTrackerFormRequest $oRequest
     * @return JsonResponse
     */
    public function addKangaroo(KangarooTrackerFormRequest $oRequest) : JsonResponse
    {
        $aResponse = $this->oKangarooTrackerService->addKangaroo($oRequest->validated());
        return response()->json($aResponse['data'], $aResponse['code']);
    }

    /**
     * getKangarooById
     * @since 2023.07.08
     * @param int $iId
     * @return JsonResponse
     */
    public function getKangarooById(int $iId)
    {
        $aResponse = $this->oKangarooTrackerService->getKangarooById($iId);
        return response()->json($aResponse['data'], $aResponse['code']);
    }

    /**
     * editKangaroo
     * @since 2023.07.08
     * @param KangarooTrackerFormRequest $oRequest
     * @return JsonResponse
     */
    public function editKangaroo(KangarooTrackerFormRequest $oRequest) : JsonResponse
    {
        $aResponse = $this->oKangarooTrackerService->editKangaroo($oRequest->validated());
        return response()->json($aResponse['data'], $aResponse['code']);
    }
}
