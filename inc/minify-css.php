<?php
class Minify_CSS {
    public static function minify($css) {
        $css = preg_replace('/\s+/', ' ', $css);
        $css = preg_replace('/\/\*.*?\*\//', '', $css);
        $css = preg_replace('/\s*;\s*/', ';', $css);
        $css = preg_replace('/\s*:\s*/', ':', $css);
        $css = preg_replace('/\s*{\s*/', '{', $css);
        $css = preg_replace('/\s*}\s*/', '}', $css);
        $css = trim($css);
        return $css;
    }
}
