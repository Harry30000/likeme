<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AutoLikeRequest;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\Price;
use App\Token;
use App\VipUser;
use Storage;

class AutoLikeController extends Controller
{
    public function curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

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

    public function index()
    {
        return view('layouts.auto-like');
    }

    public function AutoLike(AutoLikeRequest $request)
    {
        $time = -microtime(true); //thoi gian bat dau doan code can do
        $id = $request->fbid; // ID người dùng nhập
        $limit = $request->limit; // Giới hạn người dùng nhập

        /**
         * Kiểm tra cờ trước khi thực hiện
         */
        if (Storage::disk('local')->exists(Auth::user()->id . "-" . $id . "-like.txt")) {
            return response()->json(['success' => "Đang tăng Like cho ID: " . $id . ". Vui lòng đợi"]);
        }

        /*
        * Kiểm tra ID người dùng nhập có tồn tại
        */
        $access_token = "EAACW5Fg5N2IBANZCDMjkjM7i2q5ABu0zsXNsjVaAG9H27UEMRNyI0L9SwhNSeENgsbZBkFwmSMZCG3cqLV1yCu9xAyqq9LUVZBdOeNVeNIGJTGSR4VtZCkmWuUCdJmtivDnF8lvYsDpTFAtl9ZCIutRyRrMW17kF8Q4jtJiVpEKs2WTZBODAAsG5R7i6Os77a8ZD";
        $result = json_decode($this->curl_get('https://graph.facebook.com/v1.0/' . $id . '?fields=from%2Cid&access_token=' . $access_token), true);

        if (is_array($result) && array_key_exists('error', $result)) {
            return response()->json(['success' => "ID: " . $id . " không tồn tại hoặc không được hỗ trợ"]);
        }

        $from = $result['from']['id']; // UID người Post

        /**
         * Kiểm tra số Like sẵn có
         * Nếu yêu cầu lớn hơn sẵn có thì chặn lại
         */
        $prices_id = VipUser::where('user_id', Auth::user()->id)->select('prices_id')->first();
        $prices_id = $prices_id->prices_id;
        $like_available = VipUser::where('user_id', Auth::user()->id)->select('like_available')->first();
        $like_available = $like_available->like_available;
        if ($limit > $like_available) {
            return response()->json(['success' => "Số Like sẵn có của bạn không cho phép thực hiện điều này. Nếu muốn tăng Like nữa vui lòng gia hạn hoặc nâng cấp gói tăng Like"]);
        }

        /*
        * Kiểm tra ID có trong database chưa cùng số like đã tăng
        * Kiểm tra gói Like của User tính số like có thể thực hiện còn lại
        */
        if (Log::where([['user_id', Auth::user()->id], ['object_id', $id],])->exists()) {
            $update = true;
            $log_id = Log::where([['user_id', Auth::user()->id], ['object_id', $id],])->select('id')->first();
            $log = Log::where([['user_id', Auth::user()->id], ['object_id', $id],])->select('like')->first();
            if ($log->like != 0) {
                $prices_limit = Price::where('id', $prices_id)->select('like_limit')->first();
                if ($log->like >= $prices_limit->like_limit) {
                    return response()->json(['success' => "Bạn đã đạt đến giới hạn của của gói tăng Like hiện tại. Nếu muốn hơn nữa vui lòng nâng nấp"]);
                }
            } else {

            }
        } else {
            $update = false;
        }

        /**
         * Đặt cờ $id-like.txt
         */
        Storage::put(Auth::user()->id . "-" . $id . "-like.txt", '');

        /**
         * Tăng Like
         */
        $count = 0; // Khởi tạo bộ đếm like thành công

        // Lấy random hàng access_token trong bảng tokens với app_id
        $results = Token::where('app_id', '165907476854626')->select('access_token')->inRandomOrder()->take($limit)->get();

        foreach ($results as $result) {
            $access_token = $result['access_token'];
            $postFields = array('access_token' => $access_token);

            $arr = $this->curl_post('https://graph.facebook.com/' . $id . '/likes', $postFields);

            if ($arr == "true")
                $count++;
        }

        /**
         * Ghi log vào Database
         */
        if ($update == true) {
            Log::where('user_id', Auth::user()->id)
                ->where('object_id', $id)
                ->update(['like' => $log->like + $count]);
        } elseif ($update == false) {
            $log = new Log;
            $log->user_id = Auth::user()->id;

            $log->object_id = $from;
            $log->object_id .= "_";
            $log->object_id .= $id; // Nối string object_id có dạng 100002788355129_774703565965915

            $log->like = $count;

            $log->save();
        }

        /**
         * Cập nhật lại số like còn lại của người dùng
         */
        VipUser::where('user_id', Auth::user()->id)
            ->update(['like_available' => $like_available - $count]);

        /**
         * Xóa cờ
         */
        Storage::delete(Auth::user()->id . "-" . $id . "-like.txt");

        /**
         * Thông báo
         */
        $time += microtime(true); //thoi gian ket thuc
        return response()->json(['success' => "Tăng thành công " . $count . " Like cho ID " . $id . " Execution time: " . number_format($time, 0, '.', ',')]);
    }
}
