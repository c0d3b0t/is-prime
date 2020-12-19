<?php

namespace App\Services;

class ResponseMessage
{
    const SUCCESS_LEVEL_ONE = 1;
    const SUCCESS_LEVEL_TWO = 2;
    const FAIL_LEVEL_ONE    = 3;
    const FAIL_LEVEL_TWO    = 4;
    const RAGE              = 5;

    const SUCCESS_LEVEL_ONE_MESSAGE = 'Yes, it is a prime number.';
    const SUCCESS_LEVEL_TWO_MESSAGE = 'YES, and we already told you so!';
    const FAIL_LEVEL_ONE_MESSAGE    = 'No, it is NOT a prime number.';
    const FAIL_LEVEL_TWO_MESSAGE    = 'NO, and we already told you so!';
    const RAGE_MESSAGE              = "You're insane, we don't want to answer anymore.";

    const RAGE_STEP = 10;

    /**
     * @var int
     */
    private int $level;

    /**
     * @return string[]
     */
    public function mapLevelMessages(): array
    {
        return [
            self::SUCCESS_LEVEL_ONE => self::SUCCESS_LEVEL_ONE_MESSAGE,
            self::SUCCESS_LEVEL_TWO => self::SUCCESS_LEVEL_TWO_MESSAGE,
            self::FAIL_LEVEL_ONE    => self::FAIL_LEVEL_ONE_MESSAGE,
            self::FAIL_LEVEL_TWO    => self::FAIL_LEVEL_TWO_MESSAGE,
            self::RAGE              => self::RAGE_MESSAGE
        ];
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        $map = $this->mapLevelMessages();

        return $map[$this->level] ?? null;
    }

    /**
     * @param int $level
     * @return ResponseMessage
     */
    public function setLevel(int $level): ResponseMessage
    {
        $this->level = $level;
        return $this;
    }
}
