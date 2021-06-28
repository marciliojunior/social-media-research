<?php

namespace App\Http\Controllers;

use App\Models\ListName;
use App\Models\Post;
use App\Models\SocialNetwork;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        $this->runMigration();

        $lists = ListName::all();
        $social_networks = SocialNetwork::all();
        return view('main', ['javascript_vars' => ['listNames' => $lists, 'social_networks' => $social_networks]]);
    }

    /**
     * Seed database with information
     * @param Request $request
     * @return JsonResponse
     */
    public function seedDataBase(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'numberOfPersons' => 'required|numeric|min:0|not_in:0',
            'maximumAccounts' => 'required|numeric|min:0|not_in:0',
            'maximumPosts' => 'required|numeric|min:0|not_in:0',
            'numberOfLists' => 'required|numeric|min:0|not_in:0'
        ]);
        if($validator->fails())
            return response()->json(['success' => false, 'message' => implode("<br/>", $validator->messages()->all())]);

        $oper = \Artisan::call('seed:database', [
            'persons' => $request->input('numberOfPersons'),
            'lists' => $request->input('numberOfLists'),
            'accounts' => $request->input('maximumAccounts'),
            'maxposts' => $request->input('maximumPosts')
        ]);

        return response()->json(['success' => !is_null($oper), 'message' => $oper]);
    }

    /**
     * Filter post data and return records
     * @param Request $request
     * @return JsonResponse
     */
    public function getPosts(Request $request): JsonResponse
    {
        $page = $request->input('page', 0);
        $limit = $request->input('limit', 100);

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });


        $query = Post::with('account')
            ->with('account.person.lists')
            ->with('account.social_network')
        ;

        //Applying filters
        try {
            self::filterByList($request, $query);
            self::filterBySocialNetWork($request, $query);
            self::filterByDateRange($request, $query);
            self::filterByTextSearch($request, $query);
            self::filterByGender($request, $query);
            self::filterByCityState($request, $query);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        $data = $query->paginate($limit);

        return response()->json($data);
    }

    //----

    /**
     * Filter by list name
     * @param Request $request
     * @param Builder $query
     */
    private static function filterByList(Request $request, Builder $query)
    {
        if ($request->input('list')) {
            $list = $request->input('list');
            $query->whereHas('account.person.lists', function(Builder $query) use($list) {
                return $query->whereIn('id', $list);
            });
        }
    }

    /**
     * Filter by social network
     * @param Request $request
     * @param Builder $query
     */
    private static function filterBySocialNetWork(Request $request, Builder $query)
    {
        if ($request->input('social_network')) {
            $sn = $request->input('social_network');
            $query->whereHas('account.social_network', function(Builder $query) use($sn) {
                return $query->whereIn('id', $sn);
            });
        }
    }

    /**
     * Filter by date range
     * @param Request $request
     * @param Builder $query
     * @throws Exception
     */
    private static function filterByDateRange(Request $request, Builder $query)
    {
        if ($request->input('dateIni') || $request->input('dateEnd')) {
            try {
                $dateIni = $request->input('dateIni');
                $dateIni = !empty($dateIni) ? Carbon::createFromFormat('Y-m-d', $dateIni) : null;
            } catch (Exception $e) {
                throw new Exception('Invalid intial date. Expected format YYYY-MM-DD');
            }
            try {
                $dateEnd = $request->input('dateEnd');
                $dateEnd = !empty($dateEnd) ? Carbon::createFromFormat('Y-m-d', $dateEnd) : null;
            } catch (Exception $e) {
                throw new Exception('Invalid end date. Expected format YYYY-MM-DD');
            }

            if ($dateIni && !$dateEnd)
                $query->whereDate('post_date', '>=', $dateIni);
            elseif (!$dateIni && $dateEnd)
                $query->whereDate('post_date', '<=', $dateEnd);
            elseif ($dateIni && $dateEnd)
                $query->whereBetween('post_date', [$dateIni, $dateEnd]);
        }
    }

    /**
     * Filter by full text search on post
     * @param Request $request
     * @param Builder $query
     */
    private static function filterByTextSearch(Request $request, Builder $query)
    {
        if ($request->has('fullTextSearch')) {
            $keys = $request->input('fullTextSearch');
            $keyWords = explode(',', $keys);
            foreach ($keyWords as $k) {
                $k = trim($k);
                $query->where('content', 'like', "%$k%");
            }
        }
    }

    /**
     * Filter by gender
     * @param Request $request
     * @param Builder $query
     */
    private static function filterByGender(Request $request, Builder $query)
    {
        if($request->input('gender')) {
            $gender = $request->input('gender');
            $query->whereHas('account.person', function(Builder $query) use($gender) {
                return $query->where('gender', strtoupper($gender));
            });
        }
    }

    /**
     * Filter by city and or state
     * @param Request $request
     * @param Builder $query
     */
    private static function filterByCityState(Request $request, Builder $query)
    {
        if($request->input('cityState')) {
            $keys = $request->input('cityState');
            $keyWords = explode(',', $keys);
            $query->whereHas('account.person', function(Builder $query) use($keyWords) {
                return $query->where(function(Builder $builder) use($keyWords) {
                    foreach ($keyWords as $key) {
                        $builder->orWhere('city', 'like', "%$key%");
                        $builder->orWhere('state', 'like', "%$key%");
                    }
                });
            });
        }
    }

    //---

    public function navigateToSocialNetworkPost(Post $post)
    {
        return view('post', compact('post'));
    }

    public function socialNetworkPostContent(Post $post)
    {
        return view('post-content', compact('post'));
    }

    private function runMigration()
    {
        if(!\Schema::hasTable('lists'))
            \Artisan::call('migrate:fresh');
    }
}
