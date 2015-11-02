<?php

$window = new GtkWindow();
$window->set_title($argv[0]);
$window->set_size_request(400, 250);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Using GtkSheet\n".
"Part 1 - create the spreadsheet");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

$scrolled_win = new GtkScrolledWindow();
$scrolled_win->set_policy( Gtk::POLICY_AUTOMATIC,
Gtk::POLICY_AUTOMATIC);
$vbox->pack_start($scrolled_win);

$sheet = new GtkSheet(6, 12, 'spreadsheet example1'); // note 1
$sheet->set_autoresize(1); // note 2
$scrolled_win->add($sheet); // note 3

$window->show_all();
Gtk::main();

?>