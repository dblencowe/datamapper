<?php

namespace Dblencowe\DataMapper\Entity;

abstract class Entity
{
    protected static $map = [];

    public function toString(): string
    {
        $output = [];
        foreach (get_class_vars(static::class) as $property => $value) {
            $output = array_merge($output, $this->sanitiseForTarget($property, $this->$property));
        }

        return json_encode($output);
    }

    private function sanitiseForTarget(string $property, $value): array
    {
        if (array_key_exists($property, static::$map)) {
            if (is_array(static::$map[$property])) {
                $functionName = static::$map[$property][1];
                if (method_exists($this, $functionName)) {
                    $value = $this->$functionName($value);
                }
                $property = static::$map[$property][0];
            } else {
                $property = static::$map[$property];
            }
        }

        return [$property => $value];
    }

    public function __toString()
    {
        return $this->toString();
    }
}