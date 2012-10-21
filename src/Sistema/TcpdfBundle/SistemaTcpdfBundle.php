<?php

namespace Sistema\TcpdfBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SistemaTcpdfBundle extends Bundle
{
    public function getParent()
    {
        return 'IoTcpdfBundle';
    }
}
