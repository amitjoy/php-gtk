<?php
$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 120);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up Dialog Box - Part 5\n".
    "Getting text entry from a dialog box");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

$vbox->pack_start($hbox = new GtkHBox(), 0);
$hbox->pack_start(new GtkLabel('Phone Number: '), 0);
$hbox->pack_start($response = new GtkLabel(), 0);
$hbox->pack_start($button = new GtkButton('Enter Phone Number'), 0);
$button->connect('clicked', 'on_click');

$window->show_all();
Gtk::main();

function on_click() {
    setup_yes_no_dialog();
}

function setup_yes_no_dialog() {

    $dialog = new GtkDialog();

    $dialog->vbox->pack_start($hbox = new GtkHBox());
    $hbox->pack_start(new GtkLabel('Phone Number: '), 0);
    $hbox->pack_start($phone = new GtkEntry(), 0); // note 1

    $dialog->vbox->pack_start($hbox2 = new GtkHBox());
    $button_ok = GtkButton::new_from_stock(Gtk::STOCK_OK);
    $button_ok->set_size_request(87, 33);
    $hbox2->pack_start(new GtkLabel());
    $hbox2->pack_start($button_ok, 0);
    $phone->connect('activate', 'on_enter', $button_ok); // note 2
    $button_ok->connect('clicked', 'on_ok_button', $dialog);

    $dialog->set_has_separator(false);
    $dialog->action_area->set_size_request(-1, 1);
    $dialog->show_all();
    $dialog->run();
    $dialog->destroy();

    global $response;
    $response->set_text($phone->get_text());
}

function on_ok_button($button, $dialog) { // note 3
    $dialog->destroy();
}

function on_enter($entry, $button) {
    $button->clicked(); // note 4
}

?>