<?php

namespace EspindolaAdm\Repository;

use EspindolaAdm\Ambience;

class RepositoryAmbience
{
    static public function all()
    {
        return Ambience::select('ambience_id', 'ambience_name')->orderBy('ambience_name', 'asc')->get();
    }
}
