<?php

namespace MercadoPago\Net;

/**
 * Encapsulates pagination and filter parameters for API search endpoints.
 *
 * Used by client search methods (e.g., {@see \MercadoPago\Client\Payment\PaymentClient::search()})
 * to build the query-string sent to `/search` endpoints. Filters are passed through
 * as-is; `limit` and `offset` are injected only if not already present in the filters array.
 */
class MPSearchRequest
{
    private const LIMIT_PARAM = "limit";
    private const OFFSET_PARAM = "offset";

    /**
     * @param int|null   $limit   Maximum number of results to return.
     * @param int|null   $offset  Zero-based offset for pagination.
     * @param array<string,mixed> $filters Key-value pairs appended as query-string parameters (e.g., ['status' => 'approved']).
     */
    public function __construct(
        private ?int $limit,
        private ?int $offset,
        private ?array $filters = []
    ) {
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /** @return array<string,mixed> */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * Merges filters with pagination into a single query-parameter array.
     *
     * If the filters already contain `limit` or `offset` keys, those values
     * take precedence over the constructor arguments.
     *
     * @return array<string,mixed> Ready-to-use query parameters.
     */
    public function getParameters(): array
    {
        $parameters = $this->filters ?: [];

        if (!array_key_exists(self::LIMIT_PARAM, $parameters)) {
            $parameters[self::LIMIT_PARAM] = $this->limit;
        }

        if (!array_key_exists(self::OFFSET_PARAM, $parameters)) {
            $parameters[self::OFFSET_PARAM] = $this->offset;
        }

        return $parameters;
    }
}
