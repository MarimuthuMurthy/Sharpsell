<?php

namespace Traits;
class AllInOneMaker extends coffeMaker
{
    use CappuccinoTrait
    {
        CappuccinoTrait::makeLattee insteadof LatteTrait;
    }
    use LatteTrait;
    }
?>