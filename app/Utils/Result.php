<?php

namespace App\Utils;

final class Result {
    private function __construct() { }

    /**
     * @var array<string, string>|null $data
     */
    private ?array $data;

    /**
     * @var array<string, string>|null $error
     */
    private ?array $error;

    /**
     * @return array<string, string>|null
     */
    public function getData(): ?array {
        return $this->data;
    }

    /**
     * @return array<string, string>|null
     */
    public function getError(): ?array {
        return $this->error;
    }

    public function isSuccess(): bool {
        return isset($this->data) && count($this->data) > 0;
    }

    public function isError(): bool {
        return ! $this->isSuccess();
    }

    /**
     * @param array<string, string> $data
     * 
     * @return Result
     */
    public static function fromOk(array $data): Result {
        $result = new Result();

        $result->data = $data;

        return $result;
    }

    /**
     * 
     */
    public static function fromError(array $error): Result {
        $result = new Result();

        $result->error = $error;

        return $result;
    }
}