<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use Doctrine\Common\Collections\ArrayCollection;

$URL_BASE = '/auth';

$app->post("$URL_BASE/login", function (Request $request, Response $response) {
	$data = json_decode($request->getBody());
	if( !isset($data->email) || !isset($data->password)) {
		return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(['sucess'=>false, 'msg'=>'need your access data']);
	}
	try {
		$user = UserRepository::get_instance()->check_user_pass($data->email, $data->password);
		if($user == null) {
			return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode(['sucess'=>false, 'msg'=>'usuário ou senha inválidos']));
		}
		$time = time ();
		$key = 'blogTest';
		$token = array (
			'iat' => $time,
			'exp' => $time + (60 * 5),
			'data' => ['username' => $user->getName()] 
		);
		$jwt = JWT::encode( $token, $key );
		return $response->withStatus(200)->withHeader('Content-Type', 'application/json')
				->write(json_encode(['sucess'=>true, 'token'=> $jwt]));
	} catch ( Exception $e ) {
		return $response->withStatus(501)->withHeader('Content-Type', 'application/json')
				->write(['msg'=>'erro inesperado']);
	}
});