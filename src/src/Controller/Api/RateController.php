<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Helper\RateCdrParser;
use App\Service\RateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api', name: 'api_')]
class RateController extends AbstractController
{
    #[Route('/rate', name: 'apply_rate_to_cdr', methods:['post'] )]
    public function index(Request $request, RateCdrParser $rateCdrParser, RateService $rateService): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try{
            // validate and sanitize input
            $rateCdrData = $rateCdrParser->parse($data);

            $result = $rateService->applyRate($rateCdrData->getRate(), $rateCdrData->getCdr());
        } catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            $status = 400;
        }


        return $this->json($result, $status ?? 200);
    }
}
