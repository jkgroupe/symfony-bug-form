/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap')
require('symfony-collection');
require('@fortawesome/fontawesome-free/js/all');

jQuery(document).ready(function () {
    'use strict';

    const that = this;
    const formCollection = jQuery('.form-collection');

    jQuery.each(formCollection, function (i, el) {
        const collection = jQuery(el);

        const options = {
            preserve_names: collection.data('preserve-names') || false,
            name_prefix: collection.data('name-prefix'),
            init_with_n_elements: collection.data('init-with-n-elements') || 1,
            elements_selector: collection.data('elements-selector') || '> div, > fieldset',
            elements_parent_selector: collection.data('elements-parent-selector') || '%id%',
            up: '<a href="#"><i class="fa fa-fw fa-chevron-up"></i></a>',
            down: '<a href="#"><i class="fa fa-fw fa-chevron-down"></i></a>',
            add: '<a href="#"><i class="fa fa-fw fa-plus"></i></a>',
            remove: '<a href="#"><i class="fa fa-fw text-danger fa-trash"></i></a>',
            duplicate: '<a href="#"><i class="fa fa-fw fa-copy"></i></a>',
            hide_useless_buttons: true,
            drag_drop: collection.data('drag-drop') || false,
            add_at_the_end: collection.data('add-at-the-end') || false,
            min: collection.data('min') || 1,
            max: collection.data('max') || 10,
            after_duplicate: function (collection, element) {
            },
            after_up: function (collection, element) {
                reorderPosition(collection, element);
            },
            after_down: function (collection, element) {
                reorderPosition(collection, element);
            },
            after_add: function (collection, element) {
                reorderPosition(collection, element);
            },
            after_remove: function (collection, element) {
                reorderPosition(collection, element);
            },
        };

        if (collection.data('position') !== undefined) {
            options.position_field_selector = collection.data('position');
        }

        if (collection.data('drag-drop') !== undefined) {
            options.drag_drop = collection.data('drag-drop');
            options.drag_drop_options = {
                axis: 'y', cursor: 'move', classes: {
                    'ui-sortable': 'highlight',
                    'ui-sortable-placeholder': 'sortable-placeholder',
                    'ui-sortable-handle': 'sortable-handle',
                }
            };
        }

        if (collection.data('custom-add-location') !== undefined) {
            options.custom_add_location = collection.data('custom-add-location');
        }

        if (collection.data('allow-duplicate') !== undefined) {
            options.allow_duplicate = collection.data('allow-duplicate');
        }

        if (collection.data('allow-up') !== undefined) {
            options.allow_up = collection.data('allow-up');
        }

        if (collection.data('allow-down') !== undefined) {
            options.allow_down = collection.data('allow-down');
        }

        if (collection.data('allow-add') !== undefined) {
            options.allow_add = collection.data('allow-add');
        }

        if (collection.data('allow-remove') !== undefined) {
            options.allow_remove = collection.data('allow-remove');
        }

        const prototype = jQuery(collection.data('prototype'));
        const children = prototype.children('.children-collection');

        if (children.length > 0) {
            options.children = [];

            const childrenOptions = {
                name_prefix: children.data('name-prefix'),
                selector: '.children-collection',
                init_with_n_elements: (children.data('init-with-n-elements') || 1),
                min: (children.data('min') || 1),
                max: (children.data('max') || 10),
                drag_drop: children.data('drag-drop') || false,
            };

            if (children.data('position') !== undefined) {
                childrenOptions.position_field_selector = children.data('position');
            }

            if (children.data('drag-drop') !== undefined) {
                childrenOptions.drag_drop = children.data('drag-drop');
            }

            if (children.data('custom-add-location') !== undefined) {
                childrenOptions.custom_add_location = children.data('custom-add-location');
            }

            if (children.data('allow-duplicate') !== undefined) {
                childrenOptions.allow_duplicate = children.data('allow-duplicate');
            }

            if (children.data('allow-up') !== undefined) {
                childrenOptions.allow_up = children.data('allow-up');
            }

            if (children.data('allow-down') !== undefined) {
                childrenOptions.allow_down = children.data('allow-down');
            }

            if (children.data('allow-add') !== undefined) {
                childrenOptions.allow_add = children.data('allow-add');
            }

            if (children.data('allow-remove') !== undefined) {
                childrenOptions.allow_remove = children.data('allow-remove');
            }

            options.children.push(childrenOptions);
        }

        collection.collection(options);
    });

});

function reorderPosition(collection, element) {
    collection.find('.position').each(function (i, el) {
        jQuery(el).html(i + 1);
    });
}