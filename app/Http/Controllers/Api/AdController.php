<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\LibraryProfit;
use App\Models\Setting;
use App\Services\AdsFilterService;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Models\StatsCitySoldier;
use App\Http\Resources\AdResource;
use App\Models\StatsCountrySoldier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\AdStatsResource;
use App\Http\Requests\UploadMediaRequest;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $error_message = '';
        $user = auth('api-users')->user();
        $relation = $user->ads();
        $settings = Setting::first();
        if ($user->user_type == 'soldier') {
//            $relation = AdsFilterService::getAdsQuery(auth('api-users')->id());
            $relation = Ad::whereStatus('active')
                ->where('start_date', '<=', now())
                ->where('remaining_budget', '>', 0)

            ;
//            $relation = $relation->whereStatus('active')
//                ->where('start_date', '<=', now())
//                ->where('remaining_budget', '>', 0)
//                ->whereIn('id', $firstThirdAds)
//                ->orWhereNotIn('id', $firstThirdAds);


        }

        if($error_message) {
            return response()->json([
                'error_message' => $error_message,
                'data' => [],
            ]);
        }

        $data = $relation
            ->when(request('title'), function ($query, $title) {
                return $query->where('title', 'LIKE', '%' . $title . '%');
            })->when(request('camp_id'), function ($query, $camp_id) {
                return $query->whereCampId($camp_id);
            })->when(request('status'), function ($query, $status) {
                return request('status') == 'only_active' ? $query->where('status', '!=', 'inactive') : $query->whereStatus($status);
            })->orderByDesc('id')
            ->paginate();

        return response()->json([
            'error_message' => $error_message,
            'data' => AdResource::collection($data)
        ]);
    }

    public function store(StoreAdRequest $request)
    {
        $input = $request->validated();
        $input['whatsapp_thumbnail'] = $request->whatsapp_thumbnail->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->whatsapp_thumbnail->extension(), 'public');

        $new_ad =
            auth('api-users')
                ->user()
                ->ads()
                ->create(Arr::except($input, ['ad_genders', 'ad_cities', 'ad_countries', 'ad_targeted_audiences', 'ad_ages', 'ad_languages']));


        $new_ad->genders()->sync($request->ad_genders);
        $new_ad->countries()->sync($request->ad_countries);
        $new_ad->cities()->sync($request->ad_cities);
        $new_ad->audiences()->sync($request->ad_targeted_audiences);
        $new_ad->ages()->sync($request->ad_ages);
        $new_ad->languages()->sync($request->ad_languages);

        return new AdResource($new_ad);
    }

    public function update(UpdateAdRequest $request, Ad $ad)
    {
        abort_unless($ad->user_id == auth('api-users')->id(), 401, __('site.not_allowed'));
        $input = $request->validated();
        $input['whatsapp_thumbnail'] =
            $request->has('whatsapp_thumbnail') ?
                $request->whatsapp_thumbnail
                    ->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->whatsapp_thumbnail->extension(), 'public') :
                $ad->whatsapp_thumbnail;


        $ad->update(Arr::except($input, ['ad_genders', 'ad_cities', 'ad_countries', 'ad_targeted_audiences', 'ad_ages', 'ad_languages']));


        $ad->genders()->sync($request->ad_genders);
        $ad->countries()->sync($request->ad_countries);
        $ad->cities()->sync($request->ad_cities);
        $ad->audiences()->sync($request->ad_targeted_audiences);
        $ad->ages()->sync($request->ad_ages);
        $ad->languages()->sync($request->ad_languages);

        return new AdResource($ad);
    }

    public function uploadMedia(UploadMediaRequest $request)
    {
        return response()->json([
            'media' => $request->media->storeAs(date('Y/m/d'), Str::random(50) . '.' . $request->media->extension(), 'public')
        ]);
    }


    public function show(Ad $ad)
    {
        abort_if($ad->status != 'active' && $ad->user_id != auth('api-users')->id(), 404, __('site.ad_doesnt_exist'));
        return new AdResource($ad);
    }

    public function stats(Ad $ad)
    {
        return [
            'ad' => new AdResource($ad),
            'page_title' => $ad->title_ar,
            'countries' => StatsService::getAdCountryStats($ad),
            'cities' => StatsService::getAdCityStats($ad),
            'ages' => StatsService::getAdAgeStats($ad),
            'audiences' => StatsService::getAdAudienceStats($ad),
            'genders' => StatsService::getAdGenderStats($ad),
        ];
    }

    public function toggleStatus(Request $request, Ad $ad)
    {
        abort_unless($ad->user_id == auth('api-users')->id(), 401, __('site.not_allowed'));

        $new_status = $ad->status == 'inactive' ? 'active' : 'inactive';
        $ad->update(['status' => $new_status]);
        return new AdResource($ad);
    }

    public function advertiserStats()
    {
        return [
            'country_stats' => StatsCountrySoldier::whereItemType('ad')->whereHas('ad', function ($query) {
                return $query->whereUserId(auth('api-users')->id());
            })->with('country')->get()->groupBy('country.value')->map(function ($element, $key) {
                return $element->sum('visitors_number');
            })->toArray(),

            'city_stats' => StatsCitySoldier::whereItemType('ad')->whereHas('ad', function ($query) {
                return $query->whereUserId(auth('api-users')->id());
            })->with('city')->get()->groupBy('city.value')->map(function ($element, $key) {
                return $element->sum('visitors_number');
            })->toArray(),

            'week_stats' => StatsService::getAdvertiserWeekStats(auth('api-users')->user()),
        ];
    }

}
