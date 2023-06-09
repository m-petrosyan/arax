<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioCategoryCreateRequest;
use App\Http\Requests\Portfolio\PortfolioCategoryGetRequest;
use App\Http\Requests\Portfolio\PortfolioCategoryUpdateRequest;
use App\Http\Resources\Portfolio\PortfolioCategoryCollection;
use App\Http\Resources\Portfolio\PortfolioCategoryGroupCollection;
use App\Http\Resources\Portfolio\PortfolioCategoryResource;
use App\Models\PortfolioCategory;
use App\Repositories\PortfolioCategoryRepository;
use App\Services\PortfolioCategoryService;
use Illuminate\Http\Response;

class PortfolioCategoryController extends Controller
{
    protected PortfolioCategoryService $portfolioCategoryService;

    public function __construct(PortfolioCategoryService $portfolioCategoryService)
    {
        $this->portfolioCategoryService = $portfolioCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return PortfolioCategoryCollection
     */
    public function index(): PortfolioCategoryCollection
    {
        return new PortfolioCategoryCollection(PortfolioCategoryRepository::getAll());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  PortfolioCategoryGetRequest  $request
     * @return PortfolioCategoryGroupCollection
     */
    public function getByFilters(PortfolioCategoryGetRequest $request): PortfolioCategoryGroupCollection
    {
        return new PortfolioCategoryGroupCollection(
            PortfolioCategoryRepository::getByCategory($request->category)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PortfolioCategoryCreateRequest  $request
     * @return PortfolioCategoryResource
     */
    public function store(PortfolioCategoryCreateRequest $request): PortfolioCategoryResource
    {
        return new PortfolioCategoryResource($this->portfolioCategoryService->store($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PortfolioCategoryUpdateRequest  $request
     * @param  PortfolioCategory  $portfolioCategory
     * @return Response
     */
    public function update(PortfolioCategoryUpdateRequest $request, PortfolioCategory $portfolioCategory): Response
    {
        $this->portfolioCategoryService->update($portfolioCategory, $request->validated());

        return response()->noContent();
    }

    /**
     * @param  PortfolioCategory  $portfolioCategory
     * @return Response
     *
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioCategory $portfolioCategory): Response
    {
        $this->portfolioCategoryService->destroy($portfolioCategory);

        return response()->noContent();
    }
}
