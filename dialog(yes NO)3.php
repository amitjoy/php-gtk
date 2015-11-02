<?php
$window = new GtkWindow();
$window->set_size_request(400, 150);
$window->connect_simple('destroy', array('Gtk','main_quit'));

$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Display Alert - Part 1");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);

$vbox->pack_start(new GtkLabel(), 0, 0); // add a small gap

// setup the entry field
$hbox = new GtkHBox();
$vbox->pack_start($hbox, 0, 0);
$hbox->pack_start(new GtkLabel("Please enter your name:"), 0, 0);
$name = new GtkEntry();
$hbox->pack_start($name, 0, 0);
$name->connect('activate', 'on_activate'); // setup event handler to check user input

// check user input
function on_activate($widget) {
    $input = $widget->get_text(); // get user input
    echo "name = $input\n";
    if ($input=='') alert("Please enter your name!"); // popup the alert box
    $widget->grab_focus(); // put the focus back to the input
}

// display popup alert box
function alert($msg) { // note 1
    $dialog = new GtkDialog('Alert', null, Gtk::DIALOG_MODAL); // create a new dialog
    $dialog->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
    $top_area = $dialog->vbox; // note 2
    $top_area->pack_start($hbox = new GtkHBox()); // note 3
    $stock = GtkImage::new_from_stock(Gtk::STOCK_DIALOG_WARNING,
        Gtk::ICON_SIZE_DIALOG); // note 4
    $hbox->pack_start($stock, 0, 0); // stuff in the icon
    $hbox->pack_start(new GtkLabel($msg)); // and the msg
    $dialog->add_button(Gtk::STOCK_OK, Gtk::RESPONSE_OK); // note 5
    $dialog->set_has_separator(false); // don't display the set_has_separator
    $dialog->show_all(); // show the dialog
    $dialog->run(); // the dialog in action
    $dialog->destroy(); // done. close the dialog box.
}

$window->show_all();
Gtk::main();

?>