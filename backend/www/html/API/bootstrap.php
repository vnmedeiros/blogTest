<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationRegistry;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Slim\App;
use Slim\Container;

require '../../vendor/autoload.php';

AnnotationRegistry::registerAutoloadNamespace(
	'JMS\Serializer\Annotation', 
	__DIR__ . "../../vendor/jms/serializer/src");

$container = new Container(require '../../app/config/settings.php');
$container[EntityManager::class] = getEntityManager($container);

$app = new App($container);

$app->add ( new \Slim\Middleware\JwtAuthentication ( [
	"passthrough" => [
			"/login"
	],
	"path" => [
			"/authors" ,
			"/posts",
			"/tags",
			"/users"
	],
	"secret" => "blogTest",
	"rules" => [
		new \Slim\Middleware\JwtAuthentication\RequestMethodRule([
				"passthrough" => ["GET"]
		])
	]
] ) );

BaseRepository::get_instance()->setEntityManager($container[EntityManager::class]);
$dir = '../../app/routes';
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)) as $file) {
    require $file;
}
$app->run();


function getEntityManager(Container $container): EntityManager {
    $config = Setup::createAnnotationMetadataConfiguration(
        $container['settings']['doctrine']['metadata_dirs'],
        $container['settings']['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new AnnotationDriver(
            new AnnotationReader,
            $container['settings']['doctrine']['metadata_dirs']
        )
    );

    $config->setMetadataCacheImpl(
        new FilesystemCache(
            $container['settings']['doctrine']['cache_dir']
        )
    );

    return EntityManager::create(
        $container['settings']['doctrine']['connection'],
        $config
    );
};

?>


