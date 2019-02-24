<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$URL_BASE = '/posts';

$app->get("$URL_BASE", function (Request $request, Response $response, $args) {
		$posts = PostRepository::get_instance($this)->get_all();
		return $response->withJson($posts, 200)
				->withHeader('Content-type', 'application/json');
});

$app->get("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post = PostRepository::get_instance($this)->get_by_id($id);
	return $response->withJson($post, 200)
				->withHeader('Content-type', 'application/json');
});

$app->post("$URL_BASE", function (Request $request, Response $response) {
	$post = PostRepository::mount_data($request->getBody());
	$post = PostRepository::get_instance($this)->persist($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});

$app->put("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post_update = PostRepository::mount_data($request->getBody());
	$post = PostRepository::get_instance($this)->get_by_id($id);
	PostRepository::get_instance($this)->merger_to_update($post, $post_update);
	$post = PostRepository::get_instance($this)->persist($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});

$app->delete("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$post = PostRepository::get_instance($this)->get_by_id($id);
	$post = PostRepository::get_instance($this)->remove($post);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($post));
});