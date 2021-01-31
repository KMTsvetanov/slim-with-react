<?php

namespace App\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Requests\CustomRequestHandler;
use App\Validation\PostValidation;
use DI\DependencyException;
use DI\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use App\Response\CustomResponse;

class PostController
{
    /**
     * @var Post
     */
    private $post;
    /**
     * @var CustomResponse
     */
    private $customResponse;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var PostValidation
     */
    private $postValidation;


    /**
     * PostController constructor.
     * @param Post $post
     * @param CustomResponse $customResponse
     * @param PostRepository $postRepository
     * @param PostValidation $postValidation
     */
    public function __construct(
        Post $post,
        CustomResponse $customResponse,
        PostRepository $postRepository,
        PostValidation $postValidation
    )
    {
        $this->post = $post;
        $this->customResponse = $customResponse;
        $this->postRepository = $postRepository;
        $this->postValidation = $postValidation;
    }

    /**
     * Show all Posts
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ResponseInterface $response): ResponseInterface
    {
        $posts = $this->postRepository->all();

        return $this->customResponse->jsonResponse($response, 200, true, $posts);
    }

    /**
     * Create a Post
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function create(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            if (!$this->postValidation->create($request)) {
                return $this->customResponse->jsonResponse($response, 400, false, [], $this->postValidation->getErrors());
            }
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
            return $this->customResponse->jsonResponse($response, 400, false, [], 'Something Went Wrong!');
        }

        $this->postRepository->store([
            'title' => CustomRequestHandler::getParam($request, 'title'),
            'content' => CustomRequestHandler::getParam($request, 'content'),
            'image' => $this->postValidation->getFilename(),
        ]);

        return $this->customResponse->jsonResponse($response, 200, true, [], 'Post Created');
    }

    /**
     * Edit a Post
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $id
     * @return ResponseInterface
     */
    public function edit(RequestInterface $request, ResponseInterface $response, $id): ResponseInterface
    {
        try {
            if (!$this->postValidation->update($request)) {
                return $this->customResponse->jsonResponse($response, 400, false, [], $this->postValidation->getErrors());
            }
        } catch (DependencyException $e) {
        } catch (NotFoundException $e) {
            return $this->customResponse->jsonResponse($response, 400, false, [], 'Something Went Wrong!');
        }

        try {
            $this->postRepository->update($id, [
                'title' => CustomRequestHandler::getParam($request, 'title'),
                'content' => CustomRequestHandler::getParam($request, 'content'),
                'image' => $this->postValidation->getFilename(),
            ]);
        } catch (ModelNotFoundException $e) {
            return $this->customResponse->jsonResponse($response, 400, false, [], 'Something Went Wrong!');
        }

        return $this->customResponse->jsonResponse($response, 200, true, [], 'Post Updated');
    }

    /**
     * Show Post
     *
     * @param ResponseInterface $response
     * @param $id
     * @return ResponseInterface
     */
    public function show(ResponseInterface $response, $id): ResponseInterface
    {
        try {
            $post = $this->postRepository->findById($id);
        } catch (ModelNotFoundException $e) {
            return $this->customResponse->jsonResponse($response, 400, false, [], 'Something Went Wrong!');
        }

        return $this->customResponse->jsonResponse($response, 200, true, $post);
    }

    /**
     * Delete a Post
     *
     * @param ResponseInterface $response
     * @param $id
     * @return ResponseInterface
     */
    public function destroy(ResponseInterface $response, $id): ResponseInterface
    {
        try {
            $this->postRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->customResponse->jsonResponse($response, 400, false, [], 'Something Went Wrong!');
        }

        return $this->customResponse->jsonResponse($response, 200, true, [], 'Post Deleted');
    }
}