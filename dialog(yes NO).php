<?php
$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 120);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up a simple yes/no dialog\n".
"Part 2 - using add_buttons");
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

    $dialog = new GtkDialog(); // note 1
    $dialog->set_title('Yes/No Dialog');
    $label = new GtkLabel("Do you like PHP-Gtk2?");
    $dialog->vbox->pack_start($label); // note 2


    $dialog->add_buttons(array( // note 3
        Gtk::STOCK_YES, Gtk::RESPONSE_YES, //
        Gtk::STOCK_NO, Gtk::RESPONSE_NO //
    )); //

    $dialog->show_all();
    $response_id = $dialog->run(); // note 4
    $dialog->destroy(); // note 5

    global $response;
    switch($response_id) { // note 6
        case Gtk::RESPONSE_YES:
            $response->set_text("$response_id (Yes)"); // note 7
            break;
        case Gtk::RESPONSE_NO:
            $response->set_text("$response_id (No)");
            break;
    }

}

?>