<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Doctrine\Common\Collections\ArrayCollection;

$URL_BASE = '/posts';

$app->get("$URL_BASE", function (Request $request, Response $response, $args) {
		$posts = PostRepository::get_instance()->get_all();
		return $response->withJson($posts, 200)
				->withHeader('Content-type', 'application/json');
});

$app->get("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post = PostRepository::get_instance()->get_by_id($id);
	$tags = TagRepository::get_instance()->findByPost($post);
	$post->setTags(new ArrayCollection($tags));
	return $response->withJson($post, 200)
				->withHeader('Content-type', 'application/json');
});

$app->post("$URL_BASE", function (Request $request, Response $response) {
	$post = PostRepository::mount_data($request->getBody());
	$post = PostRepository::get_instance()->persist($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});

$app->put("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post_update = PostRepository::get_instance()::mount_data($request->getBody());
	$post = PostRepository::get_instance()->get_by_id($id);
	PostRepository::get_instance()->merger_to_update($post, $post_update);
	$post = PostRepository::get_instance()->persist($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});

$app->delete("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post = PostRepository::get_instance()->get_by_id($id);
	$post = PostRepository::get_instance()->remove($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});
