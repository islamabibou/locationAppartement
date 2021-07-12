<?php
    class URLBuilder {
        public static function urlconstruct(array $data, string $param, $value): string
        {
            return http_build_query(array_merge($data, [$param => $value]));
        }

        public static function addParams(array $data, array $params): string {
            return http_build_query(array_merge($data, $params));
        }
    }