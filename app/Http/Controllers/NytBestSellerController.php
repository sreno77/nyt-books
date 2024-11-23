<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookSearchRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class NytBestSellerController extends Controller
{
    public function __invoke(BookSearchRequest $request)
    {
        $bookResponse = Http::get(
            Config::get('nytbooksearch.endpoint'),
            array_merge(
                ['api-key' => Config::get('nytbooksearch.apikey')],
                //['api-key' => 'abc123'],
                $request->safe()->only('author', 'isbn', 'title', 'offset'),
            )
        );

        if($bookResponse->status() !== 200) {
            return response()->json(
                $bookResponse->getReasonPhrase(),
                $bookResponse->status()
            );
        }

        return response()->json(
            $bookResponse->collect('results'),
            200
        );
    }
}
