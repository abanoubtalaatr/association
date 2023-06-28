<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Library;
use Illuminate\Http\Request;
use App\Jobs\StoreItemStatistics;
use Crawler;

class LibraryController extends Controller
{
    public function show(Library $library, $user_utm = '')
    {
        if ($user_utm) {
            if (Crawler::isCrawler()) {
                info('crawler detected at ' . now());
            } else {
                dispatch(new StoreItemStatistics('library', $library->id, $user_utm));
            }
        }
        return view('front.library.show', compact('library'));
    }

    public function checkAdBlock()
    {
        return view('front.ads.checkAdBloker');
    }

    public function showAd(Ad $ad, $user_utm = '')
    {
        if ($ad->status == 'active') {
            if (Crawler::isCrawler()) {
                info('crawler detected at ' . now());
            } else {
                dispatch(new StoreItemStatistics('ad', $ad->id, $user_utm));
                if ($user_utm) {
                    User::where('utm', $user_utm)->limit(1)->update(['last_share' => 'library']);
                }
            }

            return view('front.ads.show', compact('ad'));
        }
        return view('front.ads.not_found');

    }

    public function increaseClicks(Ad $ad)
    {
        if ($ad) {
            if (is_null($ad->clicks)) {
                $ad->update(['clicks' => 1]);
            } else {
                $ad->clicks = $ad->clicks += 1;
                $ad->save();
            }
        }
        return response(['status' => 200]);
    }

}
