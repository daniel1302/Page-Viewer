<?php
namespace PageViewer\Resources;

use PageViewer\Core\Container\Container;
use PageViewer\Core\Container\ServiceRegistryInterface;
use PageViewer\Model\Page\Finder\DatabaseFinder;
use PageViewer\Model\Page\Finder\Finder;
use PageViewer\Repository\LinkRepository;
use PageViewer\Repository\PageRepository;

class ServiceRegistry implements ServiceRegistryInterface
{

    public function register(Container $container): void
    {
        Container::addDefinition('repository_page', function (Container $container) {
            return new PageRepository();
        });

        Container::addDefinition('repository_link', function (Container $container) {
            return new LinkRepository($container->get('repository_page'));
        });

        Container::addDefinition('page_finder_database', function (Container $container) {
            return new DatabaseFinder($container->get('repository_link'));
        });

        Container::addDefinition('page_finder', function (Container $container) {

            $finder = new Finder();
            $finder->addFinder($container->get('page_finder_database'));

            return $finder;
        });
    }
}