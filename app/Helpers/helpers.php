<?php

function setActive(array $resources, string $activeClass = 'active', $returnBool = false) {
    foreach ($resources as $resource) {
        if (request()->routeIs($resource . '.*')) {
            return $returnBool ? true : $activeClass;
        }
    }
    return $returnBool ? false : '';
}

function isSubmenuOpen(array $resources) {
    return setActive($resources, '', true);
}
