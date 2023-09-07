<?php

declare(strict_types=1);

namespace App\Helper;

use App\Dto\RateCdrData;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RateCdrParser
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function parse(array $parameters): RateCdrData
    {
        $validatorMetadata = self::loadValidatorMetadata();
        $violations        = $this->validator->validate($parameters, $validatorMetadata);

        if ($violations->count() > 0) {
            $errors = '';
            foreach ($violations as $violation) {
                $errors .= $violation->getMessage();
            }

            throw new \Exception($errors);
        }

        return new RateCdrData($parameters['rate'], $parameters['cdr']);
    }

    public static function loadValidatorMetadata(): Assert\Collection
    {
        return new Assert\Collection([
            'fields' => [
                'rate' => new Assert\Collection([
                    'fields' => [
                        'energy' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'float']),
                        ],
                        'time' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => ['float', 'integer']]),
                        ],
                        'transaction' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => ['float', 'integer']]),
                        ],
                    ],
                ]),
                'cdr' => new Assert\Collection([
                    'fields' => [
                        'meterStart' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'integer']),
                        ],
                        'timestampStart' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'string']),
                        ],
                        'meterStop' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'integer']),
                        ],
                        'timestampStop' => [
                            new Assert\NotBlank(),
                            new Assert\Type(['type' => 'string']),
                        ],
                    ],
                ]),
            ],
        ]);
    }
}
