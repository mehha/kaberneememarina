<?php return array(
    'root' => array(
        'name' => 'lloc/multisite-language-switcher',
        'pretty_version' => '2.5.8',
        'version' => '2.5.8.0',
        'reference' => 'bc3fa02f91e06208cb05c755a9fe8b163a2c0499',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'antecedent/patchwork' => array(
            'pretty_version' => '2.1.21',
            'version' => '2.1.21.0',
            'reference' => '25c1fa0cd9a6e6d0d13863d8df8f050b6733f16d',
            'type' => 'library',
            'install_path' => __DIR__ . '/../antecedent/patchwork',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'lloc/multisite-language-switcher' => array(
            'pretty_version' => '2.5.8',
            'version' => '2.5.8.0',
            'reference' => 'bc3fa02f91e06208cb05c755a9fe8b163a2c0499',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
    ),
);
