<?php

namespace App\Http\Controllers;

use App\Http\Services\KangarooTrackerService;
use App\Models\KangarooTrackerModel;
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
    private $oKangarooTrackerService;

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
}
