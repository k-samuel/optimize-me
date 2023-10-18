<?php

declare(strict_types=1);

namespace KSamuel\OptimizeMe\Slow;

use ReflectionClass;
use ReflectionProperty;

class User
{
    public string $name;
    public string $email;
    public string $city;
    public int $age;
    public string $country;
    public string $phone;
    public string $job;
    public string $company;

    /**
     * @var array<int,string>
     */
    public array $browsers = [];

    /**
     * @param array<int,string|array<int,string>> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $user = new self();
        $class = new ReflectionClass($user);
        $properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $propName = $property->getName();
            if (isset($data[$propName]) && gettype($data[$propName]) === $property->getType()->__toString()) {
                $methodName = 'set' . ucfirst($propName);
                if ($class->hasMethod($methodName) && $class->getMethod($methodName)->isPublic()) {
                    $user->{$methodName}($data[$propName]);
                } else {
                    $user->{$propName} = $data[$propName];
                }
            }
        }

        return $user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return array<int,string>
     */
    public function getBrowsers(): array
    {
        return $this->browsers;
    }

    public function setBrowsers(array $browsers): void
    {
        $this->browsers = $browsers;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }
}
