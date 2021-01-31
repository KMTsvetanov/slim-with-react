<?php

namespace App\Validation;

use DI\Container;
use Psr\Http\Message\RequestInterface;
use Respect\Validation\Validator as v;

/**
 * Class PostValidation
 * @package App\Validation
 */
class PostValidation
{
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var Container
     */
    private $container;

    private $filename = null;

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator, Container $container)
    {
        $this->validator = $validator;
        $this->container = $container;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function create(RequestInterface $request): bool
    {
        return $this->createUpdate($request);
    }

    /**
     * @param RequestInterface $request
     * @return bool
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function update(RequestInterface $request): bool
    {
        return $this->createUpdate($request);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function createUpdate(RequestInterface $request): bool
    {
        $this->validator->validate($request, [
            'title' => v::notEmpty()->length(1, 255),
            'content' => v::optional(v::length(1, 300))
        ]);

        if ($this->validator->failed()) {
            $this->setErrors($this->validator->errors);

            return false;
        }

        $uploadedFile = optional($request->getUploadedFiles())['image'];
        if (!is_null($uploadedFile)) {
            $validImage = v::size('1KB', '1MB')
                ->objectType()->attribute('file', v::oneOf(
                    v::mimetype('image/png'),
                    v::mimetype('image/jpeg')
                ))->validate($uploadedFile);

            if (!$validImage) {
                $this->setErrors([
                    'image' => [
                        'Image' => 'Image Validation Failed'
                    ]
                ]);
                return false;
            }
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $postImagesDir = $this->container->get('imagesDir') . '/posts';

                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                $basename = bin2hex(random_bytes(8));
                $filename = sprintf('%s.%0.8s', $basename, $extension);
                $this->setFilename($filename);

                $uploadedFile->moveTo($postImagesDir . DIRECTORY_SEPARATOR . $filename);
            }
        }

        return true;
    }
}