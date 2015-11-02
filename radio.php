<?php
$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 120);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up Dialog Box of Radio Buttons - Part 1");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

$vbox->pack_start($hbox = new GtkHBox(), 0);
$hbox->pack_start(new GtkLabel('Response: '), 0);
$hbox->pack_start($response = new GtkLabel(), 0);
$hbox->pack_start($button = new GtkButton('Get Response'), 0);
$button->connect('clicked', 'on_click');

$window->show_all();
Gtk::main();

function on_click() {
    setup_dialog();
}

function setup_dialog() {

    $dialog = new GtkDialog();

    $dialog->vbox->pack_start(new GtkLabel('Which platform are you using: '));

    $radio0 = setup_radio(null, 'radio button 0', '100'); // note 1
    $radio1 = setup_radio($radio0, 'Windows', 'win');
    $radio2 = setup_radio($radio0, 'Mac', 'mac');
    $radio3 = setup_radio($radio0, 'Linux', 'linux');

    // pack them inside vbox
    $dialog->vbox->pack_start($radio1, 0, 0); // note 2
    $dialog->vbox->pack_start($radio2, 0, 0); // note 2
    $dialog->vbox->pack_start($radio3, 0, 0); // note 2

    $dialog->vbox->pack_start($hbox2 = new GtkHBox());
    $button_ok = GtkButton::new_from_stock(Gtk::STOCK_OK);
    $button_ok->set_size_request(87, 33);
    $hbox2->pack_start(new GtkLabel());
    $hbox2->pack_start($button_ok, 0);
    $button_ok->connect('clicked', 'on_ok_button', $dialog);

    $dialog->set_has_separator(false);
    $dialog->action_area->set_size_request(-1, 1);
    $dialog->show_all();

    global $selected_radio, $selected_radio_value;
    $selected_radio = $selected_radio_value = '';
    $dialog->run();
    $dialog->destroy();

    global $response;
    $response->set_text("$selected_radio ($selected_radio_value)"); // note 5

}

function on_ok_button($button, $dialog) {
    $dialog->destroy(); // note 4
}

function setup_radio($radio_button_grp, $button_label, $button_value) {
    $radio = new GtkRadioButton($radio_button_grp, $button_label);
    $radio->connect('toggled', "on_toggle", $button_value);
    return $radio;
}

function on_toggle($radio, $value) { // note 3
    $label = $radio->child->get_label();
    $active = $radio->get_active();
    if ($active) {
        global $response, $selected_radio, $selected_radio_value;
        $selected_radio = $label;
        $selected_radio_value = $value;
    }
}

?>