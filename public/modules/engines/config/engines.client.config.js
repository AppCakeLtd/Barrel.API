'use strict';

// Configuring the Articles module
angular.module('engines').run(['Menus',
    function(Menus) {
        // Set top bar menu items
        Menus.addMenuItem('topbar', 'Engines', 'engines', 'dropdown', '/engines(/create)?');
        Menus.addSubMenuItem('topbar', 'engines', 'List Engines', 'engines');
        Menus.addSubMenuItem('topbar', 'engines', 'New Engine', 'engines/create');
    }
]);
