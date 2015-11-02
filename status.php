<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Window with status area");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);

$vbox->pack_start(new GtkLabel('your body contents'));

// setup status area
$status = new GtkStatusbar(); // note 1
$eventbox = new GtkEventBox();
$eventbox->add($status);
$vbox->pack_start($eventbox, 0, 0); // note 2
$eventbox->modify_bg(Gtk::STATE_NORMAL, GdkColor::parse('#ffff00')); // note 3


// display a message
$context_id = $status->get_context_id('msg1'); // note 4
$status->push($context_id, 'this is msg 1'); // note 4

$window->show_all();
Gtk::main();
?>