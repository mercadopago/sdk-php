<?php

namespace MercadoPago\Net;

/**
 * Search request class.
 */
class MPSearchRequest
{
    private const LIMIT_PARAM = "limit";
    private const OFFSET_PARAM = "offset";

    private int $limit;
    private int $offset;
    private array $filters;

    /**
     * MPSearchRequest constructor.
     * @param mixed $limit limit of the search.
     * @param mixed $offset offset of the search.
     * @param mixed $filters filters of the search.
     */
    public function __construct(?int $limit, ?int $offset, ?array $filters = [])
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->filters = $filters ?? [];
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

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
