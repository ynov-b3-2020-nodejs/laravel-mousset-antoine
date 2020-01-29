<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2019 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Component\Checker;

/**
 * This class is a claim checker.
 * When the "iat" is present, it will compare the value with the current timestamp.
 */
final class IssuedAtChecker implements ClaimChecker, HeaderChecker
{
    private const NAME = 'iat';

    /**
     * @var int
     */
    private $allowedTimeDrift;
    /**
     * @var bool
     */
    private $protectedHeaderOnly;

    public function __construct(int $allowedTimeDrift = 0, bool $protectedHeaderOnly = false)
    {
        $this->allowedTimeDrift = $allowedTimeDrift;
        $this->protectedHeaderOnly = $protectedHeaderOnly;
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidClaimException if the claim is invalid
     */
    public function checkClaim($value): void
    {
        if (!\is_int($value)) {
            throw new InvalidClaimException('"iat" must be an integer.', self::NAME, $value);
        }
        if (time() < $value - $this->allowedTimeDrift) {
            throw new InvalidClaimException('The JWT is issued in the future.', self::NAME, $value);
        }
    }

    public function supportedClaim(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidHeaderException if the header parameter is invalid
     */
    public function checkHeader($value): void
    {
        if (!\is_int($value)) {
            throw new InvalidHeaderException('The header "iat" must be an integer.', self::NAME, $value);
        }
        if (time() < $value - $this->allowedTimeDrift) {
            throw new InvalidHeaderException('The JWT is issued in the future.', self::NAME, $value);
        }
    }

    public function supportedHeader(): string
    {
        return self::NAME;
    }

    public function protectedHeaderOnly(): bool
    {
        return $this->protectedHeaderOnly;
    }
}
