<?php

namespace App\Helpers;

class HtmlSanitizer
{
    public static function sanitize(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        $html = self::stripScriptTags($html);
        $html = self::stripEventHandlers($html);
        $html = self::stripDangerousTags($html);
        $html = self::stripJavascriptUrls($html);

        return $html;
    }

    private static function stripScriptTags(string $html): string
    {
        return preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);
    }

    private static function stripEventHandlers(string $html): string
    {
        return preg_replace('/\bon\w+\s*=\s*["\'][^"\']*["\']/i', '', $html);
    }

    private static function stripDangerousTags(string $html): string
    {
        $dangerousTags = ['iframe', 'object', 'embed', 'form', 'input', 'textarea', 'select', 'button', 'style', 'link', 'meta', 'base'];

        foreach ($dangerousTags as $tag) {
            $html = preg_replace('/<' . $tag . '\b[^>]*>.*?<\/' . $tag . '>/is', '', $html);
            $html = preg_replace('/<' . $tag . '\b[^>]*\/?>/i', '', $html);
        }

        return $html;
    }

    private static function stripJavascriptUrls(string $html): string
    {
        return preg_replace('/(href|src|action)\s*=\s*["\']\s*javascript:/i', '$1="#"', $html);
    }
}
