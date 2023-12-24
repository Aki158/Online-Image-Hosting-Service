<?php

namespace Helpers;

class ValidationHelper
{
    public static function integer($value, float $min = -INF, float $max = INF): int
    {
        $value = filter_var($value, FILTER_VALIDATE_INT, ["min_range" => (int) $min, "max_range"=>(int) $max]);

        // 結果がfalseの場合、フィルターは失敗
        if ($value === false) throw new \InvalidArgumentException("The provided value is not a valid integer.");

        // 値がすべてのチェックをパスしたら、そのまま返す
        return $value;
    }

    public static function string($value): string
    {
        if (!is_string($value)) throw new \InvalidArgumentException("The provided value is not a valid string.");
        return $value;
    }

    public static function path($path,$allowed_path): string
    {
        foreach($allowed_path as $prefix){
            if (substr($path, 0, strlen($prefix)) === $prefix) {
                return $prefix;
            }
        }
        return $path;
    }

    public static function urlType(string $path): string{
        $split_path = explode("/", $path);
        $end_path = end($split_path);
        $end_path_len = strlen($end_path);

        if($end_path_len === 32){
            return "post_url";
        }
        else if($end_path_len === 40){
            return "delete_url";
        }
        else{
            header("Location: ../notFoundImage");
            exit;
        }
    }
}