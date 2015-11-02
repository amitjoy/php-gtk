<?php
$window = new GtkWindow();
$window->set_size_request(400, 100);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Set up Volume Control\n".
"Part 2 - using GtkHScale");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0.5, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0);
$vbox->pack_start(new GtkLabel(), 0);

$vbox->pack_start($hbox = new GtkHBox(), 0);
$hbox->pack_start(new GtkLabel('Volume: '), 0);
$vol_adj = GtkHScale::new_with_range(-100, 80, 1); // note 1
$hbox->pack_start($vol_adj);

$vol_adj->set_value_pos(Gtk::POS_RIGHT); // note 2
$vol_adj->connect('format-value', 'on_format_value'); // note 3


$window->show_all();
Gtk::main();

function on_format_value($scale, $value) {
    return $value."dB"; // note 4
}

?>