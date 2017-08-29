<?php
namespace PageViewer\Resources;

use PageViewer\Core\Config\Config;
use PageViewer\Core\Container\Container;
use PageViewer\Core\Container\ServiceRegistryInterface;
use PageViewer\Model\Page\Finder\DatabaseFinder;
use PageViewer\Model\Page\Finder\DirectoryFinder;
use PageViewer\Model\Page\Finder\Finder;
use PageViewer\Model\Page\Parser\EmailParser;
use PageViewer\Model\Page\Parser\FirstHeaderParser;
use PageViewer\Model\Page\Parser\HeadersParser;
use PageViewer\Model\Page\Parser\ParagraphParser;
use PageViewer\Model\Page\Parser\Parser;
use PageViewer\Model\Page\Parser\SmallerHeadersParser;
use PageViewer\Model\Page\Parser\UrlParser;
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

        Container::addDefinition('page_finder_directory', function (Container $container) {
            /** @var Config $config */
            $config = $container->get('config');
            return new DirectoryFinder($config->get('root_dir') . $config->get('page_dir'));
        });

        Container::addDefinition('page_finder', function (Container $container) {

            $finder = new Finder();
            $finder->addFinder($container->get('page_finder_database'));
            $finder->addFinder($container->get('page_finder_directory'));


            return $finder;
        });

        Container::addDefinition('page_parser', function(Container $container) {
            $parser = new Parser();
            $parser->addParser(new EmailParser());
            $parser->addParser(new UrlParser());
            $parser->addParser(new ParagraphParser());
            $parser->addParser(new HeadersParser());
//            $parser->addLineByLineParser(new FirstHeaderParser());

            return $parser;
        });
    }
}