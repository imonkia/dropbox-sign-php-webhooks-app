<?php

namespace App\Controller;

use Dropbox\Sign\EventCallbackHelper;
use Dropbox\Sign\Model\EventCallbackRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebhooksController extends AbstractController
{
	// Base route
	#[Route('/', name: 'webhooks')]
	public function main(): Response
	{
		return new Response(
			'<html><body><h1>Dropbox Sign PHP Webhook Server Example</h1></body></html>'
		);
	}

	// Route that handles incoming webhook requests from Dropbox Sign
	#[Route('/drobpoxSignWebhooks', name: 'signature_request_events', methods: ['POST'])]
	public function index(Request $request): Response
	{
		// Get the API key from the .env file
		$key = $this->getParameter('dsign_api_key');
		
		// Get the event data from the request
		$callback_data = json_decode($_POST['json'] ?? [], true);
		
		// Parse the event and store it in a variable
		$callback_event = EventCallbackRequest::init($callback_data);
		
		// Verify that callback came from HelloSign.com
		$eventHashIsValid = EventCallbackHelper::isValid($key, $callback_event);
		
		// Reject the request if the event hash is invalid
		if (!$eventHashIsValid) {
			return new Response('Event hash validation failed.',
			401
		);
		} else {
			// Send back a successful response
			return new Response(
				'Hello API Event Received',
				Response::HTTP_OK,
				['content-type' => 'text/plain']
			);
		}
	}
}