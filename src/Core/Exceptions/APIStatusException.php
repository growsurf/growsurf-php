<?php

namespace Growsurf\Core\Exceptions;

use Growsurf\Core\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class APIStatusException extends APIException
{
    /** @var string */
    protected const DESC = 'Growsurf API Status Error';

    public ?int $status;

    public ?string $errorName = null;

    public ?string $errorCode = null;

    public ?string $errorMessage = null;

    /** @var list<array<string,mixed>>|null */
    public ?array $errors = null;

    public ?string $supportURL = null;

    public ?string $policyName = null;

    public ?string $level = null;

    public ?string $timestamp = null;

    public ?string $fraudRiskLevel = null;

    public ?string $fraudReasonCode = null;

    /** @var list<string>|null */
    public ?array $matchedParticipantIDs = null;

    public ?string $email = null;

    public ?string $referrerID = null;

    public ?string $ipAddress = null;

    public ?string $fingerprint = null;

    public ?string $blockedAt = null;

    public function __construct(
        public RequestInterface $request,
        ResponseInterface $response,
        ?\Throwable $previous = null,
        string $message = '',
    ) {
        $this->response = $response;
        $this->status = $response->getStatusCode();

        $this->body = Util::decodeJson($response->getBody());
        $this->initializeDocumentedErrorFields($this->body);

        $summary = Util::prettyEncodeJson(['status' => $this->status, 'body' => $this->body]);

        if ('' != $message) {
            $summary .= $message.PHP_EOL.$summary;
        }

        parent::__construct(request: $request, message: $summary, previous: $previous);
    }

    public static function from(
        RequestInterface $request,
        ResponseInterface $response,
        string $message = ''
    ): self {
        $status = $response->getStatusCode();

        $cls = match (true) {
            400 === $status => BadRequestException::class,
            401 === $status => AuthenticationException::class,
            403 === $status => PermissionDeniedException::class,
            404 === $status => NotFoundException::class,
            409 === $status => ConflictException::class,
            422 === $status => UnprocessableEntityException::class,
            429 === $status => RateLimitException::class,
            $status >= 500 => InternalServerException::class,
            default => APIStatusException::class
        };

        return new $cls(request: $request, response: $response, message: $message);
    }

    /**
     * Expose the stable public error fields while retaining the complete forward-compatible body.
     */
    private function initializeDocumentedErrorFields(mixed $body): void
    {
        if (!is_array($body)) {
            return;
        }

        $this->errorName = self::stringOrNull($body['name'] ?? null);
        $this->errorCode = self::stringOrNull($body['code'] ?? null);
        $this->errorMessage = self::stringOrNull($body['message'] ?? null);
        $this->errors = self::arrayOrNull($body['errors'] ?? null);
        $this->supportURL = self::stringOrNull($body['supportUrl'] ?? null);
        $this->policyName = self::stringOrNull($body['policyName'] ?? null);
        $this->level = self::stringOrNull($body['level'] ?? null);
        $this->timestamp = self::stringOrNull($body['timestamp'] ?? null);
        $this->fraudRiskLevel = self::stringOrNull($body['fraudRiskLevel'] ?? null);
        $this->fraudReasonCode = self::stringOrNull($body['fraudReasonCode'] ?? null);
        $this->matchedParticipantIDs = self::stringListOrNull($body['matchedParticipantIds'] ?? null);
        $this->email = self::stringOrNull($body['email'] ?? null);
        $this->referrerID = self::stringOrNull($body['referrerId'] ?? null);
        $this->ipAddress = self::stringOrNull($body['ipAddress'] ?? null);
        $this->fingerprint = self::stringOrNull($body['fingerprint'] ?? null);
        $this->blockedAt = self::stringOrNull($body['blockedAt'] ?? null);
    }

    private static function stringOrNull(mixed $value): ?string
    {
        return is_string($value) ? $value : null;
    }

    /** @return list<array<string,mixed>>|null */
    private static function arrayOrNull(mixed $value): ?array
    {
        if (!is_array($value) || !array_is_list($value)) {
            return null;
        }

        $result = [];
        foreach ($value as $item) {
            $normalized = self::stringKeyedArrayOrNull($item);
            if (null === $normalized) {
                return null;
            }

            $result[] = $normalized;
        }

        return $result;
    }

    /** @return array<string,mixed>|null */
    private static function stringKeyedArrayOrNull(mixed $value): ?array
    {
        if (!is_array($value)) {
            return null;
        }

        $result = [];
        foreach ($value as $key => $item) {
            if (!is_string($key)) {
                return null;
            }

            $result[$key] = $item;
        }

        return $result;
    }

    /** @return list<string>|null */
    private static function stringListOrNull(mixed $value): ?array
    {
        if (!is_array($value) || !array_is_list($value)) {
            return null;
        }

        foreach ($value as $item) {
            if (!is_string($item)) {
                return null;
            }
        }

        return $value;
    }
}
