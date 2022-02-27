<?php

beforeEach(function () {
    include_once __DIR__ . '/../../src/scripts/global-ray-loader.php';
});

it('will resolve ray global function', function () {
    expect(function_exists('ray'))->toBeTrue();
});

it('will not generate exceptions', function () {
    ray('foo');
})->expectNotToPerformAssertions();