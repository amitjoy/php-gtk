<?php
$window = new GtkWindow();
$window->set_size_request(400, 300);
$window->connect_simple('destroy', array('Gtk','main_quit'));

$vbox2 = new GtkVBox(); // note 1
$vbox2->pack_start(new GtkLabel("This frame of size 200x200"));
$vbox2->pack_start(new GtkLabel("will always stay stay centered"));
$vbox2->pack_start(new GtkLabel("no matter how you resize the app"));

$eventbox = new GtkEventBox(); // note 2
$eventbox->add($vbox2);
$eventbox->modify_bg(Gtk::STATE_NORMAL, GdkColor::parse("#CCFF99"));

$frame_200_200 = new GtkFrame(); // note 3
$frame_200_200->set_size_request(200, 200);
$frame_200_200->add($eventbox);

$hbox = new GtkHBox(); // note 4
$hbox->pack_start(new GtkHBox());
$hbox->pack_start($frame_200_200, 0);
$hbox->pack_start(new GtkHBox());

$vbox = new GtkVBox(); // note 5
$vbox->pack_start(new GtkHBox());
$vbox->pack_start($hbox, 0);
$vbox->pack_start(new GtkHBox());

$window->add($vbox); // note 6
$window->show_all();
Gtk::main();
?>