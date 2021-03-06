<?php
namespace App\Http\Controllers\Api;

use App\Core\Services\NewsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;

/**
 * @author Sergei Melnikov <me@rnr.name>
 */
class NewsController extends Controller
{
    public function index(NewsService $newsService) {
        $news = $newsService->getAll();

        return response()->json($news);
    }

    public function store(NewsStoreRequest $request) {

    }
}