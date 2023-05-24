<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioCreateRequest;
use App\Http\Requests\Portfolio\PortfolioGetRequest;
use App\Http\Requests\Portfolio\PortfolioUpdateRequest;
use App\Http\Resources\Portfolio\PortfolioCollection;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Http\Response;

class PortfolioController extends Controller
{
    protected PortfolioService $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  PortfolioGetRequest  $request
     * @return PortfolioCollection
     */
    public function index(PortfolioGetRequest $request): PortfolioCollection
    {
        return new PortfolioCollection(
            Portfolio::orderBy('id', 'desc')
                ->paginate($request->validated()['limit'] ?? 20)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PortfolioCreateRequest  $request
     * @return Response
     */
    public function store(PortfolioCreateRequest $request): Response
    {
        $this->portfolioService->create($request->validated());

        return response()->noContent();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PortfolioUpdateRequest  $request
     * @param  Portfolio  $portfolio
     * @return Response
     */
    public function update(PortfolioUpdateRequest $request, Portfolio $portfolio): Response
    {
        $this->portfolioService->update($portfolio, $request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Portfolio  $portfolio
     * @return Response
     */
    public function destroy(Portfolio $portfolio): Response
    {
        $this->portfolioService->destroy($portfolio);

        return response()->noContent();
    }
}
