<?php

use Src\Example;

test('example', function () {
    expect(true)->toBeTrue();
});

describe('Example Test', function () {
    test('Test sayHello', function () {
        $example = new Example;
        expect($example->sayHello())->toBe('Hello');
    });
});
