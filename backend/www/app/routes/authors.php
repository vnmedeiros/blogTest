<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$URL_BASE = '/authors';

$app->get("$URL_BASE", function (Request $request, Response $response, $args) {
		$authors = AuthorRepository::get_instance()->get_all();
		return $response->withJson($authors, 200)
				->withHeader('Content-type', 'application/json');
});

$app->get("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$author = AuthorRepository::get_instance()->get_by_id($id);
	return $response->withJson($author, 200)
				->withHeader('Content-type', 'application/json');
});

$app->post("$URL_BASE", function (Request $request, Response $response) {
	$author = AuthorRepository::mount_data($request->getBody());
	$author = AuthorRepository::get_instance()->persist($author);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($author));
});

$app->put("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$author_update = AuthorRepository::mount_data($request->getBody());
	$author = AuthorRepository::get_instance()->get_by_id($id);
	AuthorRepository::get_instance()->merger_to_update($author, $author_update);
	$author = AuthorRepository::get_instance()->persist($author);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($author));
});

$app->delete("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$author = AuthorRepository::get_instance()->get_by_id($id);
	$author = AuthorRepository::get_instance()->remove($author);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($author));
});