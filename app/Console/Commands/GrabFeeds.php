<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\FeedHelper;
use Illuminate\Support\Arr;

class GrabFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedreader:grab_feed 
                            {url : Feed urls (separated by comma)}
                            {--log= : File name to write log}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab items from given urls (separated by comma). Duplicate items are accepted.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->options();
        $url = $this->argument('url');
        $logFile = Arr::get($options, 'log', '');

        $urls = [];
        if (strpos($url, ',')) {
            $urls = explode(',', $url);
        } else {
            $urls[] = $url;
        }

        $start = microtime(true);
        $result = FeedHelper::grabFeeds($urls);
        $end = microtime(true);

        $time = round(($end - $start), 2);

        $log = "Grabbing Feed on " . date('Y-m-D H:i:s') . "\n";
        if (count($result)) {
            $log .= "There has the flowing error when grabbing feed" . count($urls) . ' in ' . $time . 'seconds';
            $log .= "\n" .  print_r($result, true);
        } else {
            $log .= "Successfully grab " . count($urls) . ' url(s) in '  . $time . ' second(s)';
        }

        if ($logFile) {
            $log .= "\n\n";
            $this->loging($log, $logFile);
        }

        echo "\n";
        echo $log;
        echo "\n";
    }

    private function loging($content, $file) {
        $dir = storage_path() . '/grabfeeds/';
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $file = $dir .$file;

        echo $file;
        $fp = fopen($file, 'a');
        fwrite($fp, $content);
        fclose($fp);
    }
}
