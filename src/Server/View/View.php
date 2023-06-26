<?php

namespace CaveResistance\Echo\Server\View;

use CaveResistance\Echo\Server\Application\Configurations;

class View {

    private static string $viewHeadContentSelector = '/(?<=<view-head>)(.|\n)*?(?=<\/view-head>)/';
    private static string $viewHeadTagSelector = '/<view-head>(.|\n)*?<\/view-head>/';
    private static string $contentPlaceholderSelector = '/{{content}}/';
    private static string $beforeClosingHeadTagSelector = '/(?=<\/head>)/';

    public static function render(string $view, array $data = [], string $layout = 'default'): string 
    {
        $viewLayout = static::getLayout($layout);
        $viewHead = '';
        $viewContent = static::extractViewHead(static::getView($view, $data), $viewHead);
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

    private static function getView(string $name, array $data): string 
    {
        $toPath = static::nameToPath($name);
        extract($data);
        ob_start();
        require(Configurations::get(VIEWS_PATH)."/$toPath.php");
        return ob_get_clean();
    }

    private static function getLayout(string $name): string 
    {
        $toPath = static::nameToPath($name);
        ob_start();
        require(Configurations::get(LAYOUTS_PATH)."/$toPath.php");
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