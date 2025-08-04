<?php

namespace App\Traits;

// API Resource
use App\Http\Resources\Response as JsonResponse;
use App\Platform;
// Laravel
use Monolog\Logger as Log;
use Monolog\Handler\StreamHandler;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Package
use Intervention\Image\Facades\Image;

trait ApiHelpers
{

    /**
     * ==============================================================================
     * Private Function
     * ==============================================================================
     */

    private function __isProduction()
    {
        return config('app.env') == "production";
    }

    private function __isDebug()
    {
        return config('app.debug') && !$this->__isProduction();
    }

    private function __api(array $debug = null, bool $status, $message, int $code = 0, $data = null): array
    {
        $response = [
            "status" => $status,
            "message" => $message,
            "code" => $code,
            "data" => $data
        ];

        if ($this->__isDebug()) {
            $response['debug'] = $debug;
        }

        return $response;
    }

    private function __ajaxDatatable($data, int $total, int $draw = 1, $filteredTotal = null)
    {
        $response = [
            "draw" => $draw,
            "recordsTotal" => $total,
            "recordsFiltered" =>  $filteredTotal !== null && is_int($filteredTotal) ? $filteredTotal : $total,
            "data" => $data
        ];

        return $response;
    }

    private function __log($type = "__normalLog")
    {

        $date = $this->__currentTime('Y-m-d');

        $log = null;

        switch ($type) {
            case '__transactionLog':
                $log = new Log($type, [
                    new StreamHandler(storage_path("logs/transactions/transaction-$date.log"), Log::INFO)
                ]);
                break;
            case '__errorLog':
                $log = new Log($type, [
                    new StreamHandler(storage_path("logs/errors/error-$date.log"), Log::ERROR)
                ]);
                break;
            default:
                $log = new Log($type, [
                    new StreamHandler(storage_path("logs/laravel-$date.log"), Log::INFO)
                ]);
                break;
        }

        return $log;
    }

    private function __directoryExist($directory, $target)
    {
        $all = Storage::allDirectories($directory);
        return in_array($target, $all);
    }

    /**
     * ==============================================================================
     * End Of Private Function
     * ==============================================================================
     */

    /**
     * ==============================================================================
     * Public Function
     * ==============================================================================
     */

    function __currentDomain($prefix = "//")
    {
        return $prefix . request()->getHost();
    }

    function __getUserGuard()
    {
        $guard = config('auth.defaults.api_guard');

        $guards = array_keys(config('auth.guards')) ?? [];

        foreach ($guards as $name) {
            if (Auth::guard($name)->check()) {
                $guard = $name;
                break;
            }
        }

        return $guard;
    }

    function __currentUser($guard = null)
    {
        $guard = $guard ?: $this->__getUserGuard();
        return Auth::guard($guard)->user();
    }

    function __checkPassword($password, $guard = null)
    {
        return Hash::check($password, $this->__currentUser($guard)->password ?? null);
    }

    function __requestFilled($name, $default = null)
    {
        $request = request();

        return $request->filled($name) ? $request->get($name) : $default;
    }

    function __validationFail($validator, array $debug = null)
    {
        $messages = $validator;
        if (is_a($validator, Validator::class)) {
            $debug = $validator->getMessageBag()->toArray();
            $messages = $debug[array_keys($debug)[0]][0] ?? $debug;
        }
        return new JsonResponse($this->__api($debug, false, $messages, 0));
    }

    function __getFormattedAttributes(array $rules)
    {
        return array_combine(array_keys($rules), array_map('ucwords', str_replace('.*.', '\'s ', str_replace('_', ' ', array_keys($rules)))));
    }

    function __getFormattedMessages(array $custom = null, bool $replace = false)
    {
        $attributes = [
            "required" => ":attribute is required.",
            "exists" => ":attribute is invalid.",
            "required_with" => ":attribute is required when :values is not empty.",
            "max" => ":attribute field's maximum sizes or values is :max",
            "between" => ":attribute field's value is not between :min - :max.",
        ];

        if (!empty($custom)) {
            if ($replace) {
                $attributes = $custom;
            } else {
                $attributes = array_merge($attributes, $custom);
            }
        }

        return $attributes;
    }

    static function __generateUniqueSlug($name, $className)
    {
        $slug = mb_strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        $unique = false;
        $counter = 0;
        while (!$unique) {
            $checkSlug = $className::whereSlug($slug)->first();
            if (empty($checkSlug)) {
                $unique = true;
            } else {
                $slug = mb_strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-')) . "-" . $counter;
            }
            $counter++;
        }

        return $slug;
    }

    function __isApi($type = null)
    {
        $host = request()->getHost();
        return $type
            ? $host == config("app.{$type}_url")
            : ($host == config('app.api_url') || $host == config('app.driver_url'));
    }

    function __isWeb()
    {
        $host = request()->getHost();
        return $host == config('appurl') || $host == config('app.web_app_url');
    }

    function __isAdmin()
    {
        return request()->getHost() == config('app.admin_url');
    }

    function __isEndpoint()
    {
        return request()->getHost() == config('app.endpoint_url');
    }

    function __expectsJson()
    {
        return request()->expectsJson() || $this->__isApi() || $this->__isEndpoint() || request()->is('api/*');
    }

    function __apiSuccess($message, $data = null, int $code = 200, array $debug = null)
    {
        return new JsonResponse($this->__api($debug, true, $message, $code, $data));
    }

    function __apiFailed($message, $data = null, int $code = 200, array $debug = null)
    {
        return new JsonResponse($this->__api($debug, false, $message, $code, $data));
    }

    function __apiNotFound($message, $data = null, int $code = 404, $debug = null)
    {
        return $this->__apiFailed($message, $data, $code, $debug);
    }

    function __apiMethodNotAllowed($message, $data = null, int $code = 405, $debug = null)
    {
        return $this->__apiFailed($message, $data, $code, $debug);
    }

    function __apiNotAuth($message, $data = null, int $code = 401, $returnArray = true)
    {
        if ($returnArray) {
            return new HttpResponse(
                $this->__toStr($this->__api(null, false, $message, $code, $data)),
                $code,
                ["Content-Type" => "application/json"]
            );
        }
        return $this->__apiFailed($message, $data, $code, null);
    }

    function __apiDataTable($data, int $total, int $draw = 1, $filteredTotal = null)
    {
        return new JsonResponse($this->__ajaxDatatable($data, $total, $draw, $filteredTotal));
    }

    function __currentTime($format = null)
    {
        return !empty($format) ? Carbon::now()->format($format) : Carbon::now();
    }

    function __formatDateTime($date, $format = "Y-m-d h:i:s")
    {
        return Carbon::parse($date)->format($format);
    }

    function __toStr($data)
    {
        if (is_object($data) || is_array($data)) {
            $data = json_encode((array) $data, true);
        }
        return $data;
    }

    function __storeImage($file, $type)
    {
        try {
            $file_name = strtolower($type) . "_" . date("Ymdhis") . rand(11, 99);
            $file = Image::make($file);
            // $file->orientate();
            $extension = str_replace("image/", '', $file->mime());
            $directory = str_replace('storage', 'public', Media::PATH_TO_STORAGE);
            if (!$this->__directoryExist(storage_path(), $directory)) {
                Storage::makeDirectory($directory);
            }
            $file->save(public_path(Media::PATH_TO_STORAGE . $file_name . '.' . $extension));

            return $file;
        } catch (\Throwable $th) {
            return;
        }
    }

    function __moveFile($file, $type)
    {
        try {
            $name = $file->getClientOriginalName();

            $file_name = mb_strtolower(pathinfo($name, PATHINFO_FILENAME)) . "_" . date("Ymdhis") . rand(11, 99);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $file->storeAs("public/$type", $file_name . '.' . $extension);

            return public_path("storage/$type/$file_name.$extension");
        } catch (\Throwable $th) {
            return;
        }
    }

    function __getFileOriginalName($file)
    {
        return $file->getClientOriginalName();
    }

    function __timeLeftInSeconds(Carbon $target, $readable = false)
    {
        // http://oldblog.codebyjeff.com/blog/2016/04/time-left-strings-with-carbon-and-laravel-string-helper
        $now = Carbon::now();

        if ($now->diffInSeconds($target) > 0) {
            return $readable ?
                $now->diffInSeconds($target) . Str::plural(' seconds', $now->diffInSeconds($target)) . ' left'
                : $now->diffInSeconds($target);
        }
    }

    function __isEmpty($value, $default = null)
    {

        if (is_array($value) && sizeof($value) > 0) {
            return $value;
        } else {
            return $default;
        }

        return empty($value) ? $default : $value;
    }


    /**
     * ==============================================================================
     * End Of Public Function
     * ==============================================================================
     */

    /**
     * ==============================================================================
     * Logging
     * ==============================================================================
     */

    function __transactionLog($message, $fileName = null, $fileLine = null)
    {
        $this->__log('__transactionLog')
            ->info($fileName . "($fileLine): " . $message);
    }

    function __transactionLogData($data, $fileName = null, $fileLine = null)
    {
        $this->__log('__transactionLog')
            ->alert($fileName . "($fileLine):", $data);
    }

    function __errorLog($data)
    {
        $this->__log('__errorLog')
            ->error(PHP_EOL . PHP_EOL  . $data);
    }

    function __normalLog($data)
    {
        $this->__log()
            ->info($data);
    }

    function __activityLog($user, $target_model, string $action)
    {
        activity()
            ->causedBy($user)
            ->performedOn($target_model)
            ->log($action);
    }

    /**
     * ==============================================================================
     * End Of Logging
     * ==============================================================================
     */


    function __sendFirebaseCloudMessagingToken($tokens, $type, $title, $text, $type_id = null, bool $silence = false, $sound = null)
    {
        if (is_array($tokens)) {
            $tokens = array_values(array_filter(array_unique($tokens)));
            $this->__normalLog('Sending FCM Token: ' . implode(', ', $tokens));
        } else {
            $this->__normalLog('Sending FCM Token: ' . $tokens);
        }

        if (!config('others.fcm.enabled')) {
            return false;
        }

        /**
         * registration_ids: multiple token array
         * to: single token
         */
        $tokenName = is_array($tokens) ? 'registration_ids' : 'to';

        /**
         * For in apps handling
         */
        $extraNotificationData = [
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "message" => $text,
            "type" => $type,
            "type_id" => $type_id,
            'title' => $title,
            "silence" => (int)$silence
        ];

        $data = [
            "$tokenName" => $tokens,
            'data' => $extraNotificationData,
            'priority' => 'high',
            'badge' => 1,
            // 'content_available' => $silence // set 'true' if need silent IOS notification
        ];

        if (!$silence) { // For Android silent notification
            $data = array_merge($data, [
                'notification' => [
                    'title' => $title,
                    // 'text' => $text,
                    'body' => $text, // body used for iOS
                    'android_channel_id' => 'push_noti_roger_squad',
                    'sound' => $sound != null ? $sound : true,
                    'icon' => asset('favicon.png')
                ]
            ]);
        }

        $url = config('others.fcm.url');

        $headers = [
            'Authorization: key=' . config('others.fcm.secret'),
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        $this->__normalLog("FCM Token Sent.(" . (is_array($tokens) ? implode(', ', $tokens) : $tokens) . ")" . json_encode($result));

        return true;
    }

    function __throwException($type)
    {
        $className = null;
        switch ($type) {
            case 'login':
                $className = AuthenticationException::class;
                break;
            default:
                # code...
                break;
        }

        if (!empty($className)) {
            throw new $className;
        }
    }

    function __platformVersion()
    {
        $osType = request()->header('Os-Type'); // android, ios
        $platform = Platform::whereOs($osType)
            ->latest()
            ->first();

        return $platform;
    }

    /**
     * ==============================================================================
     * End Of Others
     * ==============================================================================
     */
}
