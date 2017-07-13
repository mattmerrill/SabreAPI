<?php

namespace GrazeTech\SabreAPI\Workflow;

interface Activity {

    function run($sharedContext);
}
