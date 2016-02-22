<?php
namespace App\Http\Controllers;
use App\Core\Services\NewsService;
use App\Http\Requests\NewsStoreRequest;

/**
 * @author Sergei Melnikov <me@rnr.name>
 */
class NewsController extends Controller
{
    public function index() {
        return view('news');
    }

    public function store(NewsStoreRequest $request, NewsService $newsService) {
        $newsService->store($request->all());
        return redirect('news');
    }
}