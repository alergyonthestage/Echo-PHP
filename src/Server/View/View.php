<?php

namespace CaveResistance\Echo\Server\View;

use CaveResistance\Echo\Server\Application\Configurations;

class View {

    private static string $viewHeadContentSelector = '/(?<=<view-head>)(.|\n)*?(?=<\/view-head>)/';
    private static string $viewHeadTagSelector = '/<view-head>(.|\n)*?<\/view-head>/';
    private static string $contentPlaceholderSelector = '/{{content}}/';
    private static string $beforeClosingHeadTagSelector = '/(?=<\/head>)/';

    private static string $layout = 'default';

    public static function render(string $view, array $data = [], string $layout = ''): string 
    {
        $viewHead = '';
        $viewContent = static::extractViewHead(static::renderView($view, $data), $viewHead);
        if(empty($layout)) {
            if(!static::hasLayout()){
                return $viewContent;
            } else {
                $viewLayout = static::renderLayout(static::getLayoutName());
            }
        } else {
            $viewLayout = static::renderLayout($layout);
        }
        return preg_replace(
        [
            static::$contentPlaceholderSelector,
            static::$beforeClosingHeadTagSelector
        ], 
        [
            $viewContent,
            $viewHead
        ], 
        $viewLayout);
    }

    public static function setLayout(string $layout) 
    {
        static::$layout = $layout;
    }

    private static function getLayoutName(): string 
    {
        return static::$layout;
    }

    private static function hasLayout(): bool 
    {
        return !empty(static::$layout);
    }

    private static function renderView(string $name, array $data): string 
    {
        $toPath = static::nameToPath($name);
        extract($data);
        ob_start();
        require(Configurations::get('view.views')."/$toPath.php");
        return ob_get_clean();
    }

    private static function renderLayout(string $name): string 
    {
        $toPath = static::nameToPath($name);
        ob_start();
        require(Configurations::get('view.layouts')."/$toPath.php");
        return ob_get_clean();
    }

    private static function extractViewHead($rawView, &$viewHead): string
    {
        $matches = [];
        preg_match_all(static::$viewHeadContentSelector, $rawView, $matches);
        if(!empty($matches[0])) {
            foreach($matches[0] as $headContent) {
                $viewHead = $viewHead.$headContent;
            }
            return preg_replace(static::$viewHeadTagSelector, '', $rawView);
        }
        return $rawView;
    }

    private static function nameToPath(string $name): string
    {
        return str_replace('.', '/', $name);
    }

}