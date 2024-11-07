<?php
class Helper
{
    public static function get_url($url = '')
    {
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_SPECIAL_CHARS);
        $app_path = explode('/', $uri);
        return 'http://' . $_SERVER['HTTP_HOST'] . '/' . $app_path[1] . '/' . $url;
    }

    public static function redirect($url)
    {
        header("Location:{$url}");
        exit();
    }

    public static function redirect_js($url)
	{
		if ($url) {
			echo '<script>window.location.href="' . $url . '"</script>';
		}
    }

    public static function input_value($inputname, $filter = FILTER_DEFAULT, $option = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        $value = filter_input(INPUT_POST, $inputname, $filter, $option);
        if ($value === null) {
            $value = filter_input(INPUT_GET, $inputname, $filter, $option);
        }
        return $value;
    }

    public static function is_submit($hidden)
    {
        return (!empty(self::input_value('action')) && self::input_value('action') == $hidden);
    }

}
?>