<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);

$window->connect_simple('destroy', array('Gtk','main_quit'));

$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel();
$title->set_markup('<span color="blue" font_desc="Times New Roman Italic 12">
    Button Group Demo</span>');
$vbox->pack_start($title);

// setup grouped radio buttons
$radio1 = setup_radio(null, 'radio button 1', '101'); // note 1
$radio2 = setup_radio($radio1, 'radio button 2', '102'); // note 2
$radio3 = setup_radio($radio1, 'radio button 3', '103');

// pack them inside vbox
$vbox->pack_start($radio1, 0, 0);
$vbox->pack_start($radio2, 0, 0);
$vbox->pack_start($radio3, 0, 0);

// add a status area
$vbox->pack_start($status_area = new GtkLabel('Click a Button'));

// function to simplify the display of grouped radio buttons
function setup_radio($radio_button_grp, $button_label, $button_value) { // note 3
    $radio = new GtkRadioButton($radio_button_grp, $button_label);
    $radio->connect('toggled', "on_toggle", $button_value); // note 4
    return $radio;
}

// call-back function when user pressed a radio button
function on_toggle($radio, $value) { // note 5
    global $status_area;
    $label = $radio->child->get_label();  // note 6
    $active = $radio->get_active(); // note 7
    if ($active) $status_area->set_text("radio button pressed: $label (value = $value)\n"); // note 8
}

$window->show_all();
Gtk::main();
?>