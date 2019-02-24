<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$URL_BASE = '/tags';

$app->get("$URL_BASE", function (Request $request, Response $response, $args) {
		$tags = TagRepository::get_instance($this)->get_all();
		return $response->withJson($tags, 200)
				->withHeader('Content-type', 'application/json');
});

$app->get("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$tag = TagRepository::get_instance($this)->get_by_id($id);
	return $response->withJson($tag, 200)
				->withHeader('Content-type', 'application/json');
});

$app->post("$URL_BASE", function (Request $request, Response $response) {
	$tag = TagRepository::mount_data($request->getBody());
	$tag = TagRepository::get_instance($this)->persist($tag);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($tag));
});

$app->put("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$tag_update = TagRepository::mount_data($request->getBody());
	$tag = TagRepository::get_instance($this)->get_by_id($id);
	TagRepository::get_instance($this)->merger_to_update($tag, $tag_update);
	$tag = TagRepository::get_instance($this)->persist($tag);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($tag));
});

$app->delete("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$tag = TagRepository::get_instance($this)->get_by_id($id);
	$tag = TagRepository::get_instance($this)->remove($tag);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($tag));
});