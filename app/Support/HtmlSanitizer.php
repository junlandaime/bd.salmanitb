<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    /**
     * Allowed HTML tags and their permitted attributes.
     */
    private const ALLOWED_TAGS = [
        'a' => ['href', 'title', 'target', 'rel'],
        'p' => [],
        'br' => [],
        'ul' => [],
        'ol' => [],
        'li' => [],
        'strong' => [],
        'em' => [],
        'b' => [],
        'i' => [],
        'u' => [],
        'blockquote' => [],
        'h1' => [],
        'h2' => [],
        'h3' => [],
        'h4' => [],
        'h5' => [],
        'h6' => [],
        'span' => ['class'],
        'code' => [],
        'pre' => [],
        'img' => ['src', 'alt', 'title'],
    ];

    private const STRIP_TAGS_WHITELIST = '<a><p><br><ul><ol><li><strong><em><b><i><u><blockquote><h1><h2><h3><h4><h5><h6><span><code><pre><img>';

    /**
     * Sanitize rich-text/HTML input to remove unsafe tags and attributes.
     */
    public static function sanitize(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        $html = trim($html);

        if ($html === '') {
            return $html;
        }

        $stripped = strip_tags($html, self::STRIP_TAGS_WHITELIST);

        $document = new DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);

        $document->loadHTML('<?xml encoding="utf-8" ?>' . $stripped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);

        self::sanitizeNode($document);

        $sanitized = $document->saveHTML();

        return $sanitized === false ? '' : $sanitized;
    }

    private static function sanitizeNode(DOMNode $node): void
    {
        if ($node instanceof DOMElement) {
            $tagName = strtolower($node->tagName);

            if (!array_key_exists($tagName, self::ALLOWED_TAGS)) {
                self::removeNode($node);
                return;
            }

            $allowedAttributes = self::ALLOWED_TAGS[$tagName];

            if ($node->hasAttributes()) {
                $attributesToRemove = [];
                foreach ($node->attributes as $attribute) {
                    $name = strtolower($attribute->name);

                    if (str_starts_with($name, 'on')) {
                        $attributesToRemove[] = $name;
                        continue;
                    }

                    if (!in_array($name, $allowedAttributes, true)) {
                        $attributesToRemove[] = $name;
                        continue;
                    }

                    $value = $attribute->value;

                    if ($tagName === 'a' && $name === 'href' && self::isDisallowedUrl($value)) {
                        $attributesToRemove[] = $name;
                        continue;
                    }

                    if ($tagName === 'a' && $name === 'target' && !in_array($value, ['_blank', '_self', '_parent', '_top'], true)) {
                        $attributesToRemove[] = $name;
                        continue;
                    }

                    if ($tagName === 'img' && $name === 'src' && self::isDisallowedImageSrc($value)) {
                        $attributesToRemove[] = $name;
                    }
                }

                foreach ($attributesToRemove as $attributeName) {
                    $node->removeAttribute($attributeName);
                }

                if ($tagName === 'a' && $node->hasAttribute('target') && strtolower($node->getAttribute('target')) === '_blank') {
                    $rel = $node->getAttribute('rel');
                    $relValues = array_filter(array_map('trim', explode(' ', strtolower($rel))));
                    $relValues[] = 'noopener';
                    $relValues[] = 'noreferrer';
                    $node->setAttribute('rel', implode(' ', array_unique($relValues)));
                }
            }
        }

        if ($node->hasChildNodes()) {
            $children = [];
            foreach ($node->childNodes as $child) {
                $children[] = $child;
            }

            foreach ($children as $child) {
                self::sanitizeNode($child);
            }
        }
    }

    private static function removeNode(DOMNode $node): void
    {
        $parent = $node->parentNode;

        if (!$parent) {
            return;
        }

        if ($node->hasChildNodes()) {
            while ($node->firstChild) {
                $parent->insertBefore($node->firstChild, $node);
            }
        }

        $parent->removeChild($node);
    }

    private static function isDisallowedUrl(string $url): bool
    {
        $trimmed = trim($url);

        if ($trimmed === '') {
            return true;
        }

        $lower = strtolower($trimmed);
        if (str_starts_with($lower, 'javascript:') || str_starts_with($lower, 'data:')) {
            return true;
        }

        $parsed = parse_url($trimmed);

        if ($parsed === false) {
            return true;
        }

        if (!isset($parsed['scheme'])) {
            return false;
        }

        return !in_array(strtolower($parsed['scheme']), ['http', 'https', 'mailto', 'tel'], true);
    }

    private static function isDisallowedImageSrc(string $url): bool
    {
        $trimmed = trim($url);

        if ($trimmed === '') {
            return true;
        }

        $lower = strtolower($trimmed);
        if (str_starts_with($lower, 'javascript:') || str_starts_with($lower, 'data:')) {
            return true;
        }

        $parsed = parse_url($trimmed);

        if ($parsed === false) {
            return true;
        }

        if (!isset($parsed['scheme'])) {
            return false;
        }

        return !in_array(strtolower($parsed['scheme']), ['http', 'https'], true);
    }
}
