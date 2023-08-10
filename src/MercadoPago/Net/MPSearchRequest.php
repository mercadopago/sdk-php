<?php

namespace MercadoPago\Net;

/**
 * Search request class.
 */
class MPSearchRequest
{
    private const LIMIT_PARAM = "limit";
    private const OFFSET_PARAM = "offset";

    /**
     * MPSearchRequest constructor.
     * @param int $limit limit of the search.
     * @param int $offset offset of the search.
     * @param array $filters filters of the search.
     */
    public function __construct(
        private ?int $limit,
        private ?int $offset,
        private ?array $filters = []
    ) {
    }

    /**
     * Get the limit of the search.
     * @return int limit of the search.
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Get the offset of the search.
     * @return int offset of the search.
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Get the filters of the search.
     * @return array filters of the search.
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * Get the parameters of the search.
     * @return array parameters of the search.
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
