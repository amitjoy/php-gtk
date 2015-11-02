<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);
$window->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Change the background color and\nset the font and color of GtkEntry");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);

$entry = new GtkEntry;
$entry->modify_base(Gtk::STATE_NORMAL, GdkColor::parse('#ffff00')); // note 1
$entry->modify_text(Gtk::STATE_NORMAL, GdkColor::parse('#0000ff')); // note 2
$entry->modify_font(new PangoFontDescription("Arial Black 12")); // note 3

$hbox = new GtkHBox();
$hbox->pack_start(new GtkLabel('Item Number: '), 0, 0);
$hbox->pack_start($entry, 0, 0);
$vbox->pack_start($hbox);

$window->show_all();
Gtk::main();
?>