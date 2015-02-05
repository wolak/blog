<?php defined('SYSPATH') or die('No direct script access.');

class Debug extends Kohana_Debug {

	public static function dev_log($string, $full_trace = FALSE, $multiline = FALSE)
	{
		if (Kohana::$environment === Kohana::DEVELOPMENT)
		{
			self::log($string, $full_trace, $multiline);
		}
	}
	public static function log($string, $full_trace = FALSE, $multiline = FALSE)
	{
		$original = $string;
		$logfile = APPPATH.'../debug_log.txt';
		if (is_string($string))
		{
			$string = '(String) '.$string;
		}
		else
		{
			$string = strip_tags(Debug::vars($string));
		}
		$string = "\n$string";
		$string = str_replace("\n", "\n\t", $string);
		$trace = debug_backtrace( ~ DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS);
		file_put_contents($logfile, sprintf(
			"\n[%s] (%s:%d) {%d}%s\n",
			date('Y-m-d H:i:s'),
			Debug::path($trace[0]['file']),
			$trace[0]['line'],
			getmypid(),
			rtrim($string)
		), FILE_APPEND);

		if ($full_trace)
        {
            if (is_int($full_trace))
            {
                for ($i = 0; $i < $full_trace; ++$i)
                {
                    if ($i+1 >= count($trace))
                        break;
                    file_put_contents($logfile, print_r($trace[$i+1], TRUE), FILE_APPEND);
                }
            }
            else
            {
                file_put_contents($logfile, print_r($trace, TRUE), FILE_APPEND);
            }
        }

		return $original;
	}
}