<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestsHelper;
use Tests\CreatesApplication;

abstract class FeatureTestCase extends \Laravel\BrowserKitTesting\TestCase
{

    use CreatesApplication, TestsHelper, DatabaseTransactions;

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array) $errors as $message) {
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block", $message
                );
            }
        }
    }

}
