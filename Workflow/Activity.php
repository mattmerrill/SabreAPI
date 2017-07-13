<?php

namespace GrazeTech\SACSphp\Workflow;

interface Activity {

    function run($sharedContext);
}
