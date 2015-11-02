<?php
$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 120);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up a simple yes/no dialog\n".
"Part 3 - set up button manually");
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
$hbox->pack_start($response = new GtkEntry(), 0);
$hbox->pack_start($button = new GtkButton('Get Yes/No Response'), 0);
$button->connect('clicked', 'on_click');

$window->show_all();
Gtk::main();

function on_click() {
    setup_yes_no_dialog();
}

function setup_yes_no_dialog() {

    $dialog = new GtkDialog();
    $dialog->set_title('Yes/No Dialog');
    $label = new GtkLabel("Do you like PHP-Gtk2?");
    $dialog->vbox->pack_start($label);

    $button_yes = GtkButton::new_from_stock(Gtk::STOCK_YES); // note 1
    $button_no = GtkButton::new_from_stock(Gtk::STOCK_NO); // note 2

    $button_yes->connect('clicked', 'on_ok_button', $dialog, 100); // note 3
    $button_no->connect('clicked', 'on_ok_button', $dialog, 200);

    $hbox = new GtkHBox(); // note 4
    $dialog->vbox->pack_start($hbox);
    $hbox->pack_start($button_yes);
    $hbox->pack_start($button_no);

    $dialog->set_has_separator(false);
    $dialog->action_area->set_size_request(-1, 1);
    $dialog->show_all();
    $response_id = $dialog->run();
    $dialog->destroy();

    global $response;
    $response->set_text($response_id); // note 6
}

function on_ok_button($button, $dialog, $response_id) {
    $dialog->response($response_id); // note 5
}

?>