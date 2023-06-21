<?php

namespace CaveResistance\Echo\Server\View;

use CaveResistance\Echo\Server\Application\Configurations;

class View {

    public static function render(string $view, array $data = [], string $layout = 'default'): string 
    {
        $layoutView = static::getLayout($layout);
        $contentView = static::getView($view, $data);
        return str_replace('{{content}}', $contentView, $layoutView);
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

    private static function nameToPath(string $name): string
    {
        return str_replace('.', '/', $name);
    }

}