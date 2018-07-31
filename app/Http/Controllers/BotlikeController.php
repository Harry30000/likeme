<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBotlikeRequest;
use App\Http\Requests\UpdateBotlikeRequest;
use App\Repositories\BotlikeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Storage;
use App\Token;
use Illuminate\Support\Facades\DB;
use App\Log;

class BotlikeController extends AppBaseController
{
    /** @var  BotlikeRepository */
    private $botlikeRepository;

    public function __construct(BotlikeRepository $botlikeRepo)
    {
        $this->botlikeRepository = $botlikeRepo;
    }

    /**
     * Display a listing of the Botlike.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->botlikeRepository->pushCriteria(new RequestCriteria($request));
        $botlikes = $this->botlikeRepository->all();

        return view('botlikes.index')
            ->with('botlikes', $botlikes);
    }

    /**
     * Show the form for creating a new Botlike.
     *
     * @return Response
     */
    public function create()
    {
        return view('botlikes.create');
    }

    /**
     * Store a newly created Botlike in storage.
     *
     * @param CreateBotlikeRequest $request
     *
     * @return Response
     */
    public function store(CreateBotlikeRequest $request)
    {
        $input = $request->all();

        $botlike = $this->botlikeRepository->create($input);

        Flash::success('Botlike saved successfully.');

        return redirect(route('botlikes.index'));
    }

    /**
     * Display the specified Botlike.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $botlike = $this->botlikeRepository->findWithoutFail($id);

        if (empty($botlike)) {
            Flash::error('Botlike not found');

            return redirect(route('botlikes.index'));
        }

        return view('botlikes.show')->with('botlike', $botlike);
    }

    /**
     * Show the form for editing the specified Botlike.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $botlike = $this->botlikeRepository->findWithoutFail($id);

        if (empty($botlike)) {
            Flash::error('Botlike not found');

            return redirect(route('botlikes.index'));
        }

        return view('botlikes.edit')->with('botlike', $botlike);
    }

    /**
     * Update the specified Botlike in storage.
     *
     * @param  int $id
     * @param UpdateBotlikeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBotlikeRequest $request)
    {
        $botlike = $this->botlikeRepository->findWithoutFail($id);

        if (empty($botlike)) {
            Flash::error('Botlike not found');

            return redirect(route('botlikes.index'));
        }

        $botlike = $this->botlikeRepository->update($request->all(), $id);

        Flash::success('Botlike updated successfully.');

        return redirect(route('botlikes.index'));
    }

    /**
     * Remove the specified Botlike from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $botlike = $this->botlikeRepository->findWithoutFail($id);

        if (empty($botlike)) {
            Flash::error('Botlike not found');

            return redirect(route('botlikes.index'));
        }

        $this->botlikeRepository->delete($id);

        Flash::success('Botlike deleted successfully.');

        return redirect(route('botlikes.index'));
    }

    /**
     * @param $url
     * @return mixed
     */
    public function curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    /**
     * @param $url
     * @param $postfields
     * @return mixed
     */
    public function curl_post($url, $postfields)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    /**
     * Function Tăng Like Tự động
     */
    public function action()
    {
        /**
         * Khai báo biến cơ sở
         */
        $time = -microtime(true); // Thời gian bắt đầu
        $access_token = "EAACW5Fg5N2IBANZCDMjkjM7i2q5ABu0zsXNsjVaAG9H27UEMRNyI0L9SwhNSeENgsbZBkFwmSMZCG3cqLV1yCu9xAyqq9LUVZBdOeNVeNIGJTGSR4VtZCkmWuUCdJmtivDnF8lvYsDpTFAtl9ZCIutRyRrMW17kF8Q4jtJiVpEKs2WTZBODAAsG5R7i6Os77a8ZD";

        /**
         * Kiểm tra cờ trước khi thực hiện botlike.flag
         */
        if (Storage::disk('local')->exists("botlike.flag")) {
            return "Thao Tác Bot Auto Like Trước Đó Vẫn Chưa Thực Hiện Xong. Vui Lòng Đợi";
        } else {
            /**
             * Đặt cờ botlike.flag
             */
            Storage::put("botlike.flag", '');
        }

        /**
         * Lấy Facebook User Id
         */
        $raw = DB::table('botlikes')->select('facebook_id')->get();
        $arr = json_decode($raw, true); // Chuyển về dạng mảng để array_rand đọc được
        $random_keys = array_rand($arr, 1); // Lấy ngẫu nhiên một khóa trong mảng $arr kết quả trả về có dạng 0, 1, 2, 3
        $uid = $raw[$random_keys]->facebook_id; // Lấy giá trị của phần tử con trong mảng

        /**
         * Lấy 10 Facebook Post Id
         */
        $result = json_decode(
            $this->curl_get(
                'https://graph.facebook.com/v1.0/'.$uid.'/posts?fields=id&limit=10&access_token='.$access_token
            ),
            true
        );

        /**
         * Hàm chính
         */
        foreach ($result['data'] as $ids) {
            //$id = $result['data'][$i]['id'];
            $id = $ids['id'];

            /**
             * Kiểm tra Facebook Id
             */
            $result = json_decode(
                $this->curl_get('https://graph.facebook.com/v1.0/'.$id.'?fields=from%2Cid&access_token='.$access_token),
                true
            );

            if (is_array($result) && array_key_exists('error', $result)) {
                echo 'ID: '.$id.' không tồn tại hoặc không được hỗ trợ'."<br>";
                continue;
            }
            /**
             * Lấy số like cần tăng cho post của UID trong Database
             */
            $raw = DB::table('botlikes')
                ->select('like', 'user_id')
                ->where('facebook_id', '=', $uid)
                ->get();
            $limit = $raw[0]->like;
            $user_id = $raw[0]->user_id;

            /*
            * Kiểm tra Post Id có trong database chưa
            * Nếu có rồi thì bỏ qua
            */
            if (Log::where([['user_id', $user_id], ['object_id', $id],])->exists()) {
                echo 'Đã tăng like cho ID '.$id.' trước đó'."<br>";
                continue;
            }

            /**
             * Tăng Like
             */
            $count = 0; // Khởi tạo bộ đếm like thành công

            // Lấy random hàng access_token trong bảng tokens với app_id
            $results = Token::where('app_id', '165907476854626')->select('access_token')->inRandomOrder()->take(
                $limit
            )->get();

            foreach ($results as $result) {
                $access_token = $result['access_token'];
                $postFields = array('access_token' => $access_token);

                $arr = $this->curl_post('https://graph.facebook.com/'.$id.'/likes', $postFields);

                if ($arr == "true") {
                    $count++;
                }
            }

            /**
             * Ghi log vào Database
             */
            $log = new Log;
            $log->user_id = $user_id;
            $log->object_id = $id;
            $log->botlike = $count;

            $log->save();

            /**
             * Thông báo
             */
            echo 'Tăng thành công '.$count.' Like cho ID '.$id."<br>";
        }// Kết thúc vòng lặp

        /**
         * Kết thúc
         */
        $time += microtime(true); // Thời gian kết thúc

        /**
         * Xóa cờ
         */
        try {
            Storage::delete("botlike.flag");
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "<br>";
        }

        return "Execution time: ".number_format($time, 1, '.', ',').'s'."<br>";
    }
}
