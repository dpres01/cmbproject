<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPh9036w\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPh9036w/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerPh9036w.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerPh9036w\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerPh9036w\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Ph9036w',
    'container.build_id' => '6c068801',
    'container.build_time' => 1529957426,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerPh9036w');
