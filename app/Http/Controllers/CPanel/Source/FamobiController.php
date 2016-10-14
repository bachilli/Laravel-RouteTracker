<?php

namespace App\Http\Controllers\CPanel\Source;

use App\Models\Content;
use GuzzleHttp\Client as GuzzleClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class FamobiController extends Controller
{
    const FAMOBI_SOURCE_ID = 1;
    const FAMOBI_API_KEY = 'A-O3RFS';
    const FAMOBI_API_URL = 'http://api.famobi.com/feed';

    /**
     * ...
     *
     * @return Redirect
     */
    public function index()
    {
        // Envia as informações ao SVT
        $request = (new GuzzleClient)->get(self::FAMOBI_API_URL, [
            'query' => [
                'a' => self::FAMOBI_API_KEY
            ],
            'timeout' => 10
        ]);

        $feed = json_decode(
            $request->getBody()->getContents()
        );

        foreach ($feed->games as $game) {
            $key = md5($game->package_id);

            $content = Content::where('key', $key)
                ->where('source_id', self::FAMOBI_SOURCE_ID)
                ->where('type', 'GAME')->first();

            if (empty($content)) {
                Content::create([
                    'key' => $key,
                    'source_id' => self::FAMOBI_SOURCE_ID,
                    'name' => $game->name,
                    'type' => 'GAME',
                    'status' => 'PENDING',
                    'data' => [
                        'package_id' => $game->package_id,
                        'name' => $game->name,
                        'description' => $game->description,
                        'thumb' => $game->thumb,
                        'thumb_60' => $game->thumb_60,
                        'thumb_120' => $game->thumb_120,
                        'thumb_180' => $game->thumb_180,
                        'link' => $game->link,
                        'date' => $game->date,
                        'aspect_ratio' => $game->aspect_ratio,
                        'orientation' => $game->orientation,
                        'categories' => $game->categories
                    ]
                ]);
            }
        }

        foreach ($feed->categories as $category) {
            $key = md5($category);

            $content = Content::where('key', $key)
                ->where('source_id', self::FAMOBI_SOURCE_ID)
                ->where('type', 'CATEGORY')->first();

            if (empty($content)) {
                Content::create([
                    'key' => $key,
                    'source_id' => self::FAMOBI_SOURCE_ID,
                    'name' => $category,
                    'type' => 'CATEGORY',
                    'status' => 'PENDING',
                    'data' => [
                        'name' => $category
                    ]
                ]);
            }
        }

        return to('CPanel\ContentController@index');
    }
}