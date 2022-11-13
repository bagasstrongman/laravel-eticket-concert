<?php
  
namespace App\Traits;

trait LogReader
{
    use SystemLog;

    /**
     * Read file content from laravel app log
     *
     * @param string $type
     * @param string $channel
     * @param date $date
     * @return array
     */
    protected function getFileContent($type, $channel = 'laravel', $date = null)
    {
        $logs = [];
        $content = null;
        $pattern = null;

        try {
            if ($type == 'daily') {
                if ($date) {
                    $content = file_get_contents(storage_path('logs/'.$channel.'-'.$date.'.log'));
                } else {
                    $content = file_get_contents(storage_path('logs/'.$channel.'-'.dateDmyToYmd(now()).'.log'));
                }
            } else {
                $content = file_get_contents(storage_path('logs/'.$channel.'.log'));
            }

            $pattern = "/^\[(?<date>.*)\]\s(?<env>\w+)\.(?<type>\w+):(?<message>.*)/m";

            preg_match_all($pattern, $content, $matches, PREG_SET_ORDER, 0);

            foreach ($matches as $match) {
                $logs[] = [
                    'timestamp' => $match['date'],
                    'env' => $match['env'],
                    'type' => $match['type'],
                    'date' => dateDmyToYmd(now()),
                    'message' => trim($match['message'])
                ];
            }
        } catch (\Throwable $th) {
            $this->sendReportLog('error', $th->getMessage());
        }
        
        return [
            'logs' => $logs
        ];
    }
}