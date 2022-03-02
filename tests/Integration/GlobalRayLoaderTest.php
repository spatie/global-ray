<?php

beforeEach(function () {
    include_once __DIR__ . '/../../src/scripts/global-ray-loader.php';
});

it('will resolve ray global function', function () {
    expect(function_exists('ray'))->toBeTrue();
});

it('will resolve rd global function', function () {
    expect(function_exists('rd'))->toBeTrue();
});

it('will not generate exceptions when calling ray', function () {
    ray('foo');
})->expectNotToPerformAssertions();

it('will not generate exceptions when calling rd', function () {
    ray('rd');
})->expectNotToPerformAssertions();
