<?php

namespace App\Http\Controllers\API;

use App\Console\Commands\ScanNewsTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RssNewsModel;
use App\Models\RssModel;
use App\Helpers\Feed;
use Facade\FlareClient\Http\Response;

class ScanNewsController extends Controller
{
    protected $rssNewsModel;
    public function __construct(RssNewsModel $rssNewsModel)
    {
        $this->rssNewsModel = $rssNewsModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //read Rss data
        $rssModel   = new RssModel();
        $itemsRss   = $rssModel->listItems(null, ['task'   => 'news-list-items']);
        $rssReadData = Feed::read($itemsRss);
        // rss news table
        $rssList = $this->rssNewsModel->getAll();
        $compareData = $this->compare($rssList, $rssReadData);
        // insert rss data
        $listInsertRss = json_decode(json_encode($compareData["listInsert"]), true);
        $this->rssNewsModel::insert($listInsertRss);
        // delete
        $listDelete = array_map(function ($item) {
            return $item["link"];
        }, $compareData["listDelete"]);
        $rssModel::whereIn("link", $listDelete)->delete();
        // render result
        $dataResult = JsonResource::collection($compareData);
        return response()->json([
            'data' => true
        ], 200);
    }

    public function compare(array $rssDbs, array $rssApis)
    {
        foreach ($rssApis as $key => $value) {
            foreach ($rssDbs as $key1 => $value1) {
                if (trim($value["link"]) == trim($value1["link"])) {
                    unset($rssDbs[$key1]);
                    unset($rssApis[$key]);
                }
            }
        };
        return array(
            "listInsert" => $rssApis,
            "listDelete" => $rssDbs
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
