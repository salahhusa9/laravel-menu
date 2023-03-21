<?php

it('will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'info'])
    ->each->not->toBeUsed();
