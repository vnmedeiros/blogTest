<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Doctrine\Common\Collections\ArrayCollection;

$URL_BASE = '/users';

$app->get("$URL_BASE", function (Request $request, Response $response, $args) {
		$users = UserRepository::get_instance()->get_all();
		return $response->withJson($users, 200)
				->withHeader('Content-type', 'application/json');
});

$app->get("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$user = UserRepository::get_instance()->get_by_id($id);
	return $response->withJson($user, 200)
				->withHeader('Content-type', 'application/json');
});

$app->post("$URL_BASE", function (Request $request, Response $response) {
	$user = UserRepository::mount_data($request->getBody());
	$user = UserRepository::get_instance()->persist($user);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($user));
});

$app->put("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$user_update = UserRepository::mount_data($request->getBody());
	$user = UserRepository::get_instance()->get_by_id($id);
	UserRepository::get_instance()->merger_to_update($user, $user_update);
	$user = UserRepository::get_instance()->persist($user);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($user));
});

$app->delete("$URL_BASE/{id}", function (Request $request, Response $response, $args) {
	$id = $args['id'];
	$user = UserRepository::get_instance()->get_by_id($id);
	$user = UserRepository::get_instance()->remove($user);
	return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode($user));
});