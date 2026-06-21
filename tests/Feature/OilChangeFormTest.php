<?php

it('displays the oil change check form', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Current Odometer', false);
    $response->assertSee('Previous Odometer', false);
    $response->assertSee('Date of Previous Oil Change', false);
});

it('shows validation errors after failed submission', function () {
    $response = $this->from('/')->post('/check', []);
    $response->assertRedirect('/');
    $response->assertSessionHasErrors(['current_odometer']);
});
