<?php

it('displays the oil change check form', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Current Odometer', false);
    $response->assertSee('Previous Odometer', false);
    $response->assertSee('Date of Previous Oil Change', false);
});
