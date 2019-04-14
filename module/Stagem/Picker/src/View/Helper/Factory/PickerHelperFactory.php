<?php

namespace Stagem\Picker\View\Helper\Factory;

use Psr\Container\ContainerInterface;
use Stagem\Picker\Service\PickerService;
use Stagem\Picker\View\Helper\PickerHelper;

class PickerHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $pickerService = $container->get(PickerService::class);
        $userHelper = new PickerHelper($pickerService);

        return $userHelper;
    }
}