<?php
  
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiRespons 
{
    use SystemLog;

    /**
     * Set type sent data
     *
     * @var string
     */
    protected static $type = "API";

    /**
     * Set api version
     *
     * @var string
     */
    protected static $version = "v1";

    /**
     * Set type sent data
     *
     * @var string
     */
    protected static $sanctum = null;

    /**
     * Set content type
     *
     * @var string
     */
    protected static $author = "Benjamin4k";

    /**
     * Set content type
     *
     * @var string
     */
    protected static $host = "https://localhost:8000";

    /**
     * Set content type
     *
     * @var string
     */
    protected static $contentType = "application/json";

    /**
     * Set response body
     *
     * @var object
     */
    protected static $formatter = [
        'status' => Response::HTTP_OK,
        'message' => null,
        'link' => null,
        'meta' => [
            'version' => null,
            'author' => null,
            'host' => null,
            'type' => null,
            'date' => null,
            'accept' => null,
            'content-type' => null
        ],
        'data' => [],
        'errors' => [],
        'metadata' => [
            'total_data' => 0
        ]
    ];

    /**
     * Instantiate a new trait instance.
     *
     * @return void
     */
    public function __construct()
    {
        static::$host = config()->get('app.url');
        static::$sanctum = (config()->get('sanctum.expiration') * 60);
        static::$author = config()->get('meta.author');
    }

    /**
     * Create response body
     *
     * @param string $message
     * @param array $data
     * @param int $code
     * @return array
     */
    protected function createResponse(string $message = null, array $data, int $code = 200)
    {
        try {
            static::$formatter['status'] = $code;
            static::$formatter['message'] = nullToEmptyString($message);
            static::$formatter['link'] = request()->url();

            static::$formatter['meta']['version'] = static::$version;
            static::$formatter['meta']['author'] = nullToEmptyString(static::$author);
            static::$formatter['meta']['host'] = nullToEmptyString(static::$host);
            static::$formatter['meta']['type'] = static::$type;
            static::$formatter['meta']['date'] = date('d-m-Y H:i:s');

            static::$formatter['meta']['accept'] = static::$contentType;
            static::$formatter['meta']['content-type'] = static::$contentType;

            if (isset($data['data'])) {
                static::$formatter['data'] = nullToEmptyString($data['data']);
            }

            if (isset($data['error'])) {
                static::$formatter['errors'] = nullToEmptyString($data['error']);
            }

            if (isset($data['token'])) {
                static::$formatter['token'] = nullToEmptyString($data['token']);
                static::$formatter['token_type'] = $data['token_type'] ?: 'Bearer';
                static::$formatter['expires_in'] = $data['expires_in'] ?: static::$sanctum;
            }

            static::$formatter['metadata']['total_data'] = $data['total_data'] ?: (isset($data['data']) ? (is_countable($data['data']) ? count($data['data']) : (($data['data'] == "") ? 0 : 1)) : 0);
            
            return response()->json(static::$formatter, $code);
        } catch (\Throwable $th) {
            $this->sendReportLog('error', 'API | ' . $th->getMessage());

            return response()->json([
                'status' => 500,
                'error' => $th->getMessage()
            ], 500);
        }
    }
}