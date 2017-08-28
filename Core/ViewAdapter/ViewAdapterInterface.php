<?php
namespace PageViewer\Core\ViewAdapter;


interface ViewAdapterInterface
{
    public function render(string $viewName, array $params = []): string;
}