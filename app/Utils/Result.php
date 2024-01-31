<?php

namespace App\Utils;

use App\Utils\ResultError;

/**
 * @template-covariant TData
 */
final class Result {
    private function __construct() { }

    /**
     * @var TData|null
     */
    private mixed $data;

    /**
     * @var ResultError|null
     */
    private ?ResultError $error;

    /**
     * @return TData|null
     */
    public function getData(): mixed {
        return $this->data;
    }

    /**
     * @return ResultError|null
     */
    public function getError(): ?ResultError {
        return $this->error;
    }

    public function isSuccess(): bool {
        return isset($this->data);
    }

    public function isError(): bool {
        return ! $this->isSuccess();
    }

    /**
     * @param TData $data
     * 
     * @return Result<TData>
     */
    public static function fromOk(mixed $data): Result {
        $result = new Result();

        $result->data = $data;

        return $result;
    }

    /**
     * @param ResultError $error
     * 
     * @return Result<null>
     */
    public static function fromError(ResultError $error): Result {
        $result = new Result();

        $result->error = $error;

        return $result;
    }
}