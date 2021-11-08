<?php

http_response_code(403);
return require(__DIR__ . "/view/no-autorizado.phtml");