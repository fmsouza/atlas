<?php

namespace application\src;

use core\tools\rest\Resource;

class TestResource extends Resource{

    /**
     * @route(path: 'foo/bar/#id#/#another#', method: 'GET')
     */
    public function foo(){
        return $this->success();
    }

}