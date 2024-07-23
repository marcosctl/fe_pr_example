<?php

/**
 * Implements hook_preprocess_block().
 *
 * Displays a list of event registration links.
 */
function mytheme_preprocess_block(&$variables) {
    $content = $variables['content'];

    $events = \Drupal::entityTypeManager()->getStorage('node')
        ->loadByProperties(['type' => 'event', 'status' => 1]);

    $markup = '<h3>Upcoming Events</h3><ul id="event-list">';
    foreach ($events as $event) {
        var_dump($event->get('field_show_in_list')->getValue());
        $field_show_in_list = $event->get('field_show_in_list')->getValue();
        $link_title = isset($content['link_title']) ? $content['link_title'] : 'Click to register for the event';
        if ($field_show_in_list = true) {
            $markup .= '<li><a href="/node/' . $event->id() .'">' . $link_title . '</a></li>';
        }
    }
    $markup .= '</ul>';

    $variables['content']['links'] = [
        '#markup' => $markup,
    ];
}
